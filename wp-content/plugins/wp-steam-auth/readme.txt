=== WP Steam Auth ===
Contributors: hwk-fr
Donate link: http://hwk.fr/
Tags: Steam, Steam Auth, Steam Authentification, Openid, OAuth, Register, Login, User, Avatar
Requires at least: 4.0
Tested up to: 4.7.4
Stable tag: 0.6.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Register, Login & Synchronize WP Users via Steam Authentification

== Description ==

This plugin will let your visitors register & login to your Wordpress via their Steam account using one and unique button.

All new authentification will create a new Wordpress legacy user and will be automatically logged in the process. Once they are registered via Steam, users may login to your Wordpress using the same Steam button.

Old WP users (registered before the plugin activation) have the possibility to synchronize their account with Steam once loggedin with the legacy Wordpress system.

Note: WP Steam Auth Plugin is fully compatible with Wordpress & Buddypress. Steam profile data is stored in the WP_user meta data. WP Steam Auth doesn't interfere with the legacy WP Login/Registration system, it means that you'll be always able to login with the legacy method.

= Features: =

* Register/Login with one unique button
* Automatically create a new Wordpress legacy user
* Automatically Upload the Steam avatar during registration
* Choose to use the wordpress avatar or the steam avatar
* Synchronize button available for old WP Users
* Customize the Post-login & Post-Logout URL, or use Referer instead
* Customize URLs & base slugs (Login / Sync. / Logout)
* Login/Register via a popup for a better user experience
* Manage users Steam synchronization in WP users dashboard
* Force ReSync. for specific (or bulk) users
* Remove Sync. for specific (or bulk) users

= Contributions: =

* Improved version of [PHP library Steam Authentification](https://github.com/SmItH197/SteamAuthentication) by SmItH197 ([demo](http://bensmith.in/steam/))
* [The original Steam Openid script](http://pastebin.com/6vZT4RhD) by JTX
* [The LightopenID library](http://gitorious.org/lightopenid)

= My Other Plugins: =

* [WP 404 Auto Redirect to Similar Post](https://wordpress.org/plugins/wp-404-auto-redirect-to-similar-post/)
* [WP G2A Goldmine CD Keys Affiliate](https://wordpress.org/plugins/wp-g2a-goldmine-cd-keys-affiliate/)

== Installation ==

= Wordpress Install =

1. Upload the plugin files to the `/wp-content/plugins/wp-steam-auth` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Setup your Steam API via: http://steamcommunity.com/dev/apikey
4. Use the Settings->Steam Auth screen to configure the plugin
5. Add the shortcode [wp_steam_auth] in your page or use available php functions

= Available Shortcode =

* `[wp_steam_auth]`
* `[wp_steam_auth login_text="Login via Steam"]`
* `[wp_steam_auth login_class="my_class1 my_class2"]`
* `[wp_steam_auth login_image="http://..."]`
* `[wp_steam_auth logout_text="Logout"]`
* `[wp_steam_auth logout_class="my_class1 my_class2"]`
* `[wp_steam_auth logout_image="http://..."]`
* `[wp_steam_auth show_sync="1"]`
* `[wp_steam_auth sync_text="Synchronize"]`
* `[wp_steam_auth sync_class="my_class1 my_class2"]`
* `[wp_steam_auth sync_image="http://..."]`

= Available PHP Functions =

* `<?php wpsap_button_login(); ?>`
* `<?php wpsap_button_sync(); ?>`
* `<?php wpsap_button_loggout(); ?>`
* `<?php echo wpsap_button_login_url(); ?>`
* `<?php echo wpsap_button_sync_url(); ?>`
* `<?php echo wpsap_button_loggout_url(); ?>`
* `<?php if(!wpsap_is_user_synced()){ wpsap_button_sync(); } ?>`

== Frequently Asked Questions ==

= Do I need a Steam API key? =

Yes, you can get one for free here: http://steamcommunity.com/dev/apikey

= How can I display the "Login via Steam" button? =

Use the following Shortcode:

* `[wp_steam_auth]`

Or the following PHP functions:

* `<?php wpsap_button_login(); ?>`
* `<?php wpsap_button_sync(); ?>`
* `<?php wpsap_button_loggout(); ?>`
* `<?php echo wpsap_button_login_url(); ?>`
* `<?php echo wpsap_button_sync_url(); ?>`
* `<?php echo wpsap_button_loggout_url(); ?>`
* `<?php if(!wpsap_is_user_synced()){ wpsap_button_sync(); } ?>`

= What is the "Force ReSync." feature? =

This will instantly logout the user. On the next login with Steam, the WP Steam Profile will be updated with latest Steam data (Profile URL, Avatar, Sync. date etc...)

= What is the "Remove Sync." feature? =

This will instantly logout the user & remove the WP Steam Profile. The user won't be able to log back via Steam. He will need to login via legacy WP method and then synchronize manually. Cannot be undone.

== Screenshots ==

1. WP Steam Auth Settings
2. WP Users Dashboard
2. WP User Profile with "Steam" section

== Changelog ==

= 0.6.4 =
* Added Shortcode functionality: [wp_steam_auth]. More details on settings page.

= 0.6.3 =
* Fixed Javascript bug on popup closure when website use hashtags.

= 0.6.2 =
* Fixed a bug for PHP < 5.5 version: "Can't use function return value in write context"

= 0.6.1 =
* Added Buddypress compatibility: Avatars via bp_avatar_filter()

= 0.6.0.3 =
* Fixed typo & code

= 0.6.0.1 =
* Fixed screenshots with description

= 0.6 =
* Added JS in admin for better UX
* Added WP Users dashboard Sync date
* Added Steam Profile section in the WP User Profile
* Added to capatibility to force ReSync. for specific users (This will instantly logout the user. On the next login with Steam, the WP Steam Profile will be updated with latest Steam data: Profile URL, Avatar, Sync. date etc...) 
* Added to capatibility to Remove Sync. for specific users (This will remove the WP Steam Profile. The user won't be able to log back via Steam. He will need to login via legacy WP method and then synchronize manually.)
* Improved code & requires

= 0.5.2 =
* Added URL Rewriting Settings (Login / Sync / Logout)
* Added Logout Redirection + Referer options
* Improved code

= 0.5.0.2 =
* Removed session_start()

= 0.5.0.1 =
* Checking if LightOpenID already exists before require
* Better ABS path names
* Better custom filters names
* Better session_start encapsulation
* Removed ob_start()

= 0.5 =
* Initial Release

== Upgrade Notice ==

None