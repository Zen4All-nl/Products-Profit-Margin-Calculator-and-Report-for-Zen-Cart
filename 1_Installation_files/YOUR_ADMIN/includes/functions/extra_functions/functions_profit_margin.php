<?php

// Computes Products_Cost
function zen_get_products_base_cost($products_id)
{
  global $db;
  $product_check = $db->Execute("SELECT products_cost
                                 FROM " . TABLE_PRODUCTS . "
                                 WHERE products_id = " . (int)$products_id);

// is there a products_price to add to attributes
  $products_cost = $product_check->fields['products_cost'];

  //$the_cost_price = 0;
  $the_cost_price = $products_cost;
  if (zen_not_null($the_cost_price)) {
    return $the_cost_price;
  } else {
    return false;
  }
}

// Display's Cost Price
function zen_get_products_display_cost($products_id)
{
  global $currencies, $db;

  $product_check = $db->Execute("SELECT products_tax_class_id
                                 FROM " . TABLE_PRODUCTS . "
                                 WHERE products_id = " . (int)$products_id);

  $display_cost_price = zen_get_products_base_cost($products_id);
  $show_normal_price = $currencies->display_price($display_cost_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));

  if (zen_not_null($show_normal_price)) {
    return $show_normal_price;
  } else {
    return false;
  }
}

// Computes Direct Margin
function zen_get_products_base_direct_margin($products_id)
{
  $products_cost = zen_get_products_base_cost($products_id);
  $products_price = zen_get_products_base_price($products_id);

//  $the_cost_price = 0;
  $the_cost_price = number_format((($products_price - $products_cost) / $products_price * 100), 2, '.', '');

  if (zen_not_null($the_cost_price)) {
    return $the_cost_price;
  } else {
    return false;
  }
}

// Display's Direct Margin
function zen_get_products_display_direct_margin($products_id)
{
  $display_direct_margin = zen_get_products_base_direct_margin($products_id);
  $percent = "%";
  return $display_direct_margin . $percent;
}
