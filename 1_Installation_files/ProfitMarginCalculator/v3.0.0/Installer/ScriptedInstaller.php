<?php

use Zencart\PluginSupport\ScriptedInstaller as ScriptedInstallBase;

class ScriptedInstaller extends ScriptedInstallBase {

  protected function executeInstall()
  {
    global $db, $sniffer;
    $db->Execute("DELETE FROM " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_title = 'Profit Margin Calculator'");
    $db->Execute("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'PROFIT_MARGIN_VERSION'");

    zen_deregister_admin_pages(['configProfitMargin', 'reportsProfitMargin']);
    zen_register_admin_page('reportsProfitMargin', 'BOX_REPORTS_PRODUCTS_PROFIT', 'FILENAME_STATS_PRODUCTS_PROFIT', '', 'reports', 'Y', 50);

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
  }

  protected function executeUninstall()
  {
    zen_deregister_admin_pages(['configProfitMargin', 'reportsProfitMargin']);

    $deleteMap = "'DISPLAY_LOGS_MAX_DISPLAY', 'DISPLAY_LOGS_MAX_FILE_SIZE', 'DISPLAY_LOGS_INCLUDED_FILES', 'DISPLAY_LOGS_EXCLUDED_FILES'";

    $sql = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key IN (" . $deleteMap . ")";

    $this->executeInstallerSql($sql);
  }

}
