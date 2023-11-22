<?php

defined('ABSPATH') || exit;

isset($data) || exit;
?>
<div class="widget-container">
    <div class="mcw-widget">
        <h2>widget</h2>
        <p>This is a simple widget in the top right corner.</p>
    </div>
</div>

<div id="mcw-cart-sidebar">
    <?php include_once MCW_PLUGIN_PATH . 'Template/Contents.php'; ?>
</div>
