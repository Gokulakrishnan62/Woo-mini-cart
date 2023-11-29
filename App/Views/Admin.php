<?php

defined('ABSPATH') || exit;

$widget_data = function_exists('get_option') ? get_option('mcw_settings') : '';

if (empty($widget_data)) {
    $widget_data = \MCW\App\Helpers\Template::getDefaultData();
}
?>

<div id="mcw-admin-page" class="col-8 mt-2 p-3">
    <!--    navbar-->
    <ul class="nav nav-pills mb-3 d-flex justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="customize-tab" data-bs-toggle="pill" data-bs-target="#mcw-customize" type="button" role="tab" aria-controls="customize" aria-selected="true"><?php esc_html_e('Customization', 'mini-cart-woocommerce'); ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="styling-tab" data-bs-toggle="pill" data-bs-target="#mcw-style" type="button" role="tab" aria-controls="styling" aria-selected="false"><?php esc_html_e('Styling', 'mini-cart-woocommerce'); ?></button>
        </li>
    </ul>
    <form id="mcw-show-widget" method="POST" enctype="multipart/form-data">
        <div class="tab-content" id="pills-tabContent">
            <!-- customization -->
            <div class="tab-pane fade show active" id="mcw-customize" role="tabpanel" aria-labelledby="customize-tab" tabindex="0">
                <div id="content-header">
                    <h6><?php esc_html_e('Header', 'mini-cart-woocommerce'); ?></h6>
                    <div class="p-2 col-md-12">
                        <div class="custom-control custom-checkbox row">
                            <div class="col-md-2">
                                <label class="custom-control-label font-weight-medium"><?php esc_html_e('Show icon', 'mini-cart-woocommerce'); ?></label>
                            </div>
                            <div class="col-md-4">
                                <input class="custom-control-input" type="checkbox" name="data[header][icon][show]" value="1" <?php if (!empty($widget_data['data']['header']['icon']['show'])) echo 'checked'; ?>>
                            </div>
                        </div>
                        <div class="custom-control custom-input row mt-2">
                            <div class="col-md-2">
                                <label class="form-label font-weight-medium"><?php esc_html_e('Cart title', 'mini-cart-woocommerce'); ?></label>
                            </div>
                            <div class="col-md-4">
                                <input class="custom-control-input" type="text" name="data[header][title]" value="<?php echo esc_attr($widget_data['data']['header']['title']); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-separator mt-2"></div>

                <div id="content-items">
                    <h6><?php esc_html_e('Items', 'mini-cart-woocommerce'); ?></h6>
                    <div class="p-2 col-md-12">
                        <div class="custom-control custom-checkbox row">
                            <div class="col-md-2">
                                <label class="custom-control-label font-weight-medium"><?php esc_html_e('Show delete icon', 'mini-cart-woocommerce'); ?></label>
                            </div>
                            <div class="col-md-4">
                                <input class="custom-control-input" type="checkbox" name="data[items][item][show_remove_option]" value="1" <?php if (!empty($widget_data['data']['items']['item']['show_remove_option'])) echo 'checked'; ?>>
                            </div>
                        </div>
                        <div class="custom-control row mt-2">
                            <div class="col-md-2">
                                <label class="custom-control-label font-weight-medium"><?php esc_html_e('Product Price', 'mini-cart-woocommerce'); ?></label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" name="data[items][item][price_format]">
                                    <option value="actual_price" <?php selected('actual_price', $widget_data['data']['items']['item']['price_format']); ?>><?php esc_html_e('Show actual price', 'mini-cart-woocommerce'); ?></option>
                                    <option value="regular_and_sale_price" <?php selected('regular_and_sale_price', $widget_data['data']['items']['item']['price_format']); ?>><?php esc_html_e('Show regular and sale price', 'mini-cart-woocommerce'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-separator mt-2"></div>

                <div id="content-coupon">
                    <h6><?php esc_html_e('Coupon', 'mini-cart-woocommerce'); ?></h6>
                    <div class="p-2 col-md-12">
                        <div class="custom-control row mt-2">
                            <div class="col-md-2">
                                <label class="custom-control-label font-weight-medium"><?php esc_html_e('Prefix', 'mini-cart-woocommerce'); ?></label>
                            </div>
                            <div class="col-md-4">
                                <input class="custom-control-input" type="text" name="data[coupons][coupon][sub_title]" value="<?php echo esc_attr($widget_data['data']['coupons']['coupon']['sub_title']); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-separator mt-2"></div>

                <div id="content-actions">
                    <h6><?php esc_html_e('Actions', 'mini-cart-woocommerce'); ?></h6>
                    <div class="p-2 col-md-12">
                        <div class="row mt-2 d-flex" style="height: 50px;">
                            <div class="custom-control custom-checkbox row">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('Show Checkout button', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="col-md-4 d-flex align-items-center gap-2 mcw-show-action">
                                    <input class="mcw-show-button custom-control custom-switch" type="checkbox" name="data[actions][checkout][enabled]" value="1" <?php if (!empty($widget_data['data']['actions']['checkout']['enabled'])) echo 'checked'; ?>>
                                    <div class="mcw-show-button-details custom-control custom-input row" style="<?php if (empty($widget_data['data']['actions']['checkout']['enabled'])) echo 'display: none'; ?>" >
                                        <div class="col-md-12">
                                            <input class="custom-control-input" type="text" name="data[actions][checkout][cta]" value="<?php echo esc_attr($widget_data['data']['actions']['checkout']['cta']); ?>" placeholder="<?php esc_html_e('enter cta', 'mini-cart-woocommerce'); ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 d-flex" style="height: 50px;">
                            <div class="custom-control custom-checkbox row">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('Show Cart button', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="col-md-4 d-flex align-items-center gap-2 mcw-show-action">
                                    <input class="mcw-show-button custom-control custom-switch" type="checkbox" name="data[actions][cart][enabled]" value="1" <?php if (!empty($widget_data['data']['actions']['cart']['enabled'])) echo 'checked'; ?>>
                                    <div class="mcw-show-button-details custom-control custom-input row" style="<?php if (empty($widget_data['data']['actions']['cart']['enabled'])) echo 'display: none'; ?>" >
                                        <div class="col-md-4">
                                            <input class="custom-control-input" type="text" name="data[actions][cart][cta]" value="<?php echo esc_attr($widget_data['data']['actions']['cart']['cta']); ?>" placeholder="<?php esc_html_e('enter cta', 'mini-cart-woocommerce'); ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 d-flex" style="height: 50px;">
                            <div class="custom-control custom-checkbox row">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('Show Shop button', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="col-md-6 d-flex align-items-center gap-2 mcw-show-action">
                                    <input class="mcw-show-button custom-control custom-switch" type="checkbox" name="data[actions][shop][enabled]" value="1" <?php if (!empty($widget_data['data']['actions']['shop']['enabled'])) echo 'checked'; ?>>
                                    <div class="mcw-show-button-details custom-control custom-input row" style="<?php if (empty($widget_data['data']['actions']['shop']['enabled'])) echo 'display: none'; ?>" >
                                        <div class="col-md-4">
                                            <input class="custom-control-input" type="text" name="data[actions][shop][cta]" value="<?php echo esc_attr($widget_data['data']['actions']['shop']['cta']); ?>" placeholder="<?php esc_html_e('enter cta', 'mini-cart-woocommerce'); ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="content-footer">
                    <h6><?php esc_html_e('Footer', 'mini-cart-woocommerce'); ?></h6>
                    <div class="p-2 col-md-12">
                        <div class="custom-control custom-checkbox row">
                            <div class="col-md-2">
                                <label class="custom-control-label font-weight-medium"><?php esc_html_e('Show discount amount', 'mini-cart-woocommerce'); ?></label>
                            </div>
                            <div class="col-md-4">
                                <input class="custom-control-input" type="checkbox" name="data[footer][show][discount]" value="1" <?php if (!empty($widget_data['data']['footer']['show']['discount'])) echo 'checked'; ?>>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox row mt-2">
                            <div class="col-md-2">
                                <label class="custom-control-label font-weight-medium"><?php esc_html_e('Show total amount', 'mini-cart-woocommerce'); ?></label>
                            </div>
                            <div class="col-md-4">
                                <input class="custom-control-input" type="checkbox" name="data[footer][show][total]" value="1" <?php if (!empty($widget_data['data']['footer']['show']['total'])) echo 'checked'; ?>>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- styling -->
            <div class="tab-pane fade"  id="mcw-style" role="tabpanel" aria-labelledby="styling-tab" tabindex="0">
                <div class="tab-content">
                    <div id="style-widget">
                        <h6><?php esc_html_e('Widget', 'mini-cart-woocommerce'); ?></h6>
                        <div class="p-2 col-md-12">
                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('background', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50"  name="style[widget][background-color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['widget']['background-color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('color', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[widget][color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['widget']['color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="style-header">
                        <h6><?php esc_html_e('Header', 'mini-cart-woocommerce'); ?></h6>
                        <div class="p-2 col-md-12">
                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('font size', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="style[header][font-size]">
                                        <option value="32px" <?php selected('32px', $widget_data['style']['header']['font-size']); ?>>default</option>
                                        <option value="12px" <?php selected('12px', $widget_data['style']['header']['font-size']); ?>>12px</option>
                                        <option value="16px" <?php selected('16px', $widget_data['style']['header']['font-size']); ?>>16px</option>
                                        <option value="24px" <?php selected('24px', $widget_data['style']['header']['font-size']); ?>>24px</option>
                                    </select>
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('background', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50"  name="style[header][background-color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['header']['background-color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('color', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[header][color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['header']['color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="content-body">
                        <h6><?php esc_html_e('Body', 'mini-cart-woocommerce'); ?></h6>
                        <div class="p-2 col-md-12">
                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('font size', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="style[body][font-size]">
                                        <option value="16px" <?php selected('16px', $widget_data['style']['body']['font-size']); ?>>default</option>
                                        <option value="12px" <?php selected('12px', $widget_data['style']['body']['font-size']); ?>>12px</option>
                                        <option value="18px" <?php selected('18px', $widget_data['style']['body']['font-size']); ?>>16px</option>
                                        <option value="24px" <?php selected('24px', $widget_data['style']['body']['font-size']); ?>>24px</option>
                                    </select>
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('background', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[body][background-color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['body']['background-color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('color', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[body][color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['body']['color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="content-coupon">
                        <h6><?php esc_html_e('Coupon', 'mini-cart-woocommerce'); ?></h6>
                        <div class="p-2 col-md-12">
                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('font size', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="style[coupon][font-size]">
                                        <option value="16px" <?php selected('16px', $widget_data['style']['coupon']['font-size']); ?>>default</option>
                                        <option value="12px" <?php selected('12px', $widget_data['style']['coupon']['font-size']); ?>>12px</option>
                                        <option value="18px" <?php selected('18px', $widget_data['style']['coupon']['font-size']); ?>>16px</option>
                                        <option value="24px" <?php selected('24px', $widget_data['style']['coupon']['font-size']); ?>>24px</option>
                                    </select>
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('background', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[coupon][background-color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['coupon']['background-color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('color', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[coupon][color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['coupon']['color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="content-footer" style="width: 100%;">
                        <h6><?php esc_html_e('Footer', 'mini-cart-woocommerce'); ?></h6>
                        <div class="p-2 col-md-12">
                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('font size', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="style[footer][font-size]">
                                        <option value="24px" <?php selected('24px', $widget_data['style']['footer']['font-size']); ?>>default</option>
                                        <option value="12px" <?php selected('12px', $widget_data['style']['footer']['font-size']); ?>>12px</option>
                                        <option value="16px" <?php selected('16px', $widget_data['style']['footer']['font-size']); ?>>16px</option>
                                        <option value="18px" <?php selected('18px', $widget_data['style']['footer']['font-size']); ?>>18px</option>
                                    </select>
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('background', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[footer][background-color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['footer']['background-color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('color', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[footer][color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['footer']['color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="content-action" style="width: 100%;">
                        <h6><?php esc_html_e('Actions', 'mini-cart-woocommerce'); ?></h6>
                        <div class="p-2 col-md-12">
                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('font size', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="style[action][font-size]">
                                        <option value="16px" <?php selected('16px', $widget_data['style']['action']['font-size']); ?>>default</option>
                                        <option value="12px" <?php selected('12px', $widget_data['style']['action']['font-size']); ?>>12px</option>
                                        <option value="18px" <?php selected('18px', $widget_data['style']['action']['font-size']); ?>>18px</option>
                                        <option value="24px" <?php selected('24px', $widget_data['style']['action']['font-size']); ?>>24px</option>
                                    </select>
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('background', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[action][background-color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['action']['background-color']); ?>"
                                           maxlength="7" placeholder="">
                                </div>
                            </div>

                            <div class="custom-control row mt-2">
                                <div class="col-md-2">
                                    <label class="custom-control-label font-weight-medium"><?php esc_html_e('color', 'mini-cart-woocommerce'); ?></label>
                                </div>
                                <div class="mcw-color-inputs col-md-4 d-flex">
                                    <input class="mcw-color-picker form-control form-control-color" type="color">
                                    <input type="text" class="mcw-color-input form-control w-50" name="style[action][color]" data-name="" data-target="" value="<?php echo esc_attr($widget_data['style']['action']['color']); ?>"
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
        <div id="mcw-action-widget">
            <button class="btn btn-success"><?php esc_html_e('Save', 'mini-cart-woocommerce'); ?></button>
        </div>
        <div id="mcw-reset-button">
            <button class="btn btn-primary"><?php esc_html_e('Reset', 'mini-cart-woocommerce'); ?></button>
        </div>
    </div>
</div>