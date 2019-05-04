<?php
if ($sniffer->field_exists(TABLE_ORDERS_PRODUCTS, 'products_cost')) {
  $db->Execute("ALTER TABLE " . TABLE_ORDERS_PRODUCTS . " DROP `products_cost`;");
}