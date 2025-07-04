<?php
/*
Plugin Name: ResponsiveLens
Description: Aperçu simultané de votre site à différentes résolutions. Idéal pour tester le responsive.
Version: 1.1
Author: Troteseil lucas
*/

add_action('admin_menu', 'responsivelens_add_admin_page');
add_action('admin_enqueue_scripts', 'responsivelens_enqueue_tailwind');

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

function responsivelens_enqueue_tailwind($hook) {
    if ($hook !== 'toplevel_page_responsivelens') return;
    wp_enqueue_style('tailwindcss', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
}

function responsivelens_render_admin_page() {
    $site_url = home_url();
    $devices = [
        'Pixel 5' => ['width' => 393, 'height' => 851],
        'iPhone 12 Pro' => ['width' => 390, 'height' => 844],
        'SXGA' => ['width' => 1280, 'height' => 1024],
        'HD' => ['width' => 1366, 'height' => 768],
        'HD+' => ['width' => 1600, 'height' => 900],
        'FHD' => ['width' => 1920, 'height' => 1080],
        'WUXGA' => ['width' => 1920, 'height' => 1200],
    ];
    ?>
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">ResponsiveLens – Aperçu Responsive Multi-écran</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <?php foreach ($devices as $device => $res): ?>
                <div class="bg-white shadow rounded-xl overflow-hidden border border-gray-200">
                    <div class="flex items-center justify-between px-4 py-2 bg-gray-100 border-b">
                        <div>
                            <h2 class="font-semibold"><?php echo esc_html($device); ?></h2>
                            <span class="text-sm text-gray-500"><?php echo "{$res['width']} x {$res['height']}"; ?></span>
                        </div>
                        <button onclick="toggleFullscreen(this)" class="text-blue-600 hover:text-blue-900 text-sm">Plein écran</button>
                    </div>
                    <div class="overflow-hidden">
                        <iframe
                            src="<?php echo esc_url($site_url); ?>"
                            style="width: <?php echo $res['width']; ?>px; height: <?php echo $res['height']; ?>px;"
                            class="block mx-auto transition-all duration-300 ease-in-out"
                        ></iframe>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
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
    </script>
    <?php
}

