=== Plugin Name ===
Contributors: mlcapulong
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mlccapulong%40gmail%2ecom&lc=PH&item_name=Role%20Based%20Storage%20Limiter&item_number=rbsl&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: storage, limit, upload, role
Requires at least: 3.0.1
Tested up to: 4.7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This plugin allows the admin to set a storage limit (in MB) for each users based on their role. If the user attempts to upload a file, the plugin will check if the user meets the maximum amount of storage space and will throw an error.

Error messages can be customized by using the 'rbsl_sl_error_message' filter.

Initially, values are set as unlimited. Which means that all users will have unlimited storage space.

== Installation ==

= From your WordPress dashboard: =
1. Visit 'Plugins > Add New'
1. Search for 'Role Based Storage Limiter'
1. Activate Role Based Storage Limiter from your Plugins page.

= From WordPress.org: =
1. Download Role Based Storage Limiter.
1. Upload the 'role-based-storage-limiter' directory to your '/wp-content/plugins/' directory, using your favorite method (ftp, sftp, scp, etc...)
1. Activate Role Based Storage Limiter from your Plugins page.

After plugin activation, go to Settings > Storage Limiter.


== Screenshots ==

1. Plugin settings Page. Example of setting a 10MB limit to the Administrator Role
2. Adding new media in WordPress' admin page with an error thrown based on the set limit.
3. An example of the plugin in action on the a theme's front-end.