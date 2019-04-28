Products Profit/Margin Calculator with Report
==========
Update to v1.2 by stellarweb July 5 2010
===========================================
Updated core files listed in changelog to work with latest zen cart version 1.3.9d


===========================================
Update to v1.1 by halbert February 20, 2007
===========================================
The original v1 of this contribution only adds the price and markup fields to the general product_type.

I added support for the other document_product, product_free_shipping, and product_music product types.

Installation instructions remain the same.

All other work for this contribution was done by others (see original documentation below)

=========================================================================
This contribution is a combination of the following:

Profit Margin Calculator v1.12 by Farrukh
Products Profit and Cost Report v1 by Farrukh

Basically, all I did was combine the two contributions together, and updated it to work with 1.3.5. The SQL file included in this package inserts data for both contributions in one run.

===WHAT DOES THIS CONTRIBUTION DO?===
Well, in short, it allows you to add a cost field to your products and allow you to track your profit. Its not a perfect contribution, but its on its way there. A report under Admin->Reports will show you what your profit is :)

===HOW DO I GET IT TO WORK?===
BACKUP BACKUP BACKUP!!!!!! BOTH DB AND FILES!!!

Log into your Zencart and go to Tools -> Install SQL Patches. Copy and paste everything that is inside your SQL.sql file bundled with this release and click "Send".

After that is done, upload everything in the directory structure it is in. Please note that this WILL overwrite some of your files. BE SURE TO HAVE A GOOD BACKUP OF YOUR SITE BEFORE DOING THIS!

Once you have uploaded it, you need to set product cost where you define the products price. You will see more boxes that show up. Please note that product price is automatically generated, so you shouldn't put anything in the original Product Price (net/gross) boxes. In fact, if you have anything in there - erase it. Now, put in the cost of the product and the markup percent. Gross margin $ and Gross margin % are automatically calculated for you - just tab through them.

YOU NEED TO TAB THROUGH THESE FIELDS - DO NOT LEAVE THESE 4 FIELDS EMPTY.

Once you tab through those 4 fields, you should see Products Price (Net) updated. Products Price (Gross) may or may not update - don't worry about it, it will be set whenever you save it.


===KNOWN ISSUES===
*Products Price (Gross) does not update when you tab through everything for some reason.
*Gross Margin $, Gross Margin % are not updated until you tab through them.
*When an item is deleted, it shows up as cost $0.00 and selling price $0.00
*If an item's cost is updated, it is reflected for ALL sales. Should only be reflected for sales from now on. Easy way to get around this is to duplicate the product who's cost fell, and deactivate the old one (don't delete)

===Questions, Comments===
Please feel free to post up at the zen cart boards. http://www.zen-cart.com/forum/showthread.php?t=45475