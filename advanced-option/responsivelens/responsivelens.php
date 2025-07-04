<?php
/*
Plugin Name: ResponsiveLens
Description: Aperçu simultané de votre site à différentes résolutions. Idéal pour tester le responsive.
Version: 1.2
Author: Troteseil  Lucas
*/

if (!defined('ABSPATH')) {
    exit; // Sécurité : accès direct interdit
}

// Chargement des assets CSS et JS
add_action('admin_enqueue_scripts', 'responsivelens_enqueue_assets');

function responsivelens_enqueue_assets($hook) {
    if ($hook !== 'toplevel_page_responsivelens') return;

    wp_enqueue_style('responsivelens-tailwind', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css', [], '2.2.19');
    wp_enqueue_style('responsivelens-style', plugin_dir_url(__FILE__) . 'assets/css/style.css', [], '1.0');

    wp_enqueue_script('responsivelens-fullscreen', plugin_dir_url(__FILE__) . 'assets/js/fullscreen.js', [], '1.0', true);
}

// Ajout menu admin
add_action('admin_menu', 'responsivelens_add_admin_page');
function responsivelens_add_admin_page() {
    add_menu_page(
        'ResponsiveLens',
        'ResponsiveLens',
        'manage_options',
        'responsivelens',
        'responsivelens_render_admin_page',
        'dashicons-smartphone',
        80
    );
}

// Chargement du template de la page admin
function responsivelens_render_admin_page() {
    $site_url = get_option('responsivelens_url', home_url()); // URL personnalisée si sauvegardée, sinon home_url

    // Liste des devices
    $devices = [
        'Pixel 5' => ['width' => 393, 'height' => 851],
        'iPhone 12 Pro' => ['width' => 390, 'height' => 844],
        'SXGA' => ['width' => 1280, 'height' => 1024],
        'HD' => ['width' => 1366, 'height' => 768],
        'HD+' => ['width' => 1600, 'height' => 900],
        'FHD' => ['width' => 1920, 'height' => 1080],
        'WUXGA' => ['width' => 1920, 'height' => 1200],
    ];

    // Sauvegarde de l'URL personnalisée si formulaire soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['responsivelens_url'])) {
        $url = esc_url_raw(trim($_POST['responsivelens_url']));
        if (!empty($url)) {
            update_option('responsivelens_url', $url);
            $site_url = $url;
            echo '<div class="notice notice-success is-dismissible"><p>URL sauvegardée avec succès !</p></div>';
        }
    }

    // Inclusion du template
    include plugin_dir_path(__FILE__) . 'templates/device-grid.php';
}

