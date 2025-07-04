<?php
if (!defined('ABSPATH')) exit; // sécurité
?>
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">ResponsiveLens – Aperçu Responsive Multi-écran</h1>

    <form method="post" class="mb-6">
        <label for="responsivelens_url" class="block mb-2 font-semibold">URL à prévisualiser :</label>
        <input
            type="url"
            name="responsivelens_url"
            id="responsivelens_url"
            value="<?php echo esc_attr($site_url); ?>"
            class="w-full p-2 border border-gray-300 rounded"
            placeholder="https://exemple.com"
            required
        />
        <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Sauvegarder</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <?php foreach ($devices as $device => $res): ?>
            <?php include plugin_dir_path(__FILE__) . 'device-card.php'; ?>
        <?php endforeach; ?>
    </div>
</div>

