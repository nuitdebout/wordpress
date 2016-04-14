=== Login LockDown ===
Developer: Michael VanDeMar (michael@endlesspoetry.com)
Tags: security, login
Requires at least: 3.6
Tested up to: 4.0
Stable Tag: 1.6.1

Limits the number of login attempts from a given IP range within a certain time period.

== Description ==

Login LockDown records the IP address and timestamp of every failed login attempt. If more than a 
certain number of attempts are detected within a short period of time from the same
IP range, then the login function is disabled for all requests from that range.
This helps to prevent brute force password discovery. Currently the plugin defaults
to a 1 hour lock out of an IP block after 3 failed login attempts within 5 minutes. This can be modified
via the Options panel. Admisitrators can release locked out IP ranges manually from the panel.

== Installation ==

1. Extract the zip file into your plugins directory into its own folder.
2. Activate the plugin in the Plugin options.
3. Customize the settings from the Options panel, if desired.

Enjoy.

== Change Log ==

 ver. 1.6.1 8-Mar-2014

 - fixed html glitch preventing options from being saved

 ver. 1.6 7-Mar-2014

 - cleaned up deprecated functions
 - fixed bug with invalid property on a non-object when locking out invalid usernames
 - fixed utilization of $wpdb->prepare
 - added more descriptive help text to each of the options
 - added the ability to remove the "Login form protected by Login LockDown." message from within the dashboard

 ver. 1.5 17-Sep-2009

 - implemented wp_nonce security in the options and lockdown release forms in the admin screen
 - fixed a security hole with an improperly escaped SQL query
 - encoded certain outputs in the admin panel using esc_attr() to prevent XSS attacks
 - fixed an issue with the 'Lockout Invalid Usernames' option not functioning as intended

 ver. 1.4 29-Aug-2009

 - removed erroneous error affecting WP 2.8+
 - fixed activation error caused by customizing the location of the wp-content folder
 - added in the option to mask which specific login error (invalid username or invalid password) was generated
 - added in the option to lock out failed login attempts even if the username doesn't exist

 ver. 1.3 23-Feb-2009
 - adjusted positioning of plugin byline
 - allowed for dynamic location of plugin files

 ver. 1.2 15-Jun-2008

 - now compatible with WordPress 2.5 and up only

 ver. 1.1 01-Sep-2007

 - revised time query to MySQL 4.0 compatability

 ver. 1.0 29-Aug-2007

 - released

