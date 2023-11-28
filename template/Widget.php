<?php

defined('ABSPATH') || exit;

if (empty($data)) {
    return;
}
?>
<div class="widget-container" style="<?php echo esc_attr($data['style']['widget']);?> ">
    <div class="mcw-widget">
        <div id="mcw-widget-icon">
            <svg width="48px" height="48px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                <title>ionicons-v5-d</title>
                <circle cx="176" cy="416" r="16" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/>
                <circle cx="400" cy="416" r="16" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/>
                <polyline points="48 80 112 80 160 352 416 352" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/>
                <path d="M160,288H409.44a8,8,0,0,0,7.85-6.43l28.8-144a8,8,0,0,0-7.85-9.57H128" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/>
            </svg>
        </div>
    </div>
</div>

<div id="mcw-cart-sidebar" style="<?php echo esc_attr($data['style']['body']);?> ">
    <?php include_once MCW_PLUGIN_PATH . 'template/Contents.php'; ?>
</div>