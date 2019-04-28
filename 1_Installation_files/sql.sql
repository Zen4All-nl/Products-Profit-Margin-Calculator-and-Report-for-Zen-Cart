ALTER TABLE `products` ADD `products_cost` DECIMAL( 15, 4 ) DEFAULT '0.0000' NOT NULL AFTER `products_price` ;
ALTER TABLE `products` ADD `products_markup` DECIMAL( 15, 4 ) DEFAULT '0.0000' NOT NULL AFTER `products_cost` ;
ALTER TABLE `products` ADD `products_margin_gross_dollar` DECIMAL( 15, 4 ) DEFAULT '0.0000' NOT NULL AFTER `products_markup` ;
ALTER TABLE `products` ADD `products_margin_gross_percent` DECIMAL( 15, 4 ) DEFAULT '0.0000' NOT NULL AFTER `products_margin_gross_dollar` ;
ALTER TABLE `orders_products` ADD `products_cost` DECIMAL( 15, 4 ) DEFAULT '0.0000' NOT NULL AFTER `products_price` ;