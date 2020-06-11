<?php

if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG == false) {
  die('Invalid access.');
}

class profitMarginAdminObserver extends base {

  function __construct()
  {
    global $db;
    $this->attach($this, array('NOTIFY_MODULES_UPDATE_PRODUCT_END'));
  }

  function update(&$class, $eventID, $p1, &$p2, &$p3, &$p4)
  {
    switch ($eventID) {
      case 'NOTIFY_MODULES_UPDATE_PRODUCT_END': {
          $sql_data_array['products_cost'] = convertToFloat($_POST['products_cost']);
          $sql_data_array['products_markup'] = convertToFloat($_POST['products_markup']);
          $sql_data_array['products_margin_gross_dollar'] = convertToFloat($_POST['products_margin_gross_dollar']);
          $sql_data_array['products_margin_gross_percent'] = convertToFloat($_POST['products_margin_gross_percent']);

          zen_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = " . (int)$p2);
        }
    }
  }

}
