<?php

// use $configuration_group_id where needed
// For Admin Pages

$admin_page = 'configProfitMargin';
// delete configuration menu
$db->Execute("DELETE FROM " . TABLE_ADMIN_PAGES . " WHERE page_key = '" . $admin_page . "' LIMIT 1;");
// add configuration menu
if (!zen_page_key_exists($admin_page)) {
  if ((int)$configuration_group_id > 0) {
    zen_register_admin_page($admin_page,
        'BOX_CONFIGURATION_PROFIT_MARGIN',
        'FILENAME_CONFIGURATION',
        'gID=' . $configuration_group_id,
        'configuration',
        'Y',
        $configuration_group_id);

    $messageStack->add('Enabled MODULE Configuration Menu.', 'success');
  }
}

zen_register_admin_page('reportsProfitMargin',
    'BOX_REPORTS_PRODUCTS_PROFIT',
    'FILENAME_STATS_PRODUCTS_PROFIT',
    '',
    'reports',
    'Y',
    $configuration_group_id);

if (!$sniffer->field_exists(TABLE_PRODUCTS, 'products_cost')) {
  $db->Execute("ALTER TABLE " . TABLE_PRODUCTS . " ADD products_cost DECIMAL( 15, 4 ) DEFAULT '0.0000' NOT NULL AFTER products_price;");
}
if (!$sniffer->field_exists(TABLE_PRODUCTS, 'products_markup')) {
  $db->Execute("ALTER TABLE " . TABLE_PRODUCTS . " ADD products_markup DECIMAL( 15, 4 ) DEFAULT '0.0000' NOT NULL AFTER products_cost;");
}
if (!$sniffer->field_exists(TABLE_PRODUCTS, 'products_margin_gross_dollar')) {
  $db->Execute("ALTER TABLE " . TABLE_PRODUCTS . " ADD products_margin_gross_dollar DECIMAL( 15, 4 ) DEFAULT '0.0000' NOT NULL AFTER products_markup;");
}
if (!$sniffer->field_exists(TABLE_PRODUCTS, 'products_margin_gross_percent')) {
  $db->Execute("ALTER TABLE " . TABLE_PRODUCTS . " ADD products_margin_gross_percent DECIMAL( 15, 4 ) DEFAULT '0.0000' NOT NULL AFTER products_margin_gross_dollar;");
}