<?php
if (!defined('ABSPATH')) exit;

$width = $res['width'];
$height = $res['height'];

// Calcul dynamique de l'échelle par défaut
$default_scale = 0.25;
if ($width < 500) {
  $default_scale = 0.4; // téléphone
} elseif ($width >= 1600) {
  $default_scale = 0.2; // très grand écran
}

// Générer un ID unique pour ce device
$device_id = sanitize_title($device);
?>

<div class="device-card bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300">
  <!-- Header de la carte -->
  <div class="device-header flex items-center justify-between px-4 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
    <div class="flex-1">
      <h2 class="font-semibold text-white"><?php echo esc_html($device); ?></h2>
      <span class="text-sm text-indigo-100"><?php echo "{$width} x {$height}"; ?></span>
    </div>
    <button onclick="toggleFullscreen(this)" class="fullscreen-btn bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-3 py-1 rounded-lg text-sm font-medium transition-all duration-200">
      <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
      </svg>
      Plein écran
    </button>
  </div>

  <!-- Conteneur iframe avec gestion d'erreur -->
  <div class="device-content p-4 bg-gray-50">
    <div class="device-preview-container relative bg-white rounded-lg shadow-inner overflow-hidden">
      <div 
        class="device-scale mx-auto"
        id="device-<?php echo $device_id; ?>"
        data-width="<?php echo $width; ?>"
        data-height="<?php echo $height; ?>"
        data-default-scale="<?php echo $default_scale; ?>"
        style="width: <?php echo $width * $default_scale; ?>px; height: <?php echo $height * $default_scale; ?>px;">
        
        <!-- Iframe avec gestion d'erreur -->
        <iframe
          src="<?php echo esc_url($site_url); ?>"
          style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px; border: none; transform: scale(<?php echo $default_scale; ?>); transform-origin: top left;"
          class="device-iframe block"
          onload="handleIframeLoad(this)"
          onerror="handleIframeError(this)"
        ></iframe>
        
        <!-- Message d'erreur (caché par défaut) -->
        <div class="iframe-error-message hidden absolute inset-0 flex items-center justify-center bg-red-50 border-2 border-red-200 rounded-lg">
          <div class="text-center p-4">
            <svg class="w-12 h-12 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-red-700 font-medium">Erreur de chargement</p>
            <p class="text-red-600 text-sm">Cette page ne peut pas être affichée dans un iframe</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Contrôle de zoom -->
    <div class="zoom-controls mt-4 px-2">
      <div class="flex items-center justify-between mb-2">
        <label class="text-sm font-medium text-gray-700">Zoom</label>
        <span class="zoom-value text-sm text-gray-500" id="zoom-value-<?php echo $device_id; ?>"><?php echo round($default_scale * 100); ?>%</span>
      </div>
      <div class="flex items-center space-x-3">
        <button class="zoom-btn zoom-out text-gray-400 hover:text-gray-600" onclick="adjustZoom('<?php echo $device_id; ?>', -0.05)">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
          </svg>
        </button>
        <input 
          type="range" 
          class="zoom-slider flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
          id="zoom-slider-<?php echo $device_id; ?>"
          min="0.1" 
          max="1" 
          step="0.05" 
          value="<?php echo $default_scale; ?>"
          oninput="updateZoom('<?php echo $device_id; ?>', this.value)"
        />
        <button class="zoom-btn zoom-in text-gray-400 hover:text-gray-600" onclick="adjustZoom('<?php echo $device_id; ?>', 0.05)">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</div>
