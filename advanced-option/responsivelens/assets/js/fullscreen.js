function toggleFullscreen(button) {
    const card = button.closest('.bg-white');
    const iframe = card.querySelector('iframe');
    if (!document.fullscreenElement) {
        iframe.requestFullscreen().catch(err => {
            alert(`Erreur plein écran : ${err.message}`);
        });
    } else {
        document.exitFullscreen();
    }
}

