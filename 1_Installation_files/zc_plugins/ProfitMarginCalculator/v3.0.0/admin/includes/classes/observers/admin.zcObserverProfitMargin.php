<?php

/**
 * Profit Margin Calculator module
 * @version 3.0.0
 * @author Zen4All
 * @copyright (c) 2014-2020, Zen4All
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG == false) {
  die('Invalid access.');
}

class profitMarginAdminObserver extends base {

  function __construct()
  {
    $this->attach($this, ['NOTIFY_MODULES_UPDATE_PRODUCT_END']);
  }

  function update(&$class, $eventID, $p1, &$p2, &$p3, &$p4)
  {
    switch ($eventID) {
      case 'NOTIFY_MODULES_UPDATE_PRODUCT_END': {
          $sql_data_array = [
            'products_cost' => convertToFloat($_POST['products_cost']),
            'products_markup' => convertToFloat($_POST['products_markup']),
            'products_margin_gross_dollar' => convertToFloat($_POST['products_margin_gross_dollar']),
            'products_margin_gross_percent' => convertToFloat($_POST['products_margin_gross_percent'])
          ];

          zen_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = " . (int)$p1['products_id']);
        }
    }
  }

}
