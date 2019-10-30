=== Header Footer for Beaver Builder ===
Contributors: brainstormforce, Nikschavan
Tags: header footer for beaver builder, beaver builder modules, customize header, beaver builder addon, beaver builder, beaver builder extensions, beaver addons, beaver builder free, page builder addons, beaver builder template, beaver builder header, customize footer
Donate link: https://www.paypal.me/BrainstormForce
Requires at least: 3.6
Tested up to: 5.2
Stable tag: 1.1.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An easy-to-use Beaver Builder addon to import pages or templates as a header or a footer across a Beaver Builder website.

== Description ==

Have you ever thought of a <a href="https://www.ultimatebeaver.com/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=description">Beaver Builder addon</a> that allows you to use customized templates and pages as a header or footer across your website? Header Footer for Beaver Builder adds a settings option to your page builder settings page making it easier to add customizable header and footer.

All you need to do is -

1. Design a Page or a Template you wish to use as a Header / Footer
2. Open the Page Builder settings page
3. Open the BB Header Footer settings
4. Select the page or template that you saved to be used as a header.

= Features of Header Footer for Beaver Builder =

- Create attractive pages and templates that can be displayed as a Header or Footer.
- Lets you use a fully customized header or footer across the website.

= Themes you can use the Header Footer for Beaver Builder with =

As of now, the Header Footer for Beaver Builder settings can be used with the following themes.

1. <a href="https://wpastra.com/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=description">Astra</a> - The Fastest, Most Lightweight &amp; Customizable WordPress Theme
2. Beaver Builder theme
3. Genesis Theme
4. GeneratePress Theme
5. Primer Theme
6. Neve Theme

= Supported & Actively Developed =
Need help with something? Have an issue to report? [Get in touch](https://github.com/Nikschavan/bb-header-footer "Header Footer for Beaver Builder on GitHub"). with us on GitHub.

= Here is a quick video explaining how this plugin works =

[youtube https://www.youtube.com/watch?v=GlHxpuSqZs4&feature=youtu.be]

Made with love at <a href="https://www.brainstormforce.com/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=description">Brainstorm Force</a>!

= What’s More? =

If you like this plugin, please leave us a good review and rating! Your feedback and
suggestions will be highly appreciated.
 
You can also consider checking out our other plugins:

<a href=”https://www.ultimatebeaver.com/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=other-plugins”>Ultimate Addons for Beaver Builder Lite</a>: The Best Addon for Beaver Builder with a huge collection of advanced and creative modules.

<a href=”https://www.ultimatebeaver.com/beaver-builder-freebies/expandable-row/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=other-plugins”>Expandable Row for Beaver Builder</a>: An advanced plugin that lets you expand your Beaver Builder rows.

<a href=”https://www.ultimatebeaver.com/beaver-builder-freebies/bbcards/?utm_source=wp-repo&utm_campaign= bbheaderfooter&utm_medium=other-plugins”>Timeline module for Beaver Builder</a>: An advanced module to create attractive and responsive timelines using Beaver Builder.

<a href=”https://www.ultimatebeaver.com/beaver-builder-freebies/bbalerts/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=other-plugins”>Alerts for Beaver Builder</a>: An advanced module to create attention seeking alerts in Beaver Builder.

<a href=”https://www.ultimatebeaver.com/beaver-builder-freebies/bbcards/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=other-plugins”>Cards for Beaver Builder </a>: An advanced module to create attractive cards using Beaver Builder.

<a href=”https://www.ultimatebeaver.com/beaver-builder-freebies/column-seperator/?utm_source=wp-repo&utm_campaign= bbheaderfooter&utm_medium=other-plugins”>Column Separator for Beaver Builder</a>: This plugin will no longer leave you pondering for a column separator in Beaver Builder. You can add it right away!

Visit our website to know more about the top WordPress products and services we offer. You can also stay updated with our upcoming endeavors by following us on
<a href=”https://www.brainstormforce.com/go/brainstorm-force-facebook-page/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=share”>Facebook</a> and <a
href=”https://www.brainstormforce.com/go/brainstorm-force-twitter-page/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=share”>Twitter</a>.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/bb-header-footer` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Page Builder-> BB Header Footer to select the page to be displayed as header and footer.


== Frequently Asked Questions ==

= Which themes are supported by this plugin? =

1. <a href="https://wpastra.com/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=description">Astra</a> - The Fastest, Most Lightweight &amp; Customizable WordPress Theme.
2. Beaver Builder theme.
3. Genesis Theme (and should work with most of its child themes).
4. GeneratePress Theme.
5. Primer Theme.
6. Neve Theme.

= How does this plugin work? =

1. Simply create a new page (or Beaver Builder Template)
2. Design it as you would like it for your header or footer
3. Then from admin settings, you can assign this page as a Header or Footer of your theme. [Screenshot](https://cloudup.com/ccBOWVTATyh "Screenshot")

== Changelog ==

= 1.1.8 =
- Fix: Load CSS/JS of Header and Footer in `<header>` fixing flash of unstyled content.

= 1.1.7 =
- Fix: Beaver Builder layout cache missing some of the static CSS and JS files.
- Fix: When editing the header / footer the layout was being duplicated.

= 1.1.6 =
- Fix: Menu module could not highlight the current menu item in the header template.
- Improvement: Load the Header and Footer JS in the `wp_qneueue_script`. earlier this was loaded right where the shortcode is added.
- Allow the plugin settings to be changed from child theme functions, This allows disabling and changing headers and footer per page from code.

= 1.1.5 =
- New: Added support for the <a href="https://wpastra.com/?utm_source=wp-repo&utm_campaign=bb-header-footer&utm_medium=description">Astra</a> WordPress theme - The Fastest, Most Lightweight &amp; Customizable WordPress Theme.
- Fix: Submenu hides behind the page content if sticky header is enabled.
- Fix: Shrink header option breaking the aspect ratio of the images.
- Fix: Transparent header and sticky header CSS is applied on the page even if custom header is not selected.

= 1.1.4 =
- Fix: Hide the default footer in generatepress and genesis theme.

= 1.1.3 =
- New: Added theme support for the primer theme and it's child themes.
- Improvement: Allow theme's to declare support for the plugin in their code.
- Improvement: Add header/footer on the page using Beaver Builders functions instead of adding via shortcodes.
- Improvement: Shrink header option now shrinks the header a bit more leaving some padding in the row.

= 1.1.2 =
- New: Sticky headers!

= 1.1.1 =
- Fix: Transparent header not working in case of bb-theme.

= 1.1.0 =
- New: Adds option to create transparent header.

= 1.0.1 =
- Fix: duplicate <header> tag when using generatepress theme.

= 1.0.0 =
- Initial release
