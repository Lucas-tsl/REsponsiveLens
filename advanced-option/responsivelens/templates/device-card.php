<?php
if (!defined('ABSPATH')) exit;

$scale = 0.25; // ajustable : 0.2 = 20% taille réelle
$width = $res['width'];
$height = $res['height'];

// Calcul dynamique de l'échelle
$scale = 0.25;

if ($width < 500) {
  $scale = 0.4; // téléphone
} elseif ($width >= 1600) {
  $scale = 0.2; // très grand écran
}

?>

<div class="device-wrapper bg-white shadow rounded-xl overflow-hidden border border-gray-200 p-4">
  <div class="flex items-center justify-between px-2 pb-2 border-b border-gray-300">
    <div>
      <h2 class="font-semibold text-gray-800"><?php echo esc_html($device); ?></h2>
      <span class="text-sm text-gray-500"><?php echo "{$width} x {$height}"; ?></span>
    </div>
    <button onclick="toggleFullscreen(this)" class="text-blue-600 hover:text-blue-900 text-sm">Plein écran</button>
  </div>

  <div class="relative">
    <div
      class="device-scale mx-auto border border-indigo-300 rounded overflow-hidden shadow-lg"
      style="width: <?php echo $width * $scale; ?>px;
             height: <?php echo $height * $scale; ?>px;
             transform: scale(<?php echo $scale; ?>);
             transform-origin: top left;">
      <iframe
        src="<?php echo esc_url($site_url); ?>"
        style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px; border: none;"
      ></iframe>
    </div>
  </div>
</div>
