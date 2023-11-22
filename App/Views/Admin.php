<?php

defined('ABSPATH') || exit;

$widget_data =\MCW\App\Helpers\Database::get('settings', '');

if (empty($widget_data)) {
    $widget_data = \MCW\App\Helpers\Template::getDefaultData();
}
?>

<div id="mcw_admin_page" class="col-8 mt-2 p-3">
    <!--    navbar-->
    <ul class="nav nav-pills mb-3 d-flex justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="customize-tab" data-bs-toggle="pill" data-bs-target="#wmc-customize" type="button" role="tab" aria-controls="customize" aria-selected="true">Customization</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="styling-tab" data-bs-toggle="pill" data-bs-target="#wmc-style" type="button" role="tab" aria-controls="styling" aria-selected="false">Styling</button>
        </li>
    </ul>
    <form id="mcw_show_widget" method="POST" enctype="multipart/form-data">
        <div class="tab-content" id="pills-tabContent">
            <!--        customization-->
            <div class="tab-pane fade show active" id="wmc-customize" role="tabpanel" aria-labelledby="customize-tab" tabindex="0">
                <div id="content-header">
                    <h6>Mini-Cart header</h6>
                    <div class="p-2 col-md-12">
                        <div class="custom-control custom-checkbox row">
                            <div class="col-md-2">
                                <label class="custom-control-label font-weight-medium">Show icon</label>
                            </div>
                            <div class="col-md-4">
                                <input class="custom-control-input" type="checkbox" name="show_icon_in_header" value="1" <?php if (!empty($widget_data['show_icon_in_header'])) echo 'checked'; ?>>
                            </div>
                        </div>
                        <div class="custom-control custom-input row mt-2">
                            <div class="col-md-2">
                                <label class="form-label font-weight-medium">Cart title</label>
                            </div>
                            <div class="col-md-4">
                                <input class="custom-control-input" type="text" name="header_title" value="<?php echo esc_attr($widget_data['header_title']); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-separator mt-2"></div>

                <div id="content-body">
                    <h6>Mini-Cart Body</h6>
                    <div class="p-2 col-md-12">
                        <div class="custom-control custom-checkbox row">
                            <div class="col-md-2">
                                <label class="custom-control-label font-weight-medium">Show delete icon</label>
                            </div>
                            <div class="col-md-4">
                                <input class="custom-control-input" type="checkbox" name="show_remove_item_option" value="1" <?php if (!empty($widget_data['show_remove_item_option'])) echo 'checked'; ?>>
                            </div>
                        </div>
                        <div class="custom-control row mt-2">
                            <div class="col-md-2">
                                <label class="custom-control-label font-weight-medium">Product Price</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" name="product_price_format">
                                    <option value="actual_price" <?php selected('actual_price', $widget_data['product_price_format']); ?>>Show actual price</option>
                                    <option value="regular_and_sale_price" <?php selected('regular_and_sale_price', $widget_data['product_price_format']); ?>>Show regular and sale price</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-separator mt-2"></div>

                <div id="content-footer">
                    <h5>Mini-Cart Footer</h5>
                    <div class="p-2 col-md-12">
                        <div>
                            <div class="row">
                                <div class="custom-control custom-input row">
                                    <div class="col-md-2">
                                        <label class="form-label font-weight-medium">Checkout cta</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="custom-control-input" type="text" name="checkout_cta_text" value="<?php echo esc_attr($widget_data['checkout_cta_text']); ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="custom-control custom-input row mt-2">
                                    <div class="col-md-2">
                                        <label class="form-label">Continue cta</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="custom-control-input" type="text" name="continue_cta_text" value="<?php echo esc_attr($widget_data['continue_cta_text']); ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="custom-control custom-checkbox row">
                                    <div class="col-md-2">
                                        <label class="custom-control-label font-weight-medium">Show cart button</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="mcw-show-cart-button custom-control custom-switch" type="checkbox" name="data[show_cart_button_in_footer]" value="1" <?php if (!empty($widget_data['show_cart_button_in_footer'])) echo 'checked'; ?>>
                                    </div>
                                </div>
                                <div class="mcw-cart-button-cta custom-control custom-input row mt-2" style="<?php if (empty($widget_data['show_cart_button_in_footer'])) echo 'display: none'; ?>" >
                                    <div class="col-md-2">
                                        <label class="form-label font-weight-medium">Cart cta</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="custom-control-input" type="text" name="cart_cta_text" value="<?php echo esc_attr($widget_data['cart_cta_text']); ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--        styling-->
            <div class="tab-pane fade"  id="wmc-style" role="tabpanel" aria-labelledby="styling-tab" tabindex="0">
                <div class="tab-content">
                    <div id="style-header">
                        <h6>Mini-Cart header</h6>
                        <div class="p-2 col-md-12">
                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium">font size</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="style[header][font-size]">
                                        <option value="" <?php selected('', $widget_data['style']['header']['font-size']); ?>>default</option>
                                        <option value="4px" <?php selected('4px', $widget_data['style']['header']['font-size']); ?>>4px</option>
                                        <option value="8px" <?php selected('8px', $widget_data['style']['header']['font-size']); ?>>8px</option>
                                        <option value="12px" <?php selected('12px', $widget_data['style']['header']['font-size']); ?>>12px</option>
                                        <option value="16px" <?php selected('16px', $widget_data['style']['header']['font-size']); ?>>16px</option>
                                        <option value="24px" <?php selected('24px', $widget_data['style']['header']['font-size']); ?>>24px</option>
                                    </select>
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium">background</label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color" value="1">
                                    <input type="text" class="mcw-color-input form-control w-50"  name="style[header][background-color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['header']['background-color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium">color</label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color" value="1">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[header][color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['header']['color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="content-body">
                        <h6>Mini-Cart Body</h6>
                        <div class="p-2 col-md-12">
                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium">font size</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="style[body][font-size]">
                                        <option value="" <?php selected('', $widget_data['style']['body']['font-size']); ?>>default</option>
                                        <option value="4px" <?php selected('4px', $widget_data['style']['body']['font-size']); ?>>4px</option>
                                        <option value="8px" <?php selected('8px', $widget_data['style']['body']['font-size']); ?>>8px</option>
                                        <option value="12px" <?php selected('12px', $widget_data['style']['body']['font-size']); ?>>12px</option>
                                        <option value="16px" <?php selected('16px', $widget_data['style']['body']['font-size']); ?>>16px</option>
                                        <option value="24px" <?php selected('24px', $widget_data['style']['body']['font-size']); ?>>24px</option>
                                    </select>
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium">background</label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color" value="">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[body][background-color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['body']['background-color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium">color</label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color" value="1">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[body][color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['body']['color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="content-footer" style="width: 100%;">
                        <h6>Mini-Cart Footer</h6>
                        <div class="p-2 col-md-12">
                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium">font size</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="style[footer][font-size]">
                                        <option value="" <?php selected('', $widget_data['style']['footer']['font-size']); ?>>default</option>
                                        <option value="4px" <?php selected('4px', $widget_data['style']['footer']['font-size']); ?>>4px</option>
                                        <option value="8px" <?php selected('8px', $widget_data['style']['footer']['font-size']); ?>>8px</option>
                                        <option value="12px" <?php selected('12px', $widget_data['style']['footer']['font-size']); ?>>12px</option>
                                        <option value="16px" <?php selected('16px', $widget_data['style']['footer']['font-size']); ?>>16px</option>
                                        <option value="24px" <?php selected('24px', $widget_data['style']['footer']['font-size']); ?>>24px</option>
                                    </select>
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium">background</label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color" value="1">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[footer][background-color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['footer']['background-color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium">color</label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color" value="1">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[footer][color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['footer']['color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="d-flex justify-content-between">
        <div id="mcw_action_widget">
            <button class="btn btn-success">Save</button>
        </div>
        <div id="mcw_reset_button">
            <button class="btn btn-primary">Reset</button>
        </div>
    </div>
</div>