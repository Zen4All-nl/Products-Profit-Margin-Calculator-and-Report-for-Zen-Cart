<?php
/**
 */
require 'includes/application_top.php';
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">
    <link rel="stylesheet" href="includes/stylesheet.css">
    <link rel="stylesheet" media="print" href="includes/stylesheet_print.css">
    <script src="includes/general.js"></script>
  </head>
  <body>
    <!-- header //-->
    <div class="header-area">
      <?php require DIR_WS_INCLUDES . 'header.php'; ?>
    </div>
    <!-- header_eof //-->
    <?php
    $products_query_raw = "SELECT SUM(op.products_quantity) AS products_ordered, op.products_name,
                                  p.products_price,p.products_cost, op.products_id,
                                  SUM(p.products_cost * op.products_quantity) AS total_cost,
                                  (SUM(op.products_price) - SUM(p.products_cost)) AS total_profit
                           FROM " . TABLE_ORDERS_PRODUCTS . " op
                           LEFT JOIN " . TABLE_PRODUCTS . " p ON p.products_id = op.products_id
                           GROUP BY op.products_id, op.products_name
                           ORDER BY products_ordered DESC, products_name";

    $products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_REPORTS, $products_query_raw, $products_query_numrows);

    $products = $db->Execute($products_query_raw);
    ?>
    <!-- body //-->
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="panel-title"><?php echo HEADING_TITLE; ?></h1>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr class="dataTableHeadingRow">
              <th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_NUMBER; ?></th>
              <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
              <th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_PURCHASED; ?></th>
              <th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_TOTAL_COST; ?></th>
              <th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_TOTAL_PROFIT; ?>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product) { ?>
              <tr class="dataTableRow">
                <td class="dataTableContent text-right"><?php echo $product['products_id']; ?></td>
                <td class="dataTableContent"><a href="<?php echo zen_href_link(FILENAME_CATEGORY_PRODUCT_LISTING, 'cPath=' . zen_get_product_path($product['products_id']) . '&pID=' . $product['products_id']); ?>"><?php echo $product['products_name']; ?></a></td>
                <td class="dataTableContent text-right"><?php echo $product['products_ordered']; ?></td>
                <td class="dataTableContent text-right"><?php echo number_format($product['total_cost'], 2); ?></td>
                <td class="dataTableContent text-right"><?php echo number_format($product['total_profit'], 2); ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <table class="table panel-footer">
          <tr>
            <td><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, (int)$_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
            <td class="text-right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, MAX_DISPLAY_PAGE_LINKS, (int)$_GET['page']); ?></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- body_text_eof //-->
  </div>
  <!-- body_eof //-->

  <!-- footer //-->
  <div class="footer-area">
    <?php require DIR_WS_INCLUDES . 'footer.php'; ?>
  </div>
  <!-- footer_eof //-->
</body>
</html>
<?php require DIR_WS_INCLUDES . 'application_bottom.php'; ?>