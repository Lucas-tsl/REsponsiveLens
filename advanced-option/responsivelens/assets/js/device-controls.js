// Fonction pour le plein écran
function toggleFullscreen(button) {
    const card = button.closest('.device-card');
    const iframe = card.querySelector('iframe');
    if (!document.fullscreenElement) {
        iframe.requestFullscreen().catch(err => {
            alert(`Erreur plein écran : ${err.message}`);
        });
    } else {
        document.exitFullscreen();
    }
}

// Fonction pour mettre à jour le zoom
function updateZoom(deviceId, scale) {
    const container = document.getElementById('device-' + deviceId);
    const iframe = container.querySelector('iframe');
    const valueDisplay = document.getElementById('zoom-value-' + deviceId);
    const slider = document.getElementById('zoom-slider-' + deviceId);
    
    if (!container || !iframe) return;
    
    // Récupérer les dimensions originales
    const width = parseInt(container.dataset.width);
    const height = parseInt(container.dataset.height);
    
    // Appliquer le nouveau scale
    scale = Math.max(0.1, Math.min(1, parseFloat(scale)));
    
    // Mettre à jour le conteneur
    container.style.width = (width * scale) + 'px';
    container.style.height = (height * scale) + 'px';
    
    // Mettre à jour l'iframe
    iframe.style.transform = `scale(${scale})`;
    
    // Mettre à jour les contrôles
    valueDisplay.textContent = Math.round(scale * 100) + '%';
    slider.value = scale;
    
    // Sauvegarder la valeur
    localStorage.setItem('zoom-' + deviceId, scale);
}

// Fonction pour ajuster le zoom avec les boutons +/-
function adjustZoom(deviceId, delta) {
    const slider = document.getElementById('zoom-slider-' + deviceId);
    if (slider) {
        const newValue = parseFloat(slider.value) + delta;
        updateZoom(deviceId, newValue);
    }
}

// Gestion des erreurs d'iframe
function handleIframeLoad(iframe) {
    // Cacher le message d'erreur si l'iframe se charge correctement
    const errorMessage = iframe.parentElement.querySelector('.iframe-error-message');
    if (errorMessage) {
        errorMessage.classList.add('hidden');
    }
    iframe.classList.remove('hidden');
}

function handleIframeError(iframe) {
    // Afficher le message d'erreur
    const errorMessage = iframe.parentElement.querySelector('.iframe-error-message');
    if (errorMessage) {
        errorMessage.classList.remove('hidden');
    }
    iframe.classList.add('hidden');
}

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    // Restaurer les valeurs de zoom sauvegardées
    const sliders = document.querySelectorAll('.zoom-slider');
    sliders.forEach(slider => {
        const deviceId = slider.id.replace('zoom-slider-', '');
        const savedZoom = localStorage.getItem('zoom-' + deviceId);
        if (savedZoom) {
            updateZoom(deviceId, savedZoom);
        }
    });
    
    // Détecter les erreurs d'iframe après un délai
    setTimeout(() => {
        const iframes = document.querySelectorAll('.device-iframe');
        iframes.forEach(iframe => {
            try {
                // Tenter d'accéder au contenu de l'iframe pour détecter les erreurs X-Frame-Options
                if (iframe.contentDocument === null) {
                    handleIframeError(iframe);
                }
            } catch (e) {
                // Erreur d'accès - probablement bloqué par X-Frame-Options
                handleIframeError(iframe);
            }
        });
    }, 3000);
});

