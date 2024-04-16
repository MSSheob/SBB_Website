<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP News and Scrolling Widgets
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>
<div id="wpbaw_basic_tabs" class="wpbaw-vtab-cnt wpbaw_basic_tabs wpbaw-clearfix">
	<h3 style="text-align:center">Compare <span class="wpbaw-blue">"WP Blog and Widget"</span> Free VS Pro</h3>

	<div class="wpbaw-deal-offer-wrap">
		<div class="wpbaw-deal-offer"> 
			<div class="wpbaw-inn-deal-offer">
				<h3 class="wpbaw-inn-deal-hedding"><span>Buy WP Blog and Widgets Pro</span> today and unlock all the powerful features.</h3>
				<h4 class="wpbaw-inn-deal-sub-hedding"><span style="color:red;">Extra Bonus: </span>Users will get <span>extra best discount</span> on the regular price using this coupon code.</h4>
			</div>
			<div class="wpbaw-inn-deal-offer-btn">
				<div class="wpbaw-inn-deal-code"><span>EPSEXTRA</span></div>
				<a href="<?php echo esc_url(WPBAW_PLUGIN_BUNDLE_LINK); ?>"  target="_blank" class="wpbaw-sf-btn wpbaw-sf-btn-orange"><span class="dashicons dashicons-cart"></span> Get Essential Bundle Now</a>
				<em class="risk-free-guarantee"><span class="heading">Risk-Free Guarantee </span> - We offer a <span>30-day money back guarantee on all purchases</span>. If you are not happy with your purchases, we will refund your purchase. No questions asked!</em>
			</div>
		</div>
	</div>

	<table class="wpos-plugin-pricing-table">
		<colgroup></colgroup>
		<colgroup></colgroup>
		<colgroup></colgroup>
		<thead>
			<tr>
				<th></th>
				<th>
					<h2>Free</h2>
				</th>
				<th>
					<h2 class="wpos-epb">Premium</h2>
				</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<th>Designs <span>Designs that make your website better</span></th>
				<td>1</td>
				<td>120+</td>
			</tr>
			<tr>
				<th>Shortcodes <span>Shortcode provide output to the front-end side</span></th>
				<td>1 (Blog, Recent Blog)</td>
				<td>6 (Blog, Recent Blog, Slider, Gridbox , Gridbox Slider , List)</td>
			</tr>
			<tr>
				<th>Shortcode Parameters <span>Add extra power to the shortcode</span></th>
				<td>10</td>
				<td>30+</td>
			</tr>
			<tr>
				<th>Shortcode Generator <span>Play with all shortcode parameters with preview panel. No documentation required!!</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>WP Templating Features <span class="subtext">You can modify plugin html/designs in your current theme.</span></th>
				<td><i class="dashicons dashicons-no-alt"> </i></td>
				<td><i class="dashicons dashicons-yes"> </i></td>
			</tr>
			<tr>
				<th>Widgets<span> WordPress Widgets to your sidebars.</span></th>
				<td>1</td>
				<td>6</td>
			</tr>
			<tr>
				<th>Drag & Drop Post Order Change <span>Arrange your desired post with your desired order and display</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Gutenberg Block Supports <span>Use this plugin with Gutenberg easily</span></th>
				<td><i class="dashicons dashicons-yes"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Elementor Page Builder Support <em class="wpos-new-feature">New</em> <span>Use this plugin with Elementor easily</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Bevear Builder Support <em class="wpos-new-feature">New</em> <span>Use this plugin with Bevear Builder easily</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>SiteOrigin Page Builder Support <em class="wpos-new-feature">New</em> <span>Use this plugin with SiteOrigin easily</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Divi Page Builder Native Support <em class="wpos-new-feature">New</em> <span>Use this plugin with Divi Builder easily</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Fusion Page Builder (Avada) native support <em class="wpos-new-feature">New</em> <span>Use this plugin with Fusion(Avada) Builder easily</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>WPBakery Page Builder Supports <span>Use this plugin with Visual Composer/WPBakery Page Builder easily</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Custom Read More link for Post <span>Redirect post to third party destination if any</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Publicize <span> Support with Jetpack to publish your News post on</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr><tr>
				<th>Display Desired Post <span>Display only the post you want</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Display Post for Particular Categories <span>Display only the posts with particular category</span></th>
				<td><i class="dashicons dashicons-yes"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Exclude Some Posts <span>Do not display the posts you want</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Exclude Some Categories <span>Do not display the posts for particular categories</span></th>
				<td><i class="dashicons dashicons-no-alt"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Post Order / Order By Parameters <span>Display post according to date, title and etc</span></th>
				<td><i class="dashicons dashicons-yes"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Multiple Slider Parameters <span>Slider parameters like autoplay, number of slide, sider dots and etc.</span></th>
				<td><i class="dashicons dashicons-yes"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Slider RTL Support <span>Slider supports for RTL website</span></th>
				<td><i class="dashicons dashicons-yes"></i></td>
				<td><i class="dashicons dashicons-yes"></i></td>
			</tr>
			<tr>
				<th>Automatic Update <span>Get automatic  plugin updates </span></th>
				<td>Lifetime</td>
				<td>Lifetime</td>
			</tr>
			<tr>
				<th>Support <span>Get support for plugin</span></th>
				<td>Limited</td>
				<td>1 Year</td>
			</tr>
		</tbody>
	</table>
	<!-- End - Blog - Features -->
	<div class="wpbaw-deal-offer-wrap">
		<div class="wpbaw-deal-offer"> 
			<div class="wpbaw-inn-deal-offer">
				<h3 class="wpbaw-inn-deal-hedding"><span>Buy WP Blog and Widgets Pro</span> today and unlock all the powerful features.</h3>
				<h4 class="wpbaw-inn-deal-sub-hedding"><span style="color:red;">Extra Bonus: </span>Users will get <span>extra best discount</span> on the regular price using this coupon code.</h4>
			</div>
			<div class="wpbaw-inn-deal-offer-btn">
				<div class="wpbaw-inn-deal-code"><span>EPSEXTRA</span></div>
				<a href="<?php echo esc_url(WPBAW_PLUGIN_BUNDLE_LINK); ?>"  target="_blank" class="wpbaw-sf-btn wpbaw-sf-btn-orange"><span class="dashicons dashicons-cart"></span> Get Essential Bundle Now</a>
				<em class="risk-free-guarantee"><span class="heading">Risk-Free Guarantee </span> - We offer a <span>30-day money back guarantee on all purchases</span>. If you are not happy with your purchases, we will refund your purchase. No questions asked!</em>
			</div>
		</div>
	</div>
</div>