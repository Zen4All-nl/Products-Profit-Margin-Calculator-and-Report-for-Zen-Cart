<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_GET['pID']) && empty($_POST)) {
  $product = $db->Execute("SELECT p.products_cost, p.products_markup, p.products_margin_gross_dollar, p.products_margin_gross_percent
                           FROM " . TABLE_PRODUCTS . " p
                           WHERE p.products_id = " . (int)$p1->products_id);

  $pInfo->updateObjectInfo($product->fields);
}
?>
<script>
  let inputBlock = '';

  function updateCost() {
    const costValue = $('input[name="products_cost"]').val();

    $('input[name="products_cost"]').val(doRound(costValue, 4));
  }

  function updateMarkup() {
    const costValue = Number($('input[name="products_cost"]').val());
    const markupValue = Number($('input[name="products_markup"]').val());
    const markup = costValue + ((costValue * markupValue) / 100);

    $('input[name="products_price"]').val(doRound(markup, 4));
    updatemarginGrossDollar();
    updatemarginGrossPercent();
    updateGross();
  }

  function updatemarginGrossDollar() {
    const costValue = Number($('input[name="products_cost"]').val());
    const netValue = Number($('input[name="products_price"]').val());
    const marginGrossDollar = netValue - costValue;

    $('input[name="products_margin_gross_dollar"]').val(doRound(marginGrossDollar, 4));
  }

  function updatemarginGrossPercent() {
    const marginGrossDollarValue = Number($('input[name="products_margin_gross_dollar"]').val());
    const netValue = Number($('input[name="products_price"]').val());
    const marginGrossPercent = (marginGrossDollarValue / netValue) * 100;

    $('input[name="products_margin_gross_percent"]').val(doRound(marginGrossPercent, 4));
  }
  inputBlock = '<div class="well" style="color: #31708f;background-color: #f7f6ef;border-color: #bce8f1;;padding: 10px 10px 0 0;">\n';
  inputBlock += '<div class="col-sm-12 text"><?php echo TEXT_PRODUCTS_PRICE_MARGIN_CALCULATOR; ?></div>\n';
  inputBlock += '<div class="form-group">\n';
  inputBlock += '<?php echo zen_draw_label(TEXT_PRODUCTS_PRICE_COST, 'products_cost', 'class="col-sm-3 control-label"'); ?>\n';
  inputBlock += '<div class="col-sm-9 col-md-6">\n';
  inputBlock += '<?php echo zen_draw_input_field('products_cost', $pInfo->products_cost, 'onkeyup="updateMarkup();" class="form-control"'); ?>\n';
  inputBlock += '</div>\n';
  inputBlock += '</div>\n';
  inputBlock += '<div class="form-group">\n';
  inputBlock += '<?php echo zen_draw_label(TEXT_PRODUCTS_PRICE_MARKUP, 'products_markup', 'class="col-sm-3 control-label"'); ?>\n';
  inputBlock += '<div class="col-sm-9 col-md-6">\n';
  inputBlock += '<div class="input-group">\n';
  inputBlock += '<?php echo zen_draw_input_field('products_markup', $pInfo->products_markup, 'onkeyup="updateMarkup();" class="form-control"'); ?>\n';
  inputBlock += '<span class="input-group-addon">%</span>\n';
  inputBlock += '</div>\n';
  inputBlock += '</div>\n';
  inputBlock += '</div>\n';
  inputBlock += '<div class="form-group">\n';
  inputBlock += '<?php echo zen_draw_label(TEXT_PRODUCTS_PRICE_MARGIN_GROSS, 'products_margin_gross_dollar', 'class="col-sm-3 control-label"'); ?>\n';
  inputBlock += '<div class="col-sm-9 col-md-6">\n';
  inputBlock += '<?php echo zen_draw_input_field('products_margin_gross_dollar', $pInfo->products_margin_gross_dollar, 'onkeyup="updatemarginGrossDollar()" class="form-control" readonly'); ?>\n';
  inputBlock += '</div>\n';
  inputBlock += '</div>\n';
  inputBlock += '<div class="form-group">\n';
  inputBlock += '<?php echo zen_draw_label(TEXT_PRODUCTS_PRICE_MARGIN_GROSS_PERCENT, 'products_margin_gross_percent', 'class="col-sm-3 control-label"'); ?>\n';
  inputBlock += '<div class="col-sm-9 col-md-6">\n';
  inputBlock += '<div class="input-group">\n';
  inputBlock += '<?php echo zen_draw_input_field('products_margin_gross_percent', $pInfo->products_margin_gross_percent, 'onkeyup="updatemarginGrossPercent()" class="form-control" readonly'); ?>\n';
  inputBlock += '<span class="input-group-addon">%</span>\n';
  inputBlock += '</div>\n';
  inputBlock += '</div>\n';
  inputBlock += '</div>\n';
  inputBlock += '</div>\n';
  $(document).ready(function () {
    $(inputBlock).insertBefore('.well');
  });
</script>