<?php
if (!defined('ABSPATH')) exit; // sécurité
?>
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

