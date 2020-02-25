<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 *
 */

declare(strict_types = 1);

namespace Ergonode\ExporterMagento2\Infrastructure;

/**
 */
class Mapper
{
    /**
     * @var array
     */
    private array  $header = [
        'sku' => null,
        'store_view_code' => null,
        'attribute_set_code' => null,
        'product_type' => null,
        'categories' => null,
        'product_websites' => null,
        'name' => null,
        'description' => null,
        'short_description' => null,
        'weight' => null,
        'product_online' => null,
        'tax_class_name' => null,
        'visibility' => null,
        'price' => 'code_31',
        'special_price' => null,
        'special_price_from_date' => null,
        'special_price_to_date' => null,
        'url_key' => null,
        'meta_title' => null,
        'meta_keywords' => null,
        'meta_description' => null,
        'base_image' => null,
        'base_image_label' => null,
        'small_image' => null,
        'small_image_label' => null,
        'thumbnail_image' => null,
        'thumbnail_image_label' => null,
        'swatch_image' => null,
        'swatch_image_label' => null,
        'created_at' => null,
        'updated_at' => null,
        'new_from_date' => null,
        'new_to_date' => null,
        'display_product_options_in' => null,
        'map_price' => null,
        'msrp_price' => null,
        'map_enabled' => null,
        'gift_message_available' => null,
        'custom_design' => null,
        'custom_design_from' => null,
        'custom_design_to' => null,
        'custom_layout_update' => null,
        'page_layout' => null,
        'product_options_container' => null,
        'msrp_display_actual_price_type' => null,
        'country_of_manufacture' => null,
        'additional_attributes' => null,
        'qty' => null,
        'out_of_stock_qty' => null,
        'use_config_min_qty' => null,
        'is_qty_decimal' => null,
        'allow_backorders' => null,
        'use_config_backorders' => null,
        'min_cart_qty' => null,
        'use_config_min_sale_qty' => null,
        'max_cart_qty' => null,
        'use_config_max_sale_qty' => null,
        'is_in_stock' => null,
        'notify_on_stock_below' => null,
        'use_config_notify_stock_qty' => null,
        'manage_stock' => null,
        'use_config_manage_stock' => null,
        'use_config_qty_increments' => null,
        'qty_increments' => null,
        'use_config_enable_qty_inc' => null,
        'enable_qty_increments' => null,
        'is_decimal_divided' => null,
        'website_id' => null,
        'related_skus' => null,
        'related_position' => null,
        'crosssell_skus' => null,
        'crosssell_position' => null,
        'upsell_skus' => null,
        'upsell_position' => null,
        'additional_images' => null,
        'additional_image_labels' => null,
        'hide_from_product_page' => null,
        'custom_options' => null,
        'bundle_price_type' => null,
        'bundle_sku_type' => null,
        'bundle_price_view' => null,
        'bundle_weight_type' => null,
        'bundle_values' => null,
        'bundle_shipment_type' => null,
        'configurable_variations' => null,
        'configurable_variation_labels' => null,
        'associated_skus' => null,
    ];

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }
}
