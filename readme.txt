=== Tabbed Account Area for Easy Digital Downloads ===
Contributors: scott.deluzio
Tags: Easy Digital Downloads, Affiliate WP
Requires at least: 2.8.0
Tested up to: 4.9
Stable tag: 1.0.3
License: GNU Version 2 or Any Later Version

Shortcode to create tabbed account area for Easy Digital Downloads and AffiliateWP

== Description ==
Create a one-page account area with relevant sections separated by tabs. Include purchase history, license keys, user profile editor, and more all with one easy to use shortcode.

If a user is not logged in they will automatically be shown the EDD Login form.

Include the following content in your user's account area:

* Download History
* Purchase History
* Profile Editor
* Download Discounts
* Subscriptions**
* EDD Wish Lists (and wish list editor)**
* EDD Deposit**
* EDD License Keys**
* Affiliate Area**

** Requires additional or add-on plugins

== Installation ==
Search for Tabbed Account Area in the WordPress.org plugin directory. Install and activate the plugin.
No settings are required for this plugin.


== Frequently Asked Questions ==
= How do I use the plugin? =
The plugin creates a shortcode `[account_tabs]`, which can be inserted into any page on your site where you would like your customers to access their account information.

The shortcode has a number of attributes you can use to customize the output of these tabs. Tabs will be displayed in the order that you include these attributes:

* download_history
* purchase_history
* edd_profile_editor
* edd_subscriptions
* download_discounts
* edd_wish_lists_edit
* edd_wish_lists
* edd_deposit
* edd_license_keys
* affiliate_area

For each attribute, you can assign a title, which will be used for the tab's name. For example, the following shortcode would display your customer's purchase history and profile editor:

[account_tabs purchase_history="Purchase History" edd_profile_editor="Edit Your Profile"]

The tabs would have the text "Purchase History" and "Edit Your Profile" respectively. When the customer clicks on either tab, the appropriate content would be displayed.

= Can I style my tabs? =
The plugin comes with three style options.

1. The default option is the tabs at the top of the content
2. Tabs to the left of the content
3. Tabs to the right of the content

There is also the possibility to use custom CSS to style your tabs.

You would indicate the style you wish to use by including the style attribute in the shortcode with the appropriate position:

* [account_tabs style="default"]
* [account_tabs style="left"]
* [account_tabs style="right"]
* [account_tabs style="custom"]

If you choose to use the custom style option, you will need to add a file to your theme.

Add a file called taa.css to the css folder in your current theme or child theme. If no css folder exists, you can create one for this purpose.

/wp-content/themes/your-theme/css/taa.css

= I'm using AffiliateWP, how can I keep the visitor on the Affiliate tab when they click one of the sub-tabs? =
In your AffiliateWP settings, make sure that the Affiliate Area page is the same as the page that includes the [account_tabs] shortcode.

Also, if you are including the style attribute in the shortcode, make sure that it is listed after the affiliate_area attribute.

= How do I reorder the tabs? =
The tabs will be listed in the order you have the respective attributes in the shortcode.

For example, [account_tabs purchase_history="Purchase History" edd_profile_editor="Edit Your Profile"] will have Purchase History first, and Edit Your Profile second. [account_tabs edd_profile_editor="Edit Your Profile" purchase_history="Purchase History"] will have Edit Your Profile first, and Purchase History second.

== Changelog ==
= 1.0.3 =
* Fix: JavaScript for tabs was being loaded on all front end pages. On pages where [account_tabs] shortcode wasn't present this produced an error.
* New: Included translatable .pot file.
= 1.0.2 =
* Fix: When using tabs along with AffiliateWP, clicking the Affiliate sub tabs would redirect the page causing the affiliate tab to no longer be active. Fix keeps the Affiliate tab set, but reqires the Affiliate Area page in AffiliateWP settings to be the same page as your EDD account page where the [account_tabs] shortcode is placed.
= 1.0.1 =
* Fix: Corrected an issue that caused Recaptcha form to not load correctly if using the affiliate_area shortcode.
= 1.0.0 =
* Initial Release

== Upgrade Notice ==
= 1.0.3 =
* Fix: JavaScript for tabs was being loaded on all front end pages. On pages where [account_tabs] shortcode wasn't present this produced an error.
* New: Included translatable .pot file.