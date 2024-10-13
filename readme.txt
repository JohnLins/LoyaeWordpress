=== Loyae ===
Contributors: loyae
Tags: SEO, alt text, AI, meta tags, open graph
Requires at least: 4.7
Tested up to: 6.5.2
Stable tag: 1.0.2
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
AI-generated HTML metadata and alt text in bulk for SEO; automatically inserts into select pages.
== Description ==
[Loyae](https://loyae.com/) seamlessly uses machine learning to optimize web pages for searchability (SEO), usability, and accessibility by automatically generating & inserting metadata/alt text.


== Screenshots ==
Select the pages you want to optimize (You may select them all)
1. screenshot-1
Meta tags:
2. screenshot-2
Alt text:
3. screenshot-3


Generate meta descriptions, alt text, open graph meta tags, and much much more.

[youtube https://youtu.be/SXJGmWoe99Q]



== 3rd Parties ==
For legal reasons, here are all 3rd party APIs used:

The only external API that the Loyae plugin interfaces with is via the api.loyae.com endpoints. Loyae's API interfaces with other 3rd party APIs on the back-end, such as authorize.net for payments (https://www.authorize.net/about-us/terms.html); Loyae is PCI-compliant.


Internal:

Check prices API (it also records the homepage as the "who" parameter, this is for customer insight):
https://api.loyae.com/prices?who=

Credits your account:
https://api.loyae.com/optimize/fund


Main API endpoint (used for generating the metadata):
https://api.loyae.com/optimize/manual
This endpoint inputs the content and images of a given page of your website.

Loyae terms: https://loyae.com/terms.pdf




