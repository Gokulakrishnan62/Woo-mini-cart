<?php

defined('ABSPATH') || exit;

$enable_widgets =\MCW\App\Helpers\Database::get('enable_widgets', 0);
?>

<div class="mcw_page">
    <h2>Enable/Disable Widget</h2>

    <form id="mcw_show_widget">
        <label for="toggleButton">Enable to show Widget:</label>
        <input type="checkbox" id="toggleButton" <?php if ($enable_widgets) echo "checked"; ?>>
        <br>
        <input type="submit" id="mcw_action_widget">
    </form>
</div>