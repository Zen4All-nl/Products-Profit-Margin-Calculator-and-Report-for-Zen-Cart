DELETE FROM admin_pages WHERE page_key LIKE '%ProfitMargin';
DELETE FROM configuration WHERE configuration_key LIKE 'PROFIT_MARGIN_%';
DELETE FROM configuration_group WHERE configuration_group_title = 'Profit Margin Calculator Settings' LIMIT 1;