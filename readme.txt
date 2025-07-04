# ResponsiveLens

**ResponsiveLens** est un plugin WordPress permettant de visualiser votre site en simultané dans différentes résolutions d'écran directement depuis l'interface d'administration. Idéal pour tester le responsive design sur divers appareils (smartphones, laptops, desktops).

---

## 🚀 Fonctionnalités

- Aperçu en temps réel de votre site dans plusieurs résolutions :
  - Pixel 5 (393×851)
  - iPhone 12 Pro (390×844)
  - SXGA (1280×1024)
  - HD (1366×768)
  - HD+ (1600×900)
  - FHD (1920×1080)
  - WUXGA (1920×1200)
- Interface admin avec Tailwind CSS
- Affichage multi-périphérique dans une grille responsive
- Possibilité de passer chaque vue en **plein écran**
- Léger, rapide, aucun réglage requis

---

## 🖥️ Captures d’écran

*(Ajoute ici des captures de ton interface si souhaité)*

---

## 📦 Installation

### Depuis l’admin WordPress
1. Télécharge le fichier ZIP du plugin.
2. Va dans **Extensions > Ajouter > Téléverser une extension**.
3. Sélectionne le fichier `responsivelens.zip` puis clique sur **Installer**.
4. Active le plugin via le menu des extensions.

### Depuis le FTP
1. Place le dossier `responsivelens/` dans `wp-content/plugins/`.
2. Active le plugin depuis l’admin WordPress.

---

## 🔧 Utilisation

1. Une fois activé, va dans **ResponsiveLens** (menu latéral admin).
2. Tu verras une grille de vues du site selon plusieurs résolutions.
3. Clique sur **"Plein écran"** pour tester en grand format.

---

## ⚙️ Configuration optionnelle

Si ton site empêche le rendu dans une iframe (`X-Frame-Options` activé), ajoute ceci dans `functions.php` pour autoriser l'aperçu en local :

```php
remove_action('send_headers', 'wp_send_frame_options_header');

