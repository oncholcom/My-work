<?php
/** Create pages upon theme activation **/
add_action('init', 'arc_add_required_options', 9999);
if (is_admin()){
	add_action('init', 'arc_create_initial');
	add_action('init', 'arc_create_page_content', 9999);
	add_action('admin_init', 'arc_check_woocommerce', 9999);
	add_action('widgets_init', 'unregister_default_wp_widgets', 1);
	add_action('widgets_init', 'set_default_theme_widgets', 10, 2); //work after activate theme

	add_action('after_switch_theme', 'set_default_theme_widgets', 10, 2); //work after switch theme
}
function arc_add_required_options() {
	if(get_option('faqs_test') === false) {
		$arr_faqs = [
			"faq_item_0" => "What is " . get_bloginfo( 'name' ) . "?~SEP_BITWEEN_Q~" . get_bloginfo( 'name' ) . " is a 100% free streaming adult video site, proudly hosting hundreds of thousands of videos. We can offer you content from any genre you crave.~SEP_GROUP_TYPE~General",
			"faq_item_1" => "What is the Favorites icon?~SEP_BITWEEN_Q~If you mark videos and photos as Favorites, they will automatically be stored on our server, so that YOU can find them more easily in the future. ~SEP_GROUP_TYPE~General",
			"faq_item_2" => "Is it possible to download videos from " . get_bloginfo( 'name' ) . "?~SEP_BITWEEN_Q~Yes. You can download videos that our users have uploaded for free.  ~SEP_GROUP_TYPE~General",
			"faq_item_3"  => "I forgot my password. What should I do?~SEP_BITWEEN_Q~To restore your password, follow this link: www.mypornsite.com/lostpass.~SEP_GROUP_TYPE~General",
			"faq_item_4" => "Is it possible to change my username?~SEP_BITWEEN_Q~No, unfortunately not. If you want to change your username, you will have to create a new account, using a different email address. ~SEP_GROUP_TYPE~General",
			"faq_item_5" => "Why was one of the videos from my Favorites deleted?~SEP_BITWEEN_Q~A video can be removed by the uploader or by a moderator due to issues such as abuse, copyright, etc. ~SEP_GROUP_TYPE~General",
			"faq_item_6"  => "Is there a limit to the number of subscriptions?~SEP_BITWEEN_Q~No, you may subscribe to as many users as you wish.~SEP_GROUP_TYPE~General",
			"faq_item_7"  => "How do I access my subscriptions?~SEP_BITWEEN_Q~To see all the profiles you are subscribed to, go to Account Settings and choose the My Subscriptions tab.~SEP_GROUP_TYPE~General",
			"faq_item_8"  => "How do I delete my account?~SEP_BITWEEN_Q~Log into your account, choose the Account Settings option, and you will find the Delete account button at the bottom of the page. To complete the process, you will have to click on the link sent to the account’s email address.~SEP_GROUP_TYPE~General",
			"faq_item_9"  => "Is it possible to get rid of ads on this site?~SEP_BITWEEN_Q~Yes. If you become a Premium member for a monthly subscription fee, you can enjoy watching videos - ads free. Just follow this link: www.mypornsite.com/premium.~SEP_GROUP_TYPE~General",
			"faq_item_10"  => "Could you add a movie titled ~SEP_BITWEEN_Q~" . get_bloginfo( 'name' ) . " is a webisite for user-generated content. We don’t upload the content ourselves. ~SEP_GROUP_TYPE~General",
			"faq_item_11"  => "Can you notify me when a new video comes up?~SEP_BITWEEN_Q~Yes. We will email you when a user you are subscribed to uploads a new video.~SEP_GROUP_TYPE~General",
			"faq_item_12"  => "Can I get paid for any kind of video uploads?~SEP_BITWEEN_Q~No. We do not pay for video uploads.~SEP_GROUP_TYPE~General",
			"faq_item_13"  => "Is it possible for me to place ads on " . get_bloginfo( 'name' ) . "?~SEP_BITWEEN_Q~Please contact us at ww.mypornsite.com/contact/.~SEP_GROUP_TYPE~General",
			"faq_item_14"  => "How can I exchange links / trade traffic with " . get_bloginfo( 'name' ) . "?~SEP_BITWEEN_Q~Sorry, but that option is not currently available. However, feel free to link to our pages :)~SEP_GROUP_TYPE~General",
			"faq_item_15"  => "How do I get in touch with you if something goes wrong?~SEP_BITWEEN_Q~If you ever have any questions, queries or concerns, please don’t hesitate to contact our support at www.mypornsite.com/contact/.~SEP_GROUP_TYPE~General",
			"faq_item_16"  => "I noticed my copyrighted content on " . get_bloginfo( 'name' ) . ". How can I have it removed?~SEP_BITWEEN_Q~Send us a request with the subject “Copyright Issue.” Please include a direct link to the content (for example, www.mypornsite.com/videotitle).~SEP_GROUP_TYPE~Abuses",
			"faq_item_17"  => " I noticed that a movie with me appeared on " . get_bloginfo( 'name' ) . ". How can I have it removed?~SEP_BITWEEN_Q~Send us a request with the subject “Copyright Issue.” Please include a direct link to the content (for example, www.mypornsite.com/videotitle).~SEP_GROUP_TYPE~Abuses",
			"faq_item_18"  => " I noticed illegal content (rape, zoo, cp) on " . get_bloginfo( 'name' ) . ". How can I have it removed?~SEP_BITWEEN_Q~Send us a request with the subject “Content Removal Request.” Please include the direct link to such content (for example, www.mypornsite.com/videotitle).~SEP_GROUP_TYPE~Abuses",
			"faq_item_19"  => "How can I upload videos?~SEP_BITWEEN_Q~To upload to " . get_bloginfo( 'name' ) . ", first you need an account with a validated email. You can upload your video from our Upload page.\nYou can upload videos either from your computer, or from a direct URL to the video (supported formats are .mp4 and .webm).\nPlease read our Terms and Conditions and the Privacy Policy. Uploading a video means that you agree with our Terms.~SEP_GROUP_TYPE~Uploads",
			"faq_item_20"  => "What video formats can I upload?~SEP_BITWEEN_Q~The file types we support are webm and mp4. If you upload a different file type, our system will not recognize your video codec. Please convert your file into webm or mp4 before uploading.~SEP_GROUP_TYPE~Uploads",
			"faq_item_21"  => "What image formats can I upload?~SEP_BITWEEN_Q~The file types we support are jpg, png, and gif. If you upload a different file type, our system may not recognize it as an image. Please convert your file into jpg, png, or gif before uploading.~SEP_GROUP_TYPE~Uploads",
			"faq_item_22"  => "I've uploaded a video. When can I expect it to become published?~SEP_BITWEEN_Q~Your video needs to be moderated before we publish it. This usually takes about X days. Once approved, you will find your video on the My Uploads page.~SEP_GROUP_TYPE~Uploads",
			"faq_item_23"  => "Your upload form is closed, and I can’t upload any videos.~SEP_BITWEEN_Q~Due to the large number of uploaded videos that require conversion, our servers sometimes disconnect. They will be up and running soon. We apologize for the inconvenience.~SEP_GROUP_TYPE~Uploads",
			"faq_item_24"  => "My video has a green screen, what can I do?~SEP_BITWEEN_Q~To fix the issue, please follow this link: www.lifehacker.com/5796783/fix-a-green-screen-on-flash-videos-by-disabling-hardware-acceleration.~SEP_GROUP_TYPE~Uploads",
			"faq_item_25"  => "I’ve uploaded content and now it’s deleted? Why?~SEP_BITWEEN_Q~All content that goes against our Terms and Conditions will be removed. Never upload:\n- Copyrighted content or content which you don't have the legal rights to post\n- Content with defecation, scat, etc.\n- Content involving animals\n- Content involving underage individuals, also content with individuals who appear underage\n- Content showing violence (rape or harm to body)\n- Incest content or content with incest-related titles\n- Content of a very bad quality\n\nAlso, we remove reposts and broken files (files with conversion errors).~SEP_GROUP_TYPE~Uploads",
			"faq_item_26"  => "How do I delete my video?~SEP_BITWEEN_Q~To delete your video, open My Uploads and click on the quick edit icon, then choose the Delete video option. Another way to do this is: view the video and click on Edit video, then Delete video. To complete the process, you will have to click on the link sent to the account’s email address.~SEP_GROUP_TYPE~Uploads",
			"faq_item_27"  => "How do I delete my pictures?~SEP_BITWEEN_Q~Open your image album and click on the “X” button above the thumbnail for every image that you want to delete. If you wish to delete an entire album at once, choose Delete album. To complete the process, you will have to click on the link sent to the account’s email address.~SEP_GROUP_TYPE~Uploads",
			"faq_item_28"  => "Is it possible to restore movies / pictures / community posts that I have deleted?~SEP_BITWEEN_Q~Unfortunately, it’s not possible. You will have to submit them again.~SEP_GROUP_TYPE~Uploads",
			"faq_item_29"  => "I can't log in. What should I do?~SEP_BITWEEN_Q~You may be unable to log into your account if it has been closed or if your cookies are disabled. Try enabling your browser cookies and then refresh the page. Please double-check your password. To restore your password, follow the link: www.mypornsite.com/lostpass.~SEP_GROUP_TYPE~Technical",
			"faq_item_30"  => "The video keeps buffering while I'm watching. What's wrong?~SEP_BITWEEN_Q~This may happen for two reasons: Your internet connection speed or server overload on our side. We are constantly working to keep our servers up to speed. Thank you for your patience!~SEP_GROUP_TYPE~Technical",
			"faq_item_31"  => "How can I enable cookies?~SEP_BITWEEN_Q~You will find the instructions here: www.www.google.com/cookies.html.~SEP_GROUP_TYPE~Technical",
			"faq_item_32"  => "How do I delete a video from my favorites?~SEP_BITWEEN_Q~To remove a video from your favorites, go to My Favorites, then click the “X” icon on the video thumbnail. The selected video will be deleted from your favorites.~SEP_GROUP_TYPE~Technical",
			"faq_item_33"  => "How do I delete a picture from my favorites?~SEP_BITWEEN_Q~To remove a picture from your favorites, go to My Favorites, then click the “X” icon on the image thumbnail. The selected picture will be deleted from your favorites.~SEP_GROUP_TYPE~Technical",
			"faq_item_34"  => "How can I upload a profile picture to my account?~SEP_BITWEEN_Q~Go to My Account, and choose Select a file. Adjust your image and then click on the Crop and Save button. Finally, click on Update your profile.~SEP_GROUP_TYPE~Technical",
			"faq_item_35"  => "I have no sound. How can I fix it?~SEP_BITWEEN_Q~Please check the sound icon to see if sound is muted. If that is not the issue, please send up a report with the subject “General Inquiries” and describe the problem.~SEP_GROUP_TYPE~Technical"
		];
		add_option('faqs_test', $arr_faqs, 'yes');
	}

}

function arc_create_initial() {
	if(get_option('customizer_rewrite') === false) {
		$customizer_settings = array ( 'custom_logo' => '', 'nav_menu_locations' => array ( 'arc-main-menu' => 4641, 'arc-footer-menu' => 4635, ), 'background_color' => '#172030', 'main_color_setting' => '#0F1725', 'btn_color_setting' => '#c32ce2', 'links_color_setting' => '#ffffff', 'icons_color_setting' => '#c32ce2', 'btn_hover_color_setting' => '#aa2cc4', 'text_site_color' => '#ffffff', 'custom_css_post_id' => -1, 'header_textcolor' => 'blank', 'grey_back_color' => '#181c26', 'primary_color_setting' => '#1e2739', 'secondary_color_setting' => '#242f4c', 'main_advertising_setting_header' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-1.png', 'premium_popup_image_file' => '', 'subscribe_preview_show' => false, 'subscribe_login_color' => '#FFFFFF', 'show_billings_details' => true, 'disc_preview' => false, 'show_preview_cookie' => false, 'on_tab_tagline' => true, 'under_title_tagline' => false, 'site_icon' => '', 'copyright_setting' => '
Created by <a href="https://vicetemple.com/">Citadel Solutions B.V.</a> Copyright ' . date("Y") .' · All rights reserved', 'background_image' => '', 'code_setting' => '', 'meta_setting' => '', 'other_code_setting' => '', 'mob_code_setting' => '', 'seo_title' => '', 'seo_setting' => '', 'title-desc-pos' => 'bottom', 'title_desc_categ_pos' => 'bottomCat', 'seo_cat_title' => '', 'seo_cat_text' => '', 'title_desc_tags_pos' => 'bottom', 'seo_tags_title' => '', 'seo_tags_text' => '', 'seo_actors_title' => '', 'seo_actors_text' => '', 'title_desc_pos_actors' => 'bottom', 'title_desc_blog_pos' => 'bottom', 'seo_blog_title' => '', 'seo_blog_text' => '', 'title_desc_photos_pos' => 'bottom', 'seo_photos_title' => '', 'seo_photos_text' => '', 'firstname_show' => 'required', 'company_show' => 'hidden', 'country_show' => 'hidden', 'city_show' => 'optional', 'postcode_show' => 'optional', 'phone_show' => 'optional', 'disc_show' => true, 'show_cookie' => true, 'cookie_text' => '
<p>We use cookies to provide our services. By using this website, you agree to this.</p>

', 'agree_btn_text' => 'Agree', 'cookie_dropdownpages' => 9342, 'popup_preview_show' => false, 'popup_time_anim' => '300px', 'cookie_block_color' => '#0F1725', 'cookie_text_pos' => 'leftPos', 'cookie_agree_btn_pos' => 'fixed', 'cookie_btn_text_color' => '#ffffff', 'cookie_btn_color' => '#C32CE2', 'policy_link_color' => '#FFFFFF', 'policy_link_color_on_hover' => '#C32CE2', 'cookie_btn_close_color' => '#5B5B5B', 'cookie_btn_color_on_hover' => '#AA2CC4', 'disc_back_opacity' => '87', 'disc_back_color' => '#181C26', 'disc_back_blur' => '2', 'disc_form_opacity' => '100', 'disc_form_back_color' => '#172030', 'disc_form_header' => '
<p>Are you 18 or older?</p>

', 'disc_form_text' => '
<p>You must verify that you are 18 years of age or older to enter this site.</p>

', 'disc_form_btn_yes_text' => '
Yes

', 'disc_form_yes_btn_color' => '#C32CE2', 'disc_form_yes_btn_color_on_hover' => '#AA2CC4', 'disc_form_btn_no_text' => '
No

', 'disc_form_no_btn_color' => '#FFFFFF', 'disc_form_no_btn_color_on_hover' => '#ffffff', 'disc_nope_form_header1' => '
<p>We\'re sorry!</p>

', 'disc_nope_form_header2' => '
<p>You must be 18 years of age or older to enter this site</p>

', 'disc_nope_form_text' => '
<p>I hit the wrong button</p>

', 'disc_nope_form_btn_text' => '
Okay, bye!

', 'disc_nope_form_btn_color' => '#C32CE2', 'disc_nope_form_btn_color_on_hover' => '#AA2CC4', 'disc_nope_form_link' => '', 'lastname_show' => 'required', 'main_advertising_setting_sidebar' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-2.png', 'main_advertising_setting_video_left' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-2.png', 'main_advertising_setting_video_under' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-3.png', 'main_advertising_setting_footer' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-3.png', 'before_play_ad_zone1' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-2.png', 'before_play_ad_zone2' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-2.png', 'on_pause_ad_zone1' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-2.png', 'on_pause_ad_zone2' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-2.png', 'disc_logo_show' => true, 'disc_logo_file' => 20810, 'login_popup_preview' => false, 'logo_show' => true, 'login_form_preview' => false, 'border_button_login_popup' => 'no', 'login_popup_links_text_position' => 'right', 'border_around_auth_form' => 'yes', 'links_text_position' => 'center', 'reg_form_preview' => false, 'login_popup_back_color' => '#172030', 'premium_rate_type' => '3 months', 'premium_display_best_label' => true, 'premium_text_label_color' => '#C32CE2', 'popup_content_type' => 'with_text', 'popup_mime' => get_template_directory_uri().'/assets/img/premium_popup_back.png', 'popup_show' => true, 'popup_page' => 'main', 'popup_side_anim' => 'bottom', 'popup_speed_anim' => '0.5s', 'popup_hide' => '3', 'popup_pulse_btn' => true, 'mob_advertising_setting_sidebar' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-2.png', 'mob_advertising_setting_under' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-2.png', 'mob_advertising_setting_footer' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-2.png', 'form_text_color' => '#FFFFFF', 'form_back_color' => '#1e2739', 'form_back_opacity' => '100', 'form_button_color' => '#C32CE2', 'form_button_hover_color' => '#AA2CC4', 'form_button_border_color' => '#C32CE2', 'popup_link_btn' => site_url().'/categories/', 'popup_color_btn' => '#C32CE2', 'popup_hover_color_btn' => '#AA2CC4', 'close_popup_btn_color' => '#5B5B5B', 'login_popup_back_opacity' => '0', 'logo_file' => 20810, 'back_color' => '#0f1725', 'back_file' => '', 'form_border_color' => '#1e2739', 'form_button_text_color' => '#FFFFFF', 'links_color' => '#CCCCCC', 'links_hover_color' => '#FFFFFF', 'tos_text' => 'Terms and Conditions', 'tos_link_page' => site_url().'/terms-and-conditions/', 'tos_link_color' => '#CCCCCC', 'tos_link_color_on_hover' => '#FFFFFF', 'underline_tos' => false, 'login_popup_border_color' => '#172030', 'login_popup_text_color' => '#FFFFFF', 'login_popup_button_color' => '#C32CE2', 'login_popup_button_hover_color' => '#AA2CC4', 'login_popup_btn_border_color' => '#c32ce2', 'login_popup_button_text_color' => '#FFFFFF', 'login_popup_button_text_color_on_hover' => '#FFFFFF', 'login_popup_links_color' => '#CCCCCC', 'login_popup_links_hover_color' => '#FFFFFF', 'background_preset' => 'default', 'background_size' => 'auto', 'background_repeat' => 'repeat', 'background_attachment' => 'scroll', 'background_position_x' => 'left', 'background_position_y' => 'top', 'main_advertising_setting_video_right' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/happy-2.png', 'seo_search_title' => '', 'seo_search_text' => '', 'title_desc_search_pos' => 'bottom', 'subscribe_back_color' => '#172030', 'subscribe_header_text' => '
Watch the best porno videos!

', 'subscribe_footer_text' => '
<p>Already a Premium Subscriber?</p>

', 'subscribe_close_color' => '#5B5B5B', 'subscribe_login_color_on_hover' => '#C32CE2', 'popup_background' => '#172030', 'popup_header' => '
<h1>The best porno videos for you!</h1>
', 'popup_description' => '
<p>Do you want to watch right now?</p>

', 'popup_btn_text' => '
WATCH HOT VIDEOS NOW

', 'desktop_header_link' => '', 'desktop_sidebar_link' => '', 'player_play_zone1_link' => '', 'player_pause_zone2_link' => '', 'mob_advertising_setting_header' => site_url().'/wp-content/themes/vicetemple_pornx/assets/img/banners/header-mobile.png', 'boxed_layout_background' => '#181c26', 'secondary_background_color' => '#0f1725', 'menu_color' => '#ffffff', 'reg_btn_color_on_hover' => '#AA2CC4', 'input_color' => '#0f1725', 'passive_color_setting' => '#cccccc', 'secondary_text_site_color' => '#cccccc', 'enable_demos_color_scheme' => 'demos', 'enable_demos_logos' => 'demos', 'desktop_video_left_link' => '', 'desktop_video_right_link' => '', 'desktop_under_video_link' => '', 'desktop_footer_link' => '', 'mobile_header_link' => '', 'mobile_sidebar_link' => '', 'mobile_under_video_link' => '', 'mobile_footer_link' => '', 'player_play_zone2_link' => '', 'player_pause_zone1_link' => '', );
		update_option('theme_mods_vicetemple_pornx', $customizer_settings, 'yes');
		add_option('customizer_rewrite', 'done', 'yes');
	}
	$pages = [
		'Pornstars' => array('' => 'template-pornstars.php'),
		'Categories' => array('' => 'template-categories.php'),
		'Public Profile' => array('' => 'template-public-profile.php'),
		'Playlists' => array('' => 'template-playlists.php'),
		'Watched Videos' => array('' => 'template-watchlist.php'),
		'Upload' => array('' => 'template-video-submit.php'),
		'Tags' => array('' => 'template-tags.php'),
		'Blog' => array('' => 'template-blog.php'),
		'Photos' => array('' => 'template-photos.php'),
		'Favorites' => array('' => 'template-favorites.php'),
		'Community' => array('' => 'template-community.php'),
		'DMCA' => array('' => 'dmca.php'),
		'2257 Statement' => array('' => '2257-page.php'),
		'Privacy Policy' => array('' => 'privacy-policy.php'),
		'Terms and Conditions' => array('' => 'terms-and-conditions.php'),
		'Contact' => array('' => 'support.php'),
		'Forbidden' => array('' => 'page-forbidden.php'),
		'Content removal' => array('' => 'content-removal.php'),
		'Parental control' => array('' => 'parental-control.php'),
		'FAQ' => array('' => 'template-faq.php'),
		'Order Hook URL' => array('' => 'order-hook-URL.php'),
		'RTA' => array('' => 'rta.php'),
		'New album' => array('' => 'template-submit-user-photos.php'),
		'Backend' => array('' => 'backend.php'),
		'Delete Users Account' => array('' => 'delete-account.php'),
		'Delete User Video' => array('' => 'delete-user-video.php'),
		'Delete User Album' => array('' => 'delete-user-album.php'),
		'Uploaded Videos' => array('' => 'users-uploads-video.php'),
		'Account Settings' => array('' => 'template-account-settings.php'),
		'Videos' => array('' => 'template-porn-videos.php'),
		'Edit Profile' => array('' => 'template-edit-profile.php'),
	];

	foreach($pages as $page_url_title => $page_meta) {
		$id = get_page_by_title($page_url_title);
		foreach ($page_meta as $page_content=>$page_template){
			$page = array(
				'post_type'   => 'page',
				'post_title'  => $page_url_title,
				'post_name'   => $page_url_title,
				'post_status' => 'publish',
				'post_content' => $page_content,
				'post_author' => 1,
				'post_parent' => ''
			);
			if(!isset($id->ID)){
				$new_page_id = wp_insert_post($page);
				if(!empty($page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $page_template);
				}
			}
		}
	}

	$menuname = 'Main Menu';
	$menu_exists = wp_get_nav_menu_object( $menuname );
	//Get all locations (including the one we just created above)
	$locations = get_theme_mod('nav_menu_locations');
	if(!$menu_exists){
		$menu_id = wp_create_nav_menu($menuname);
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'       =>  __('Home', 'arc'),
			'menu-item-url'         => home_url(),
			'menu-item-classes'     => 'home-icon',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'       =>  __('Videos', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-classes'     => 'video-icon',
			'menu-item-object-id'   => get_page_by_path('videos')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'       =>  __('Categories', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-classes'     => 'cat-icon',
			'menu-item-object-id'   => get_page_by_path('categories')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'       =>  __('Tags', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-classes'     => 'tag-icon',
			'menu-item-object-id'   => get_page_by_path('tags')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'       =>  __('Pornstars', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-classes'     => 'star-icon',
			'menu-item-object-id'   => get_page_by_path('pornstars')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'       =>  __('Photos & GIFs', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-classes'     => 'photo-icon',
			'menu-item-object-id'   => get_page_by_path('photos')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'       =>  __('Community', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-classes'     => 'user-icon',
			'menu-item-object-id'   => get_page_by_path('community')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'       =>  __('Blog', 'arc'),
            'menu-item-object'      => 'page',
            'menu-item-classes'     => 'blog-icon',
            'menu-item-object-id'   => get_page_by_path('blog')->ID,
            'menu-item-type'        => 'post_type',
            'menu-item-status'      => 'publish'));
		//set the menu to the new location and save into database
		$locations['arc-main-menu'] = $menu_id;
		//set_theme_mod( 'nav_menu_locations', $locations );
	} else {
		$menuname = 'Main Menu';
		$menu_exists = wp_get_nav_menu_object( $menuname );
		$locations['arc-main-menu'] = $menu_exists->term_id;
		//set_theme_mod( 'nav_menu_locations', $locations );
	}
	$menuname2 = 'Footer Menu';
	$menu_exists2 = wp_get_nav_menu_object( $menuname2 );
	if(!$menu_exists2){
		$menu_id2 = wp_create_nav_menu($menuname2);
		wp_update_nav_menu_item($menu_id2, 0, array(
			'menu-item-title'       =>  __('Blog', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-object-id'   => get_page_by_path('blog')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id2, 0, array(
			'menu-item-title'       =>  __('DMCA', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-object-id'   => get_page_by_path('dmca')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id2, 0, array(
			'menu-item-title'       =>  __('2257', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-object-id'   => get_page_by_path('2257-statement')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id2, 0, array(
			'menu-item-title'       =>  __('Privacy Policy', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-object-id'   => get_page_by_path('privacy-policy')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id2, 0, array(
			'menu-item-title'       =>  __('Terms and Conditions', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-object-id'   => get_page_by_path('terms-and-conditions')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id2, 0, array(
			'menu-item-title'       =>  __('Contact Us', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-object-id'   => get_page_by_path('contact')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id2, 0, array(
			'menu-item-title'       =>  __('Content Removal', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-object-id'   => get_page_by_path('content-removal')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id2, 0, array(
			'menu-item-title'       =>  __('Parental Control', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-object-id'   => get_page_by_path('parental-control')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		wp_update_nav_menu_item($menu_id2, 0, array(
			'menu-item-title'       =>  __('FAQ', 'arc'),
			'menu-item-object'      => 'page',
			'menu-item-object-id'   => get_page_by_path('faq')->ID,
			'menu-item-type'        => 'post_type',
			'menu-item-status'      => 'publish'));
		//Get all locations (including the one we just created above)
		//$locations = get_theme_mod('nav_menu_locations');
		//set the menu to the new location and save into database
		$locations['arc-footer-menu'] = $menu_id2;
		//set_theme_mod( 'nav_menu_locations2', $locations2 );
	} else {
		$menuname2 = 'Footer Menu';
		$menu_exists2 = wp_get_nav_menu_object( $menuname2 );
		$locations2['arc-footer-menu'] = $menu_exists2->term_id;
		//set_theme_mod( 'nav_menu_locations2', $locations2 );
	}
	set_theme_mod( 'nav_menu_locations', $locations);
}

function arc_create_page_content() {
	$dmca_content = '<h2><strong>Reporting Claims of Copyright Infringement</strong></h2>
<p>We take claims of copyright infringement seriously. We will respond to notices of alleged copyright infringement that comply with the Digital Millennium Copyright Act (the “<strong>DMCA</strong>”) or any other applicable intellectual property legislation or laws. Responses may include removing, blocking, or disabling access to material claimed to be the subject of infringing activity, terminating the user’s access to www.mypornsite.com (“<strong>'.get_bloginfo('name').'</strong>”), or all of the previous.</p>
<p>If you believe any material accessible on '.get_bloginfo('name').' infringes your copyright, you may submit a copyright infringement notification (see below, “Filing a DMCA Notice of Copyright Infringement” for instructions on filing such a notice). These requests should only be submitted by the copyright owner or an agent authorized to act on the owner’s behalf.</p>
<p>If we remove or disable access to material in response to such a notice, we will take reasonable steps to notify the user that uploaded the affected content material that we have removed or disabled access to so that the user has the opportunity to submit a counter-notification (see below, “Counter-Notification Procedures” for instructions on filing a counter-notification). It is our policy to document all notices of alleged infringement on which we act.</p>
<p>All copyright infringement notifications and counter-notifications must be written in English. Any attempted notices written in foreign languages or using foreign characters may, at our discretion, be deemed non-compliant and disregarded.</p>
<h2><strong>Filing a DMCA Notice of Copyright Infringement</strong></h2>
<p>If you choose to request the removal of content by submitting an infringement notification, please remember that you are initiating a legal process. Do not make false claims. Misuse of this process may result in the suspension of your account or other legal consequences.</p>
<p>You may notify '.get_bloginfo('name').' of alleged copyright infringement via our form found at www.mypornsite.com/content-removal/.</p>
<p>We also accept free-form copyright infringement notifications. In that case, in accordance with the DMCA, the written notice (the “<strong>DMCA Notice</strong>”) must include substantially the following:</p>
<ul><li>Identification of the copyrighted work you believe to have been infringed or if the claim involves multiple works, a representative list of such works.</li><li>Identification of the material you believe to be infringing in a sufficiently precise manner to allow us to locate that material. If your complaint does not contain the specific URL of the video you believe infringes your rights, we may be unable to locate and remove it. General information about the video, such as a channel URL or username, is typically not adequate. Please include the URL(s) of the exact video(s).</li><li>Adequate information by which we, and the uploader(s) of any video(s) you remove, can contact you (including your name, postal address, telephone number and, if available, e-mail address).</li><li>A statement that you have a good faith belief that use of the copyrighted material is not authorized by the copyright owner, its agent, or the law.</li><li>A statement that the information in the written notice is accurate, and under penalty of perjury, that you are the owner, or an agent authorized to act on behalf of the owner, of an exclusive right that is allegedly infringed.</li><li>Complete complaints require the physical or electronic signature of the copyright owner or a representative authorized to act on their behalf. To satisfy this requirement, you may type your full legal name to act as your signature at the bottom of your complaint.</li></ul>
<p>Our designated Copyright Agent to receive DMCA Notices is:</p>
<ul><li><em>First Name Last Name</em></li><li><em>Company</em> <em>Name</em></li><li><em>Address</em></li><li><em>City, State ZIP Code</em></li><li>Email: <em>Email</em></li></ul>
<p>Please do not send other inquiries or requests to our designated copyright agent. Absent prior express permission, our designated copyright agent is not authorized to accept or waive service of formal legal process, and any agency relationship beyond that required to receive valid DMCA Notices or Counter-Notices (as defined below) is expressly disclaimed.</p>
<p>If you fail to comply with all of the requirements of Section 512(c)(3) of the DMCA, your DMCA Notice may not be effective.</p>
<p>Please be aware that if you knowingly materially misrepresent that material or activity on '.get_bloginfo('name').' is infringing your copyright, you may be held liable for damages (including costs and attorneys’ fees) under Section 512(f) of the DMCA.</p>
<p>The copyright owner’s name will be published on '.get_bloginfo('name').' in place of disabled content. This will become part of the public record of your DMCA Notice, along with your description of the work(s) allegedly infringed. All the information provided in a DMCA Notice, the actual DMCA Notice (including your personal information), or both may be forwarded to the uploader of the allegedly infringing content. By submitting a DMCA Notice, you consent to have your information revealed in this way.</p>
<h2><strong>Counter-Notification Procedures</strong></h2>
<p>If you have received a DMCA Notice and believe that material you posted on '.get_bloginfo('name').' was removed or access to it was disabled by mistake or misidentification, you may file a counter-notification with us (a “<strong>Counter-Notice</strong>”). Counter notifications must be submitted by the video’s original uploader or an agent authorized to act on their behalf.</p>
<p>Counter-notices must be sent to our designated agent:</p>
<ul><li><em>First Name Last Name</em></li><li><em>Company Name</em></li><li><em>Address</em></li><li><em>City, State ZIP Code</em></li><li>Email: <em>Email</em></li></ul>
<p>Please do not send other inquiries or requests to our designated copyright agent. Absent prior express permission, our designated copyright agent is not authorized to accept or waive service of formal legal process, and any agency relationship beyond that required to receive valid DMCA Notices or Counter-Notices (as defined below) is expressly disclaimed.</p>
<p>Pursuant to the DMCA, the Counter-Notice must include substantially the following:</p>
<ul><li>Your name, address, phone number, and physical or electronic signature;</li><li>Identification of the allegedly infringing content and its location before removal or access to it was disabled;</li><li>A statement under penalty of perjury that you believe in good faith that the content was removed by mistake or misidentification; and</li><li>A statement that you consent to the jurisdiction of the U.S. Federal District Court for the judicial district in which you are located (or if you are outside the U.S., for any judicial district in which the operator of '.get_bloginfo('name').' may be found), and that you will accept service of process from the person who originally provided us with the DMCA Notice or an agent of such person.</li></ul>
<p>We will not respond to counter-notifications that do not meet the requirements above.</p>
<p>After we receive your Counter-Notice, we will forward it to the party who submitted the original DMCA Notice and inform that party that the removed material may be restored after 10 business days but no later than 14 business days from the date we received your Counter-Notice, unless our Designated Agent first receives notice from the party who filed the original DMCA Notice informing us that such party has filed a court action to restrain you from engaging in infringing activity related to the material in question.</p>
<p>Please note that when we forward your Counter-Notice, it will include your personal information. By submitting a counter-notification, you consent to having your information revealed in this way. We will not forward the counter-notification to any party other than the original claimant to law enforcement or parties that help us enforce and protect our rights.</p>
<p>Please be aware that if you knowingly materially misrepresent that material or activity on '.get_bloginfo('name').' was removed or disabled by mistake or misidentification, you may be held liable for damages (including costs and attorneys’ fees) under Section 512(f) of the DMCA.</p>
<h2>Repeat Infringers</h2>
<p>In accordance with the DMCA and other applicable law, we have adopted a policy of terminating or disabling, in appropriate circumstances and at our sole discretion, the accounts of users who are deemed to be repeat infringers. At our sole discretion, we may limit access to '.get_bloginfo('name').', terminate or disable the accounts of any users who infringe any intellectual property rights of others, whether or not there is any repeat infringement.</p>';
	$dmca = [];
	$dmca['ID'] = get_page_by_path('dmca')->ID;
	$dmca['post_content'] = $dmca_content;
	wp_update_post(wp_slash($dmca));


	$statement_2257_content = '<h2><strong>18 U.S.C. §2257 Record Keeping Requirements Compliance Statement</strong></h2>
<p>The operator of '.get_bloginfo('name').' is not the producer (whether primary or secondary as defined in 18 U.S.C. § 2257) of any of the content found on '.get_bloginfo('name').'. The operator’s activities, with respect to such content, are limited to the transmission, storage, retrieval, hosting, and formatting of depictions posted by third-party users on areas of the website under the user’s control.</p>
<p>Please direct any request you may have regarding §2257 records concerning any content found on '.get_bloginfo('name').' directly to the respective uploader, amateur, producer, studio, or account holder of the content (<strong>“Content Uploaders”</strong>).</p>
<p>For further assistance in communicating with the Content Uploaders or any questions regarding this notice, please contact '.get_bloginfo('name').'’s compliance department at support@mypornsite.com.</p>
<p>'.get_bloginfo('name').' abides by the following strict compliance procedures regarding uploaded content:</p>
<ul><li>All Content Uploaders must be over eighteen (18) years of age (or age required by their State, jurisdiction, or Country if more than 18 years old), and all content is moderated prior to being published on '.get_bloginfo('name').'.</li><li>Prior to uploads, '.get_bloginfo('name').' ensures that all Content Uploaders provide evidence or certify that:<br><ul><li>all individuals appearing in the content are over the age of 18 years old (or the minimum age required to appear in such content by their State, jurisdiction, or Country if more than 18 years old); that they freely consented to appear in the content at the time of its production and agree to its upload on '.get_bloginfo('name').';</li><li>as a producer of said content, the Content Uploader certifies being compliant with record keeping requirements under U.S.C. § 2257 for all content uploaded on '.get_bloginfo('name').', and agrees to deliver such documentation promptly upon request;</li><li>the uploaded content does not violate '.get_bloginfo('name').'’s Terms and Conditions and any of its related policies.</li></ul></li></ul>';
	$statement_2257 = [];
	$statement_2257['ID'] = get_page_by_path('2257-statement')->ID;
	$statement_2257['post_content'] = $statement_2257_content;
	wp_update_post(wp_slash($statement_2257));


	$privacy_content = '<h2><strong>Introduction</strong></h2>
<p>'.get_bloginfo('name').' Ltd. (hereinafter “<strong>we</strong>,” “<strong>us</strong>” or “<strong>our</strong>”) operates the website www.mypornsite.com (hereinafter “<strong>'.get_bloginfo('name').'</strong>”) and is the controller of the information collected or provided via '.get_bloginfo('name').'.</p>
<p>Please read this privacy policy carefully, as your access to and use of '.get_bloginfo('name').' signifies that you have read and understood all terms within this privacy policy. We respect your privacy and are committed to protecting your personal data.</p>
<p>If you have any questions about our privacy practices, please see “<em>Contact Information</em>” below for information on contacting us.</p>
<h2>Scope</h2>
<p>This privacy policy applies to information we collect:</p>
<ul><li>on '.get_bloginfo('name').' and your email communications with '.get_bloginfo('name').',</li><li>through mobile applications that provide dedicated non-browser-based interaction between you and '.get_bloginfo('name').', or</li><li>when you interact with our advertising and applications on third-party websites and services if those applications or advertising include links to this privacy policy.</li></ul>
<h2>The Data We Collect About You</h2>
<p>We may collect different kinds of personal data about you, depending on whether you chose to create an account with us.</p>
<p>Persons who visit '.get_bloginfo('name').' without logging in or registering (“<strong>unregistered users</strong>”):</p>
<ul><li><strong>Contact Information:</strong>&nbsp;We collect the email address or any other information you voluntarily provide to us at your direction for a specific function, such as a contest or survey.</li><li><strong>Website activity data:</strong>&nbsp;We collect information about how you use '.get_bloginfo('name').', products, and services and interact with our content and advertisements, including the pages you visit on '.get_bloginfo('name').', search history, and the referring web page from which you arrived on '.get_bloginfo('name').'. We collect browser and operating system information, devices you use to access '.get_bloginfo('name').', and your time zone setting. We also collect online identifiers. Specifically, we collect internet protocol (IP) address information, and we set cookies as explained below in the section on Cookies and Automatic Data Collection Technologies.</li></ul>
<p>Persons who choose to create an account on '.get_bloginfo('name').' (“<strong>registered users</strong>”) and persons who choose to upgrade their account on '.get_bloginfo('name').' to a premium account such that they have access to the content found on '.get_bloginfo('name').' Premium (“<strong>Premium users</strong>”):</p>
<ul><li>We collect from registered users the same categories of information described above for unregistered users.</li><li><strong>Contact Information:</strong>&nbsp;We collect username or similar identifier and email address.</li><li><strong>Payment and Commercial Information:</strong>&nbsp;If you make a purchase, we collect payment card details and related information necessary to process your payment. We also collect details about payments to and from you and details of products and services you have purchased or received from us.</li><li><strong>User Submitted Personal Information:</strong>&nbsp;We collect the information you submit to personalize your account or for a specific function, for example, date of birth, age, gender, your interests, preferences, feedback, survey responses, your preferences in receiving marketing from us, and our third parties, and your communication preferences, as well as any other information which you voluntarily provide to us at your direction for a specific function.</li><li><strong>User Contributions including Audio/Video Information:</strong>&nbsp;We provide areas on '.get_bloginfo('name').' where you can post information about yourself and others, communicate with others, upload content (e.g., pictures, video files, etc.), and post comments or reviews of content found on '.get_bloginfo('name').'.</li></ul>
<p>Please use caution in providing user contributions.&nbsp;<strong>By providing user contributions, you are making that content and information publicly available.</strong>&nbsp;User contributions can be read, collected, used, and disclosed by others. We cannot control who accesses your user contributions or what other users may do with the information you voluntarily post or submit. User contributions are governed by the '.get_bloginfo('name').' terms of use found in our Terms and Conditions.</p>
<p>We may use your data to produce and share aggregated insights that do not directly or indirectly identify you and are not associated with you. Such aggregate information is not personal information.</p>
<p>'.get_bloginfo('name').' is not directed to persons under the age of 18 or the applicable age of majority in the jurisdiction from which '.get_bloginfo('name').' is accessed (“<strong>minors</strong>”). We prohibit minors from using '.get_bloginfo('name').'. We do not knowingly collect personal information from minors. If you are the parent or legal guardian of a minor who has provided us with personal information, please contact us at support@mypornsite.com to have that minor’s personal information deleted.</p>
<h2><strong>The Sources from Which We Collect Personal Information</strong></h2>
<p>We collect Personal Information in the following ways:</p>
<ul><li><strong>Directly from you:</strong> We collect the categories of information listed above directly from you.</li><li><strong>Automated technologies or interactions.</strong> As explained in the section below on <em>Cookies and Automatic Data Collection Technologies</em>, we set cookies and other automatic techniques to collect website activity data when you visit '.get_bloginfo('name').' or other websites owned by our corporate group.</li></ul>
<h2><strong>Purposes for Which We Use Your Personal Information</strong></h2>
<p>We use personal information for the purposes described below.</p>
<ul><li><strong>Provision of services:</strong> We use identifiers, website activity data, and, additionally, for registered users and Premium users only, contact information, and payment and commercial information and user contributions to present '.get_bloginfo('name').' and its contents to you, including any interactive features on '.get_bloginfo('name').', to provide you with information, products or services that you request from us, and to verify your eligibility and deliver prizes in connection with contests and sweepstakes.</li><li><strong>Customer management (Registered Users and Premium Users Only):</strong> We use identifiers and contact information, and payment and commercial information to manage a Premium user’s and registered user’s account, to provide customer support and notices to the registered user about their account or subscription, including expiration and renewal notices, and notices about changes to '.get_bloginfo('name').' or any products or services we offer or provide through it.</li><li><strong>Customization of content and marketing (Unregistered Users and Registered Users Only):</strong> We use identifiers and contact information, website activity data, user-submitted personal information, and user contributions to analyze your use of, or interest in, '.get_bloginfo('name').' content, products, or services, in order to develop and display content and advertising tailored to your interests on '.get_bloginfo('name').'.</li><li><strong>Analytics:</strong> We use identifiers and website activity data to determine whether users of '.get_bloginfo('name').' are unique or whether the same user is using '.get_bloginfo('name').' on multiple occasions and to monitor aggregate metrics such as the total number of visitors, pages viewed, demographic patterns.</li><li><strong>Functionality and security:</strong> We may use any of the data categories we collect to diagnose or fix technology problems, verify your payment information, and detect, prevent, and respond to actual or potential fraud, illegal activities, or intellectual property infringement.</li><li><strong>Compliance:</strong> We may use any of the data categories we collect to enforce our terms and conditions and comply with our legal obligations.</li><li>We will use the contact information and user-submitted personal information in any other way we may describe when you provide the information (e.g., for a contest); or any other purpose with your consent provided separately from this privacy policy.</li></ul>
<h2><strong>Our Legal Bases Under EU Law</strong></h2>
<p>We have the following legal bases under EU law for processing your personal data for the purposes described under Section <em>Purposes for Which We Use Your Personal Information:</em></p>
<ul><li>We process personal data to provide the services, customer management, certain customization of content (e.g., based on your selected preferences, favorites, and ratings), and functionality and security because the processing is necessary for the performance of a contract. Specifically, it is necessary to provide the services or products you have requested or to provide '.get_bloginfo('name').' and services in a manner consistent with our terms and conditions and any other contract that you have with us.</li><li>We process personal data to customize advertising, marketing, and analytics for our legitimate interests.</li><li>We process personal data for functionality and security because it is necessary for our legitimate interests. In some instances, the processing is required for us to comply with a legal or regulatory obligation.</li><li>We process personal information in specific circumstances where you have provided your consent to such processing.</li></ul>
<h2><strong>Disclosure of Your Personal Information</strong></h2>
<p>We disclose personal information:</p>
<ul><li><strong>To the public:</strong> When you submit user contributions, including audio/video content, you are using '.get_bloginfo('name').' and services to make that information public.</li><li><strong>Within our corporate group:</strong> We may disclose any of the categories of personal information to our corporate group members (including affiliates and related entities) to the extent this is necessary for our purposes listed in the sections above.</li><li><strong>Service providers:</strong> We disclose the categories of personal information we collect to our authorized service providers that perform certain services on our behalf. These services may include payment processing and fulfilling orders, risk and fraud detection and mitigation, customer service, marketing and advertising, customization of content, analytics, security, hosting '.get_bloginfo('name').', or supporting '.get_bloginfo('name').'’s functionality. These service providers may have access to personal information needed to perform their functions but are not permitted to share or use such information for any other purposes.</li><li><strong>Legal successors:</strong> We may disclose all of the categories of personal information we collect to a buyer or other successor in the event of a merger, acquisition or sale, or transfer of some or all of our assets, whether as a going concern or as part of bankruptcy, liquidation or similar proceeding.</li><li><strong>To comply with the law or protect our rights or the rights of third parties:</strong> We access, preserve and share your personal information with regulators, law enforcement, or others where we reasonably believe such disclosure is needed to (a) satisfy any applicable law, regulation, legal process, or governmental request, (b) enforce applicable terms of use, including investigation of potential violations thereof, (c) detect, prevent, or otherwise address illegal or suspected illegal activities, security or technical issues, (d) protect against harm to the rights, property or safety of our company, our users, our employees, or others; or (e) to maintain and protect the security and integrity of '.get_bloginfo('name').' or our infrastructure. In such cases, we may raise or waive any legal objection or right available to us at our sole discretion.</li></ul>
<h2><strong>Cookies and Automatic Data Collection Technologies</strong></h2>
<p>As you navigate through and interact with '.get_bloginfo('name').', we use automatic data collection technologies to collect website activity data.</p>
<p>We use <strong>cookies</strong>, which are small text files stored in your web browser or downloaded to your device when you visit a website.</p>
<p>We currently use the following types of cookies, which are set by the '.get_bloginfo('name').' domains or by other domains we own or control:</p>
<ul><li><em>Strictly necessary cookies:</em> These are cookies that are required for the operation of '.get_bloginfo('name').'. These include, for example, cookies that enable a user to log in to '.get_bloginfo('name').' and to check if a user is allowed access to a particular service or content.</li><li><em>Functionality cookies:</em> These cookies help us to personalize and enhance your online experience on '.get_bloginfo('name').'. This type of cookie allows us to recognize you when you return to '.get_bloginfo('name').' and to remember, for example, your choice of language.</li><li><em>Analytics cookies:</em> These cookies allow us to recognize and count the number of users and see how users use and explore '.get_bloginfo('name').'. These cookies help us improve '.get_bloginfo('name').', for example, by ensuring that all users can find what they are looking for easily.</li><li><em>Targeting and Advertising cookies:</em> These cookies record visits of a user on '.get_bloginfo('name').', the pages a user visits, and the links a user follows to enable us to make '.get_bloginfo('name').' more relevant to the user’s interests and help us serve ads that might be of interest to the user. Targeting and advertising cookies are only used for unregistered users and registered users.</li><li>Cookies can be either session cookies or persistent cookies. A session cookie expires the moment you close your browser. A persistent cookie will remain until it expires or you delete your cookies.</li></ul>
<p>You can set your browser to refuse all or some browser cookies or to alert you when cookies are being sent. Please note that some parts of '.get_bloginfo('name').' may then be inaccessible or not function properly if you disable or refuse cookies.</p>
<p><strong>Do Not Track:</strong> Our systems do not recognize browser “Do Not Track” signals.</p>
<p><strong>Use of Google Analytics.</strong> We use Google as a service provider to collect and analyze information about how users use '.get_bloginfo('name').', including collecting website activity data through first-party cookies set by our domains and third-party cookies set by Google. Because we activated IP anonymization for Google Analytics, Google will anonymize the last octet of a particular IP address and will not store your full IP address. Google will use the information only to provide Google Analytics services to us and will not use this information for other purposes. The data collected by Google Analytics may be transmitted to and stored by Google on servers in the United States pursuant to standard contractual clauses approved by the EU. You can learn more about how Google uses data <a href="https://policies.google.com/technologies/partner-sites">here</a>, and you can opt-out of Google Analytics by visiting the <a href="https://tools.google.com/dlpage/gaoptout">Google Analytics opt-out page.</a></p>
<h2><strong>Third-party Use of Cookies and Other Tracking Technologies</strong></h2>
<p>Some content or applications, including advertisements, on '.get_bloginfo('name').', are provided or served by third parties. These third parties may use cookies alone or in conjunction with other tracking technologies to collect information about you when you use '.get_bloginfo('name').'. Unless expressly stated otherwise, '.get_bloginfo('name').' does not provide any personal information to these third parties. However, they may collect information, including your IP address, advertisements you click, time zone setting and location, and information about your browser, operating system, and devices you use to access '.get_bloginfo('name').'. They may use this information to provide you with interest-based advertising or other targeted content. They may track users across different websites and over time.</p>
<p>You can set your browser to refuse all third-party cookies or alert you when they are being sent.</p>
<h2><strong>Your Choices About How We Collect, Use and Disclose Your Personal Information</strong></h2>
<p>We strive to provide you with choices regarding the personal information you provide to us.</p>
<ul><li>You can choose not to provide us with certain personal information, but that may result in you being unable to use certain features of '.get_bloginfo('name').' because such information may be required in order for you to register as a member; purchase products or services; participate in a contest, promotion, survey, or sweepstakes; ask a question; or initiate other transactions on '.get_bloginfo('name').'.</li><li>As explained in the section <em>Cookies and Automatic Data Collection Technologies,</em> you may set your browser to refuse some or all cookies. In addition, you may opt out of Google Analytics by visiting the <a href="https://tools.google.com/dlpage/gaoptout">Google Analytics opt-out page.</a></li><li>You can opt out of receiving marketing emails from us using the opt-out link provided in our emails. If you are a Registered User, we may continue to send you other types of transactional and relationship email communications, such as emails about your account or orders, administrative notices, and surveys.</li><li>You may use your account settings to delete your user contributions and audio/video information.</li><li>You may also delete your account with us at any time. If you do so, your profile will no longer be accessible by you. If you later choose to have an account with us, you will have to sign up for a new account as none of the information you previously provided or saved within your account will have been saved.</li></ul>
<h2><strong>Your Rights Related to Your Personal Information</strong></h2>
<p>You have certain rights regarding the personal information we collect, use or disclose and that is related to you, including the right:</p>
<ul><li>to receive information on the personal information we hold about you and how such personal information is used (right to access);</li><li>to correct inaccurate personal information concerning you (right to data rectification);</li><li>to delete/erase your personal information (right to deletion, “right to be forgotten”);</li><li>to receive the personal information provided by you in a structured, commonly used, and machine-readable format and to transmit the personal information to another data controller (right to data portability)</li><li>to object to the use of your personal information where such use is based on our legitimate interests or public interests (right to object);</li><li>in some cases, to restrict our use of your personal information (right to restriction of processing); and</li><li>to withdraw your consent at any time where our processing is based on consent.</li></ul>
<p>You may exercise your right to access and deletion by sending us an email at support@mypornsite.com to exercise your above rights in accordance with the applicable legal requirements and limitations. If you are located in the European Economic Area or the UK, you have a right to lodge a complaint with your local data protection authority.</p>
<p>Please note that unless you have created an account with us, we may not have sufficient information to identify you and therefore may not be in a position to respond to your request. Additionally, in some cases, in order to adequately verify your identity or your authorization to make the request, we may require you to provide additional information.</p>
<p>Note that some requests to delete certain personal information will require the deletion of your user account as the provision of user accounts are inextricably linked to the use of certain personal information (e.g., your email address).</p>
<h3><strong>California Rights and Choices</strong></h3>
<p>The California Consumer Privacy Act (“CCPA”) provides you certain rights concerning your personal information:</p>
<ul><li><em>Right to Know:</em> You have the right to request that we disclose certain information about our collection of your personal information over the past 12 months, including the specific pieces of information we collected.</li><li><em>Right to Request Deletion:</em> You have the right to request that we delete any of your personal information we collected from you and retained, subject to certain exceptions outlined in the CCPA.</li><li><em>Right to Non-Discrimination for the Exercise of Your Rights:</em> We will not discriminate against you because you have exercised any of your rights under the CCPA.</li></ul>
<p>To exercise the rights described above, please use the buttons at the bottom of this page or email us at support@mypornsite.com with the email subject line “CCPA Request.” In either case, you will need to provide the following information to verify your identity and enable us to locate your information in our systems: your username and email address that you used to create an account with us, as well as any other information which we may reasonably request in order for us to verify your identity. We may require you to verify that you have access to your account or email account that you used to register with us.</p>
<p>You can designate an agent to make a request by executing a notarized power of attorney to have that person act on your behalf and providing that person with the information listed above that allows us to verify your identity and locate your information. Alternatively, you will need to directly confirm your identity with us using the methods described above, sign an authorization for the agent to act on your behalf, and provide us with confirmation that you have done so.</p>
<p>We disclose specific categories of California residents’ personal information for our business purposes, as described in the section above, titled Disclosure of Your Personal Information.</p>
<p>We do not sell California residents’ personal information.</p>
<h3><strong>Notice to Nevada Residents/Your Nevada Privacy Rights</strong></h3>
<p>We do not exchange Nevada residents’ personal information for money with anyone to license or sell the personal information to other parties.</p>
<h2><strong>Transfers of Your Personal Information to Other Countries</strong></h2>
<p>Where the laws of your country allow you to do so, by using '.get_bloginfo('name').', you consent to the transfer of information that we collect about you, including personal information, to other countries in which we, members of our corporate group (including affiliates and related entities) or our service providers are located. When we transfer personal information to countries outside of the European Economic Area (“EEA”) or other regions with comprehensive data protection laws, we will ensure that the information is transferred in accordance with the applicable laws. Where relevant, our transfers outside the EEA are made pursuant to standard contractual clauses approved for use by the European Union.</p>
<h2><strong>Retention of Personal Information</strong></h2>
<p>We will only retain your personal information for as long as your account is active or for as long as necessary to fulfill the purposes we collected it for, including to satisfy any legal, accounting, or reporting requirements.</p>
<p>To determine the appropriate retention period for personal data, we consider several factors, including what personal data we are processing, the risk of harm from unauthorized disclosure, why we are processing your personal data, and whether we can achieve this outcome by another means without having to process it.</p>
<p>Where we no longer need to process your personal information for the purposes set out in this Privacy Policy, we will delete your personal information from our systems.</p>
<p>Where permissible, we will also delete your personal information upon your request, as explained above in the section <em>“Your Rights Related to Your Personal Information.”</em></p>
<h2><strong>Third-Party Links and Sites</strong></h2>
<p>If you click on a link to a third-party site, you will be taken to websites we do not control. This policy does not apply to the privacy practices of these websites. Read the privacy policy of other websites carefully. We are not responsible for these third-party practices.</p>
<h2><strong>Changes to Our Privacy Policy</strong></h2>
<p>We may modify or revise our privacy policy from time to time. If we change anything in our privacy policy, the change date will be reflected in the “last modified date.” We may attempt to notify you of any material changes as required by law. Please also periodically review the most up-to-date version of our privacy policy, which will be posted at this location, so you are aware of any changes.</p>
<h2><strong>Contact Information</strong></h2>
<p>If you have any questions about this privacy policy or our information-handling practices, please contact us at support@mypornsite.com.</p>
<p>You may also contact us at <em>Address, City, Country ZIP code, </em>Phone: <em>phone number, </em>Fax: <em>fax machine number.</em></p>
<p>You can contact our Data Protection Officer at the following email address: dpo@mypornsite.com.</p>
<h2><strong>GDPR (General Data Protection Regulation)</strong></h2>
<p>In accordance with the General Data Protection Regulation law in the European Union effective May 25, 2018, '.get_bloginfo('name').' users can request a copy of their personal data and get '.get_bloginfo('name').' to delete their personal data.</p>';
	$privacy = [];
	$privacy['ID'] = get_page_by_path('privacy-policy')->ID;
	$privacy['post_content'] = $privacy_content;
	wp_update_post(wp_slash($privacy));

	$terms_content = '<p>Dear user,</p>
<p>Please note that our Terms and Conditions are amended to reflect the contents of our announcement made on March 29th, 2021. As such, users will have to respect the contents of the announcement, which officially prevail over the Terms and Conditions in the event of contradiction, effective immediately.</p>
<h2><strong>Acceptance of the Terms and Conditions</strong></h2>
<p>By using or visiting www.mypornsite.com (hereinafter “<strong>'.get_bloginfo('name').'</strong>”), or any content, functionality, and services offered on or through '.get_bloginfo('name').', whether as a guest or a registered user, or by clicking to accept or agree to the Terms and Conditions when this option is made available to you, you signify your agreement to these Terms and Conditions and our Privacy Policy, and incorporated herein by reference.</p>
<p>These Terms and Conditions apply to all users, including users who are also contributors of Content, of any of '.get_bloginfo('name').', web pages, interactive features, embeddable player, uploader and other applications, widgets, blogs, social networks, social network “tabs,” or other online or wireless offerings that post a link to these Terms and Conditions, whether accessed via computer, mobile device, or other technology, manner, or means.</p>
<p>“<strong>Content</strong>” includes the text, software, scripts, graphics, photos, sounds, music, videos, audiovisual combinations, interactive features, textual content, and other materials you may view, upload, publish, submit, make available, display, communicate or post on, or transmit to other users or other person or access through '.get_bloginfo('name').'.</p>
<p>If you do not agree to any of these Terms and Conditions or our Privacy Policy, please do not access or use '.get_bloginfo('name').'.</p>
<p>You consent to entering these Terms and Conditions electronically and storing records related to these Terms and Conditions in electronic form.</p>
<h2><strong>Ability to Accept Terms and Conditions</strong></h2>
<p>You affirm that you are at least 18 years of age or the age of majority in the jurisdiction you are accessing '.get_bloginfo('name').' from and are fully able and competent to enter into the terms, conditions, obligations, affirmations, representations, and warranties outlined in these Terms and Conditions, and to abide by and comply with these Terms and Conditions. If you are under 18 or the applicable age of majority, please do not use '.get_bloginfo('name').'. You also represent that the jurisdiction from which you access '.get_bloginfo('name').' does not prohibit the receiving or viewing of sexually explicit content.</p>
<h2><strong>Changes to the Terms and Conditions</strong></h2>
<p>We reserve the right to amend these Terms and Conditions at any time and without notice, and it is your responsibility to review these Terms and Conditions for any changes. Your use of '.get_bloginfo('name').' following any amendment of these Terms and Conditions will signify your assent to and acceptance of its revised terms.</p>
<p>The updated version of the Terms and Conditions supersedes any prior versions immediately upon being posted, and the prior version(s) shall have no continuing legal effect. You should periodically review the most up-to-date version of the Terms and Conditions found on '.get_bloginfo('name').'.</p>
<h2><strong>About '.get_bloginfo('name').'</strong></h2>
<p>'.get_bloginfo('name').' allows for uploading, sharing, and general viewing of various types of adult-oriented content by users, registered and unregistered, who desire to share and view visual depictions of adult-oriented content, including sexually explicit images. In addition, '.get_bloginfo('name').' contains texts, messages, files, data, information, images, photos, video files, recordings, materials, code, or content of any kind and other materials posted or uploaded by users.</p>
<p>'.get_bloginfo('name').' may contain links to third-party sites that are not owned or controlled by '.get_bloginfo('name').' or its operator. '.get_bloginfo('name').' has no control over and assumes no responsibility for any third-party sites’ content, privacy policies, or practices. In addition, '.get_bloginfo('name').' will not and cannot censor or edit the content of any third-party site. By using '.get_bloginfo('name').', you expressly relieve us from all liability arising from your use of any third-party sites. Accordingly, we encourage you to be aware when you leave '.get_bloginfo('name').' and to read the terms, conditions, and privacy policies of each other sites that you visit.</p>
<p>'.get_bloginfo('name').' is for your personal use and shall not be used for any commercial endeavor except those specifically endorsed or approved by '.get_bloginfo('name').'.</p>
<p>'.get_bloginfo('name').' is for adult-oriented content. Other categories of content may be rejected or deleted at our sole discretion. We may, at our sole discretion and at any time, remove any content on '.get_bloginfo('name').'.</p>
<p>You understand and acknowledge that when using '.get_bloginfo('name').', you will be exposed to content from various sources. '.get_bloginfo('name').' is not responsible for the accuracy, usefulness, safety, or intellectual property rights of or relating to such content. You further understand and acknowledge that you may be exposed to inaccurate content, offensive, indecent, or objectionable. You agree to waive, and hereby do waive, any legal or equitable rights or remedies you have or may have against '.get_bloginfo('name').' with respect to that, and agree to indemnify and hold '.get_bloginfo('name').', its site operator, its parent corporation, its respective affiliates, licensors, service providers, officers, directors, employees, agents, successors and assigns, harmless to the fullest extent allowed by law regarding all matters related to your use of '.get_bloginfo('name').'.</p>
<h2><strong>Communication Preferences</strong></h2>
<p>By using '.get_bloginfo('name').', you expressly and specifically consent to receive electronic communications from us relating to your account. These communications may involve sending emails to your email address provided during registration or posting communications on '.get_bloginfo('name').' (for example, through the members’ area on '.get_bloginfo('name').' upon login to ensure receipt in the event you have unsubscribed from email communications), or in the “Account Settings” or “Public Profile” page and may include notices about your account (such as upcoming payment notifications, change in password or payment method, confirmation emails, and other transactional information) and are part of your relationship with us. You agree that any notices, agreements, disclosures, or other communications that we send to you electronically will satisfy any legal communication requirements, including that such communications be in writing. You should maintain copies of electronic communications by printing a paper copy or saving an electronic copy. You also expressly and specifically consent to receive certain other communications from us, such as newsletters about new features and content, special offers, promotional announcements, and customer surveys via email or other methods. If you no longer want to receive certain non-transactional communications, you will need to avail yourself of the unsubscribe mechanism set out in the applicable communication.</p>
<h2><strong>Purchasing Content, Subscriptions, Free Trials, Promotion Subscriptions, Billing and Cancellation</strong></h2>
<h3><strong>Use of Third-Party Internet Payment Service Providers</strong></h3>
<p>Payment for subscriptions to '.get_bloginfo('name').' Premium can be made by credit cards. When available, by debit cards, and are processed through our third-party Internet payment service providers or other payment processors. By subscribing to '.get_bloginfo('name').' Premium, you hereby consent to and agree to abide by such third-party Internet payment service providers’ or payment processors’ customer terms and conditions and policies, and understand that we have no control whatsoever over such customer terms and conditions and policies. If you cannot agree to such third-party internet payment service providers’ or payment processors’ customer terms and conditions or policies, do not subscribe to '.get_bloginfo('name').' Premium.</p>
<h3><strong>Subscriptions to '.get_bloginfo('name').' Premium</strong></h3>
<p>Your subscription to '.get_bloginfo('name').' Premium, which may start with a free trial or promotional subscription, will continue unless and until you cancel or we terminate it. You must provide us with a current, valid, accepted payment method (as such may be updated from time to time, “<strong>Payment Method</strong>”) to use our services. We will bill the applicable subscription fee to your Payment Method. You must cancel your subscription before it renews to avoid billing of the next period’s subscription fees to your Payment Method.</p>
<p>We may offer several subscription plans, including special promotional plans or subscriptions with differing conditions and limitations. Any materially different terms from those described in these Terms and Conditions will be disclosed at your sign-up or in other communications made available to you. You can find specific details regarding your subscription with us by verifying the email receipt issued upon your sign-up or by contacting us in one of the manners described at www.mypornsite.com/faq/. Third parties may offer some promotional subscriptions in conjunction with the provision of their own products and services. We are not responsible for the products and services provided by such third parties. We reserve the right to modify, terminate, or otherwise amend, at our sole discretion, our offered subscription plans.</p>
<h3><strong>Free Trials and Promotional Subscriptions to '.get_bloginfo('name').' Premium</strong></h3>
<p>Your subscription to '.get_bloginfo('name').' Premium may start with a free trial or promotional subscription. The free trial period of your subscription lasts for&nbsp;<em>NUMBER</em>&nbsp;days or as otherwise specified during sign-up. For combinations with other offers, restrictions may apply. Free trials or promotional subscriptions are for new and certain former subscribers only. We reserve the right to determine your eligibility for a free trial or promotional subscription at our sole discretion.</p>
<p>We will begin billing your Payment Method for monthly subscription fees at the end of the free trial period of your subscription or the end of your promotional subscription unless you cancel before the end of the applicable period. To view the specific details of your subscription, including the monthly subscription price and end date of your free trial period or promotional subscription, please verify the email receipt issued upon your sign-up or contact us in one of the manners described at www.mypornsite.com/faq/. We may authorize your Payment Method through various methods, including authorizing it up to an amount equal to or similar to the amount of the monthly subscription fee as soon as you register. In some instances, your available balance or credit limit may be reduced to reflect the authorization during your free trial period. However, you will not be charged during your free trial period for the subscription fee.</p>
<h3><strong>Billing for Subscriptions to '.get_bloginfo('name').' Premium</strong></h3>
<p>By starting your subscription to '.get_bloginfo('name').' Premium and providing or designating a Payment Method, you authorize us to charge you a recurring subscription fee at the then-current rate and any other charges you may incur in connection with your use of our services to your Payment Method. You acknowledge that the amount billed each period may vary (but not materially) from term to term, and you authorize us to charge your Payment Method for such varying amounts, which may be billed monthly in one or more charges.</p>
<p>We reserve the right to adjust pricing for our service or any components thereof in any manner and at any time as we may determine in our sole discretion. Except as otherwise expressly provided for in these Terms and Conditions, any material price increases to your service will take effect following notice to you.</p>
<p>Our services’ subscription fee will be billed at the beginning of the paying portion of your subscription and each period thereafter unless and until you cancel your subscription. We automatically bill your Payment Method each period on or near the calendar day corresponding to your paying subscription’s commencement. Subscription fees are fully earned upon payment. We reserve the right to change our billing’s timing, in particular, as indicated below, if your Payment Method has not successfully been processed. If your paying subscription began on a day not contained in a given month, we may bill your Payment Method on a day in the applicable month or such other day as we deem appropriate. Your renewal date may change due to changes in your subscription. We may authorize your Payment Method in anticipation of subscription or service-related charges. If your Payment Method does not successfully process a charge for a subscription fee, you authorize us to charge you an administration fee of up to&nbsp;<em>$FEE</em>&nbsp;to keep your subscription temporarily active until the full subscription fee can be processed successfully and your full term renewed.</p>
<p>As used in these Terms and Conditions, “billing” shall indicate a charge, debit, or other payment clearance, as applicable, against your Payment Method. Unless otherwise stated differently, month or monthly refers to your billing cycle.</p>
<p>PayPal, Blockonomics, or others (depending on your geographical location) may appear on your credit card, bank statement, or phone bill for all applicable charges. If multiple websites are joined utilizing any Payment Method, your statement will list each individual purchase comprising the transaction. PayPal may include other information on your statement based on credit card association requirements, telephone regulation, National Automated Clearinghouse Association, or any other mandated rules and regulations. If you elect to use a checking account to purchase a subscription to '.get_bloginfo('name').' Premium, a debit will be executed on your checking account.</p>
<h3><strong>Taxes</strong></h3>
<p>Value-added Tax or VAT, sales tax, or other excise tax may be included in or added to the subscription fee for '.get_bloginfo('name').' Premium depending on your country, state, territory, city, or other applicable local regulations. Tax rates may vary accordingly.</p>
<h3><strong>No Refunds</strong></h3>
<p>PAYMENTS ARE NONREFUNDABLE, AND THERE ARE NO REFUNDS OR CREDITS FOR PARTIALLY USED PERIODS.</p>
<p>If we terminate your rights to use '.get_bloginfo('name').' because of a breach of these Terms and Services, you shall not be entitled to the refund of any unused portion of subscription fees. We reserve the right (but not the obligation) to refund the purchased amount if there is a technical error; this is to be determined by us at our sole discretion.</p>
<p>At any time, and for any reason, we may provide a refund, discount, or other consideration to some or all of our subscribers. The amount and form of such credits, and the decision to provide them, are at our sole discretion. The provision of credits in one instance does not entitle you to credits in the future for similar instances, nor does it obligate us to provide credits in the future under any circumstance.</p>
<h3><strong>Payment Methods</strong></h3>
<p>You may edit your Payment Method information by clicking on the “Manage Premium Account” link found at www.mypornsite.com/account-settings/ or by contacting our Customer Support in one of the manners described at www.mypornsite.com/contact/. If a payment is not successfully processed due to expiration, insufficient funds, or otherwise, and you do not edit your Payment Method information or cancel your account, you remain responsible for any uncollected amounts and authorize us to continue billing the Payment Method, as it may be updated. This may result in a change to your payment billing dates. For certain Payment Methods, your payment method’s issuer may charge you a transaction fee or other charges.</p>
<h3><strong>Cancellation of '.get_bloginfo('name').' Premium Subscription</strong></h3>
<p>You may cancel your subscription to '.get_bloginfo('name').' Premium at any time while logged into your account under the “Manage Premium Account” link found at www.mypornsite.com/account-settings/ or by notifying us either by electronic or conventional mail, by chat, or by telephone. You are liable for charges incurred until the date of the termination, and you will continue to have access to our service through the end of your monthly billing period. WE DO NOT PROVIDE REFUNDS OR CREDITS FOR ANY PARTIAL-MONTH SUBSCRIPTION PERIODS. You may also cancel your subscription to '.get_bloginfo('name').' Premium by contacting our Customer Support in one of the manners described or using the online cancellation form. If you cancel your subscription to '.get_bloginfo('name').' Premium, your account will automatically be downgraded to a regular account at the end of your current billing period.</p>
<h3><strong>Cardholder Disputes/Chargebacks</strong></h3>
<p>All chargebacks are thoroughly investigated and disputed and may prevent future purchases with our third-party Internet payment service providers, given the circumstances. Fraud claims may result in our third-party Internet payment service providers contacting your card issuer to protect you and prevent future fraudulent charges to your payment method.</p>
<h3><strong>Electronic Receipt</strong></h3>
<p>You will receive an email receipt to the email provided upon initial registration, as you may change the same over time. You may request a copy of the account of charges to your account, but we cannot guarantee the availability of such records more than 365 days after a subscription or purchase date. Requests must be made directly to PayPal. To contact PayPal, refer to our Customer Support in one of the manners described at www.mypornsite.com/contact/.</p>
<h2><strong>Accessing '.get_bloginfo('name').' and Account Security</strong></h2>
<p>We reserve the right to withdraw or amend '.get_bloginfo('name').' and any service or material we provide on '.get_bloginfo('name').', in our sole discretion without notice. We will not be liable if, for any reason, all or any part of '.get_bloginfo('name').' is unavailable at any time or for any period. From time to time, we may restrict access to some parts of '.get_bloginfo('name').', or entire '.get_bloginfo('name').', to users, including registered users.</p>
<p>You are responsible for:</p>
<ul><li>making all arrangements necessary for you to have access to '.get_bloginfo('name').', and</li></ul>
<ul><li>ensuring that all persons who access '.get_bloginfo('name').' through your internet connection are aware of these Terms and Conditions and comply with them.</li></ul>
<p>To access '.get_bloginfo('name').' or some of the resources they offer, you may be asked to provide certain registration details or other information. It is a condition of your use of '.get_bloginfo('name').' that all the information you provide on '.get_bloginfo('name').' is correct, current, and complete. You agree that all information you provide to register with '.get_bloginfo('name').' or otherwise, including but not limited to through the use of any interactive features on '.get_bloginfo('name').', is governed by our Privacy Policy, and you consent to all actions we take concerning your information consistent with our Privacy Policy.</p>
<p>If you choose or are provided with a user name, password, or any other piece of information as part of our security procedures, you must treat such information as confidential, and you must not disclose it to any other person. You are fully responsible for all activities that occur under your user name or password. You also acknowledge that your account is personal to you and agree not to provide any other person with access to '.get_bloginfo('name').' or portions of '.get_bloginfo('name').' using your user name, password, or other security information. You agree to notify us immediately of any unauthorized access to or use of your user name or password or any other security breach by contacting us at support@mypornsite.com. You also agree to ensure that you exit from your account at the end of each session. You should use particular caution when accessing your account from a public or shared computer so that others cannot view or record your password or other personal information. Although '.get_bloginfo('name').' will not be liable for your losses caused by any unauthorized use of your account, you may be liable for the losses of '.get_bloginfo('name').' or others due to such unauthorized use.</p>
<p>If you interact with third-party service providers or with us, and you provide information, including account or credit card or other payment information, you agree that all information that you provide will be accurate, complete, and current. You will review all policies and agreements applicable to the use of third-party services. If you use '.get_bloginfo('name').' over mobile devices, you hereby acknowledge that your carrier’s normal rates and fees, such as excess broadband fees, will still apply.</p>
<p>We have the right to disable any user name, password, or other identifiers, whether chosen by you or provided by us, at any time in our sole discretion for any or no reason, including if, in our opinion, you have violated any provision of these Terms and Conditions.</p>
<p>You acknowledge that '.get_bloginfo('name').' reserves the right to charge fees for its services and '.get_bloginfo('name').' access and to change its fees at its sole discretion.</p>
<h2><strong>Limited, Conditional License to Use Our Intellectual Property</strong></h2>
<p>'.get_bloginfo('name').', '.get_bloginfo('name').' Premium, and our associated logos and names are our trademarks and service marks. Other trademarks, service marks, names, and logos used on or through '.get_bloginfo('name').', such as trademarks, service marks, names, or logos associated with third-party content providers, are the trademarks, service marks, or logos of their respective owners. You are granted no right or license concerning any of the trademarks mentioned earlier, service marks, or logos.</p>
<p>The inclusion of images or text containing the trademarks or service marks or the name or likeness of any person, including any celebrity, does not constitute an endorsement, express or implied, by any such person, of '.get_bloginfo('name').' or vice versa.</p>
<p>'.get_bloginfo('name').' and certain materials available on or through '.get_bloginfo('name').' are content we own, authored, created, purchased, or licensed (collectively, our “<strong>Works</strong>”). Our Works may be protected by copyright, trademark, patent, trade secret, and other laws, and we reserve and retain all rights in our Works and '.get_bloginfo('name').'.</p>
<p>We hereby grant you a conditional, royalty-free, limited, revocable, non-sublicensable, non-transferable, and non-exclusive license to access '.get_bloginfo('name').' and our Works solely for your personal use in connection with using '.get_bloginfo('name').'.</p>
<p>We grant you a conditional and limited license to access, view, and display '.get_bloginfo('name').' and our Works, and to create and display transient copies of '.get_bloginfo('name').' and our Works as necessary to view them, conditioned upon your agreement to display '.get_bloginfo('name').' whole and intact as presented by '.get_bloginfo('name').' host, complete with any advertising, to not interfere with the display of any advertising, and not to use ad blocking software of any kind. This limited license is further conditioned upon your agreement not to use any information obtained from or through '.get_bloginfo('name').' to block or interfere with the display of any advertising on '.get_bloginfo('name').' or to implement, modify, or update any software or filter lists that block or interfere with the display of any advertising on '.get_bloginfo('name').'. Interference with the display of any advertising on '.get_bloginfo('name').', use of ad-blocking software to block or disable any advertising while viewing '.get_bloginfo('name').', or use of information obtained from or through '.get_bloginfo('name').' to update any ad blocking software or filter lists, is prohibited, violates the conditions of your limited license to view '.get_bloginfo('name').' and our Works and constitutes copyright infringement.</p>
<p>You may not otherwise reproduce, distribute, communicate to the public, make available, adapt, publicly perform, link to, or publicly display '.get_bloginfo('name').' and our Works or any adaptations thereof unless expressly set forth herein. Such conduct would exceed the scope of your license and constitute copyright infringement.</p>
<p>'.get_bloginfo('name').' may provide an “Embeddable Player” feature, which you may incorporate into your own website for use in accessing the Content on '.get_bloginfo('name').'. You may not modify, build upon or block any portion or functionality of the Embeddable Player in any way, including but not limited to links back to '.get_bloginfo('name').'.</p>
<p>The above-described license is conditioned on your compliance with these Terms and Conditions, including, specifically, your agreement to view '.get_bloginfo('name').' whole and intact as presented by '.get_bloginfo('name').' host, complete with any advertising, and shall terminate upon termination of these Terms and Conditions. Any license you have obtained will be automatically rescinded and terminated if you breach any provision of these Terms and Conditions. In order to protect our rights, some Content made available on '.get_bloginfo('name').' may be controlled by digital rights management technologies, which will restrict how you may use the Content. You must not circumvent, remove, delete, disable, alter, or otherwise interfere with any digital rights management technology. Such conduct is prohibited by law.</p>
<p>If '.get_bloginfo('name').' allows you to download or otherwise copy our Works, you are not buying or being gifted copies thereof. Instead, you are licensing a limited, revocable, non-sublicensable, non-transferable, and non-exclusive right to possess and use the copies for personal, non-commercial use, subject to specific terms and conditions (the “<strong>Download License</strong>”). Under this Download License, you may not thereafter reproduce, distribute, communicate to the public, make available, adapt, publicly perform, or publicly display '.get_bloginfo('name').' and our Works or any adaptations thereof unless expressly set forth herein. Such conduct would exceed the scope of your Download License and constitute copyright infringement. You will delete or otherwise dispose of all copies of Works in your possession at the expiration of your Download License or the termination of these Terms and Conditions.</p>
<h2><strong>Content Posted by Users</strong></h2>
<p>As '.get_bloginfo('name').'’s account holder, you may submit Content to '.get_bloginfo('name').' and other websites linked to '.get_bloginfo('name').', including videos, images, and user comments. You understand that '.get_bloginfo('name').' does not guarantee any confidentiality concerning any Content you submit.</p>
<p>You shall be solely responsible for your own Content and the consequences of posting, uploading, publishing, transmitting, or otherwise making available your Content on '.get_bloginfo('name').'. You understand and acknowledge that you are responsible for any Content you submit or contribute. You, not us, have full responsibility for such Content, including its legality, reliability, accuracy, and appropriateness. We do not control the Content you submit or contribute, and we do not make any guarantee whatsoever related to Content submitted or contributed by users. Although we sometimes review Content submitted or contributed by users, we are not obligated to do so. Under no circumstances will we be liable or responsible in any way for any claim related to Content submitted or contributed by users.</p>
<p>You affirm, represent, and warrant that you own or have the necessary licenses, rights, consents, and permissions to publish the Content you submit. You license to '.get_bloginfo('name').' all patent, trademark, trade secret, copyright, or other proprietary rights in and to such Content for publication on '.get_bloginfo('name').' pursuant to these Terms and Conditions.</p>
<p>You further agree that Content you submit to '.get_bloginfo('name').' will not contain third party copyrighted material or material that is subject to other third-party proprietary rights unless you have permission from the rightful owner of the material or you are otherwise legally entitled to post the material and to grant to '.get_bloginfo('name').' all of the license rights granted herein.</p>
<p>You agree and understand that '.get_bloginfo('name').' (and its successors and affiliates) may use your Content for promotional or commercial purposes and render the services according to these Terms and Services. For clarity, you retain all of your ownership rights in your Content. By submitting Content to '.get_bloginfo('name').', you hereby grant '.get_bloginfo('name').'’s operators an unlimited, worldwide, perpetual, non-exclusive, royalty-free, sublicensable, and transferable license to use, reproduce, publish, distribute, broadcast, market, create derivative works of, adapt, translate, publicly display, communicate, or perform, make available or otherwise use all of the Content, including without limitation for promoting and redistributing part or all of '.get_bloginfo('name').' (and derivative works thereof) in any media formats and through any media channels. You also waive to the full extent permitted by law any and all claims against us related to moral rights in the Content. In no circumstances will we be liable to you for any exploitation of any Content that you post. You also hereby grant each user of '.get_bloginfo('name').' a non-exclusive, royalty-free license to access your Content through '.get_bloginfo('name').' and to use, reproduce, display, communicate, and perform such Content as permitted through the functionality of '.get_bloginfo('name').' and under these Terms and Conditions. The above licenses granted by you in video Content you submit to '.get_bloginfo('name').' terminate within a commercially reasonable time after removing or deleting your Content from '.get_bloginfo('name').'. However, you understand and agree that '.get_bloginfo('name').' may retain, but not display, distribute, or perform, server copies of your videos that have been removed or deleted. The above licenses granted by you in user comments you submit are perpetual and irrevocable.</p>
<p>'.get_bloginfo('name').' does not endorse any Content submitted by any user or other licensor or any opinion, recommendation, or advice expressed therein. '.get_bloginfo('name').' expressly disclaims any and all liability in connection with Content. '.get_bloginfo('name').' does not permit copyright infringing activities and infringement of intellectual property rights on '.get_bloginfo('name').'. '.get_bloginfo('name').' will remove all Content if properly notified that such Content infringes on another’s intellectual property rights. '.get_bloginfo('name').' reserves the right to remove Content without prior notice.</p>
<p>All Content you submit must comply with the Content standards set out in these Terms and Conditions.</p>
<p>If any of the Content that you post to or through '.get_bloginfo('name').' contains ideas, suggestions, documents, or proposals to us, we will have no obligation of confidentiality, express or implied, concerning such Content, and we shall be entitled to use, exploit, or disclose (or choose not to use or disclose) such Content in our sole discretion without any obligation to you whatsoever ( i.e., you will not be entitled to any compensation or reimbursement of any kind from us under any circumstances).</p>
<p>In the process of posting Content to '.get_bloginfo('name').', you may be asked to provide some personally identifying information, such as your name, address, email address, password, and other documentation. You may also be asked to provide such information to use certain features of '.get_bloginfo('name').'.</p>
<p>We will keep a record of the information you provide, including your personally identifiable information. That information may be linked in our records to other information you provide, including Content. We will not provide your name or additional personally-identifying information to our advertisers or business partners without your permission. Please note that some of the information you provide in registering for and using '.get_bloginfo('name').', including the name used in registering for and using '.get_bloginfo('name').' or other personally identifying information, may be displayed to other members of '.get_bloginfo('name').' and may become public. In addition, we may disclose the personally identifying information and documentation you provide in some limited circumstances, including but not limited to responses to subpoenas or requests by law enforcement or as required by taxing authorities.</p>
<h2><strong>Use of '.get_bloginfo('name').'</strong></h2>
<p>You agree that you will only use '.get_bloginfo('name').' and our services for the lawful purposes expressly permitted and contemplated by these Terms and Conditions. You may not use '.get_bloginfo('name').' and our services for any other purposes, including but not limited to commercial purposes, without our express written consent.</p>
<p>You agree that you will view '.get_bloginfo('name').' and its content unaltered and unmodified. You acknowledge and understand that you are prohibited from modifying '.get_bloginfo('name').' or eliminating any of the content of '.get_bloginfo('name').', including ads. By using '.get_bloginfo('name').', you expressly agree to accept advertising served on and through '.get_bloginfo('name').' and to refrain from using ad-blocking software when visiting the '.get_bloginfo('name').'.</p>
<p>Content is provided to you AS IS. You may access Content for your information and personal use solely as intended through the provided functionality of '.get_bloginfo('name').' and as permitted under these Terms and Conditions. You shall not download any Content unless you see a “download” or similar link displayed by '.get_bloginfo('name').' for that Content. You shall not copy, reproduce, distribute, transmit, broadcast, display, sell, license, or otherwise exploit any Content for any other purposes without the prior written consent of '.get_bloginfo('name').'’s operator or the respective licensors of the Content. '.get_bloginfo('name').' and its licensors reserve all rights not expressly granted in and to '.get_bloginfo('name').' and the Content.</p>
<h2><strong>Prohibited Uses</strong></h2>
<p>You agree that you will not use or attempt to use any method, device, software, or routine to harm others or interfere with the functioning of '.get_bloginfo('name').', or use and monitor any information in or related to '.get_bloginfo('name').' for any unauthorized purpose.</p>
<p>In addition to the general restrictions above, the following restrictions and conditions apply specifically to your use of Content. Any determination regarding breach of any of the following is final. Please review the following list of prohibited uses carefully before using '.get_bloginfo('name').'. Expressly, you agree not to use '.get_bloginfo('name').' to:</p>
<ul><li>violate any law or encourage or provide instructions to another to do so;</li></ul>
<ul><li>act in a manner that negatively affects other users’ ability to use '.get_bloginfo('name').', including without limitation by engaging in conduct that is harmful, threatening, abusive, inflammatory, intimidating, violent, or encouraging of violence to people or animals, harassing, stalking, invasive of another’s privacy, or racially, ethnically, or otherwise objectionable;</li></ul>
<ul><li>post any Content that depicts any person under 18 years of age (or older in any other location in which 18 is not the minimum age of majority) whether real or simulated;</li></ul>
<ul><li>post any Content for which you have not maintained written documentation sufficient to confirm that all subjects of your posts are, in fact, over 18 years of age (or older in any other location in which 18 is not the minimum age of majority);</li></ul>
<ul><li>post any Content depicting underage sexual activity, non-consensual sexual activity, revenge porn, blackmail, intimidation, snuff, torture, death, violence, incest, racial slurs, or hate speech (either orally or via the written word);</li></ul>
<ul><li>post any Content that contains falsehoods or misrepresentations that could damage '.get_bloginfo('name').' or any third party;</li></ul>
<ul><li>post any Content that is obscene, illegal, unlawful, fraudulent, defamatory, libelous, harassing, hateful, racially or ethnically offensive, or encourages conduct that would be considered a criminal offense, give rise to civil liability, violate any law, or is otherwise inappropriate;</li></ul>
<ul><li>post any Content containing unsolicited or unauthorized advertising, promotional materials, spam, junk mail, chain letters, pyramid schemes, or any other form of unauthorized solicitation;</li></ul>
<ul><li>post any Content containing sweepstakes, contests, or lotteries, or otherwise related to gambling;</li></ul>
<ul><li>post any Content containing copyrighted materials, or materials protected by other intellectual property laws, that you do not own or for which you have not obtained all necessary written permissions and releases;</li></ul>
<ul><li>post any Content which impersonates another person or falsely states or otherwise misrepresents your affiliation with a person;</li></ul>
<ul><li>use '.get_bloginfo('name').' (or post any Content that) in any way that promotes or facilitates prostitution, solicitation of prostitution, human trafficking, or sex trafficking;</li></ul>
<ul><li>use '.get_bloginfo('name').' to arrange any in-person meetings for purposes of sexual activity for hire;</li></ul>
<ul><li>deploy programs, software, or applications designed to interrupt, destroy or limit the functionality of any computer software or hardware or telecommunications equipment, including by engaging in any denial of service attack or similar conduct;</li></ul>
<ul><li>deploy or use programs, software or applications designed to harm, interfere with the operation of, or access in an unauthorized manner, services, networks, servers, or other infrastructure;</li></ul>
<ul><li>exceed your authorized access to any portion of '.get_bloginfo('name').';</li></ul>
<ul><li>remove, delete, alter, circumvent, avoid, or bypass any digital rights management technology, encryption or security tools used anywhere on '.get_bloginfo('name').' or in connection with our services;</li></ul>
<ul><li>collect or store personal data about anyone;</li></ul>
<ul><li>alter or modify without permission any part of '.get_bloginfo('name').' or its content, including ads;</li></ul>
<ul><li>obtain or attempt to access or otherwise obtain any Content or information through any means not intentionally made available or provided for through '.get_bloginfo('name').';</li></ul>
<ul><li>exploit errors in design, features that are not documented, or bugs to gain access that would otherwise not be available.</li></ul>
<p>Additionally, you agree not to:</p>
<ul><li>use '.get_bloginfo('name').' in any manner that could disable, overburden, damage, or impair the site or interfere with any other party’s use of '.get_bloginfo('name').', including their ability to engage in real-time activities through '.get_bloginfo('name').';</li></ul>
<ul><li>use any robot, spider, or other automatic devices, process, or means to access '.get_bloginfo('name').' for any purpose, including monitoring or copying any of the material on '.get_bloginfo('name').' without our prior written consent;</li></ul>
<ul><li>use any manual process to monitor or copy any of the material on '.get_bloginfo('name').' or for any other unauthorized purpose without our prior written consent;</li></ul>
<ul><li>use any information obtained from or through '.get_bloginfo('name').' to block or interfere with the display of any advertising on '.get_bloginfo('name').', or to implement, modify or update any software or filter lists that block or interfere with the display of any advertising on '.get_bloginfo('name').';</li></ul>
<ul><li>use any device, bots, scripts, software, or routine that interferes with the proper working of '.get_bloginfo('name').' or that shortcut or alter '.get_bloginfo('name').' functions to run or appear in ways that are not intended by '.get_bloginfo('name').'’s design;</li></ul>
<ul><li>introduce or upload any viruses, Trojan horses, worms, logic bombs, time bombs, cancelbots, corrupted files or any other similar software, program, or material which is malicious or technologically harmful or that that may damage the operation of another’s property or of '.get_bloginfo('name').' or our services;</li></ul>
<ul><li>attempt to gain unauthorized access to, interfere with, damage, or disrupt any parts of '.get_bloginfo('name').', the server on which '.get_bloginfo('name').' is stored, or any server, computer, or database connected to '.get_bloginfo('name').';</li></ul>
<ul><li>remove any copyright or other proprietary notices from '.get_bloginfo('name').' or any of the materials contained therein;</li></ul>
<ul><li>attack '.get_bloginfo('name').' via a denial-of-service attack or a distributed denial-of-service attack;</li></ul>
<ul><li>otherwise attempt to interfere with the proper working of '.get_bloginfo('name').'.</li></ul>
<h2><strong>Monitoring and Enforcement; Termination</strong></h2>
<p>We have the right but not the obligation to:</p>
<ul><li>remove or refuse to post any Content you submit or contribute to '.get_bloginfo('name').' for any or no reason in our sole discretion;</li></ul>
<ul><li>monitor any communication occurring on or through '.get_bloginfo('name').' to confirm compliance with these Terms and Conditions, the security of '.get_bloginfo('name').', or any legal obligation;</li></ul>
<ul><li>take any action concerning any Content posted by you that we deem necessary or appropriate in our sole discretion, including if we believe that such Content violates these Terms and Conditions, infringes any intellectual property right or other rights of any person or entity, threatens the personal safety of users of '.get_bloginfo('name').' or the public, or could create liability for us;</li></ul>
<ul><li>disclose your personally-identifying information or other information about you to any third party who claims that Content posted by you violates their rights, including their intellectual property rights, or their right to privacy;</li></ul>
<ul><li>take appropriate legal action, including without limitation, referral to law enforcement, for any illegal or unauthorized use of '.get_bloginfo('name').';</li></ul>
<ul><li>terminate or suspend your access to all or part of '.get_bloginfo('name').' for any or no reason, including without limitation, any violation of these Terms and Conditions.</li></ul>
<p>Without limiting the preceding, we have the right to fully cooperate with any law enforcement authorities or court order requesting or directing us to disclose the identity or other information of anyone posting any Content on or through '.get_bloginfo('name').'. YOU WAIVE AND HOLD US HARMLESS AND OUR SITE OPERATORS, ITS PARENT CORPORATION, ITS RESPECTIVE AFFILIATES, LICENSORS, SERVICE PROVIDERS, OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, SUCCESSORS, AND ASSIGNS FROM ANY CLAIMS RESULTING FROM ANY ACTION TAKEN BY US OR ANY OF THE PRECEDING PARTIES DURING OR AS A RESULT OF ITS INVESTIGATIONS AND FROM ANY ACTIONS TAKEN AS A CONSEQUENCE OF INVESTIGATIONS BY EITHER US, SUCH PARTIES, OR LAW ENFORCEMENT AUTHORITIES.</p>
<p>'.get_bloginfo('name').' takes a decisive stand against any form of child exploitation or human trafficking. If we discover that any Content involves underage individuals, or any form of force, fraud, or coercion, we will remove the Content and submit a report to the proper law enforcement authorities. If you become aware of any such Content, you agree to report it to '.get_bloginfo('name').' by contacting legal@mypornsite.com.</p>
<p>To maintain our services in a manner we deem appropriate for our venue and to the maximum extent permitted by applicable laws, '.get_bloginfo('name').' may, but will not have any obligation to, review, monitor, display, reject, refuse to post, store, maintain, accept, or remove any Content posted (including, without limitation, private messages, public comments, public group chat messages, private group chat messages, or private instant messages) by you. At our sole discretion, we may delete, move, re-format, remove, or refuse to post or otherwise make use of Content without notice or any liability to you or any third party connected with our operation of '.get_bloginfo('name').' appropriately. Without limitation, we may do so to address Content that comes to our attention that we believe is offensive, obscene, violent, harassing, threatening, abusive, illegal, or otherwise objectionable or inappropriate, or to enforce the rights of third parties or these Terms and Conditions or any applicable additional terms, including, without limitation, the Content restrictions set forth herein.</p>
<p>However, we do not undertake to review Content before it is posted on '.get_bloginfo('name').' and cannot ensure prompt removal of objectionable Content after it has been posted. Accordingly, we assume no liability for any action or inaction regarding transmissions, communications, or Content provided by any user or third party. We have no liability or responsibility to anyone for the performance or nonperformance of the activities described in this section.</p>
<h2><strong>Account Termination Policy</strong></h2>
<p>While pornographic and adult-oriented Content is accepted, '.get_bloginfo('name').' reserves the right to decide whether Content is appropriate or violates these Terms and Conditions for reasons other than copyright infringement and violations of intellectual property rights, such as, but not limited to, obscene or defamatory material. '.get_bloginfo('name').' may at any time, without prior notice and in its sole discretion, remove such Content or terminate a user’s account for submitting such material in violation of these Terms and Conditions.</p>
<p>If you violate the letter or spirit of these Terms and Conditions or otherwise create risk or possible legal exposure for us, we can terminate access to '.get_bloginfo('name').' or stop providing all or part of '.get_bloginfo('name').' to you.</p>
<h2><strong>Copyrights and Other Intellectual Property</strong></h2>
<p>'.get_bloginfo('name').' operates a clear copyright policy concerning any Content alleged to infringe the copyright of a third party. Details of that policy can be found at&nbsp;www.mypornsite.com/dmca/. If you believe that any Content violates your copyright, please see our Copyright Policy for instructions on sending us a notice of copyright infringement. As part of our Copyright Policy, '.get_bloginfo('name').' will terminate user access to '.get_bloginfo('name').' if, under appropriate circumstances, a user has been determined to be a repeat infringer.</p>
<p>'.get_bloginfo('name').' is not in a position to mediate trademark disputes between users and trademark owners. Accordingly, we encourage trademark owners to resolve any dispute directly with the user in question or seek any resolution in court or other judicial means. If you’re sure you want to report content on '.get_bloginfo('name').' that you believe infringes your trademark, you can do so by contacting&nbsp;www.mypornsite.com/contact/. '.get_bloginfo('name').' is willing to perform a limited investigation of reasonable complaints and remove the content in clear infringement cases. Only the trademark owner or their authorized representative may file a report of trademark infringement. Please note that we regularly provide:</p>
<ul><li>The rights owner’s name.</li><li>Your email address.</li><li>The details of your report to the person who posted the content you are reporting.</li></ul>
<p>This person may contact you with the information you provide.</p>
<h2><strong>Abuse Reporting</strong></h2>
<p>'.get_bloginfo('name').' does not permit any form of revenge porn, blackmail, or intimidation. Violations of this policy can be reported through the following link:&nbsp;www.mypornsite.com/content-removal/.</p>
<h2><strong>Reliance on Information Posted</strong></h2>
<p>The information presented on or through '.get_bloginfo('name').' is made available solely for general information purposes. We do not warrant the accuracy, completeness, or usefulness of this information. Any reliance you place on such information is strictly at your own risk. We disclaim all liability and responsibility arising from any reliance placed on such materials by you or any other visitor to '.get_bloginfo('name').' or anyone who may be informed of any of its contents.</p>
<p>'.get_bloginfo('name').' includes Content provided by third parties, including materials provided by other users, bloggers, third-party licensors, syndicators, aggregators, and reporting services. All statements or opinions expressed in these materials, and all articles and responses to questions and other content, other than the content provided by us, are solely the opinions and the responsibility of the person or entity providing those materials. These materials do not necessarily reflect our opinion. We are not responsible or liable to you or any third party for the content or accuracy of any materials provided by any third parties.</p>
<h2><strong>Changes to '.get_bloginfo('name').'</strong></h2>
<p>We may update the content on '.get_bloginfo('name').' from time to time, but their content is not necessarily complete or up-to-date. Any of the material on '.get_bloginfo('name').' may be out of date at any given time, and we are under no obligation to update such material.</p>
<h2><strong>Information about You and Your Visits to '.get_bloginfo('name').'</strong></h2>
<p>All information we collect on '.get_bloginfo('name').' is subject to our Privacy Policy. By using '.get_bloginfo('name').', you acknowledge that you have read and understood the terms of the Privacy Policy and that you consent to all actions taken by us with respect to your information in compliance with the Privacy Policy.</p>
<h2><strong>Collection and Use of Your Usage Information by Advertisers and Others</strong></h2>
<p>'.get_bloginfo('name').' allows others to display advertisements using '.get_bloginfo('name').'. These third parties use technology to deliver advertisements you see using '.get_bloginfo('name').' directly to your browser. In doing so, they may automatically receive your IP, or “Internet Protocol”, address. Others that place advertising using '.get_bloginfo('name').' may have the ability to use cookies or web beacons to collect information, including information about your usage of '.get_bloginfo('name').'. We do not control the processes that advertisers use to collect information. However, IP addresses, cookies, and web beacons alone generally cannot be used to identify individuals, only machines. Therefore, advertisers and others whose advertisements or content may be provided through the service generally will not know who you are unless you provide additional information to them, by responding to an advertisement, by entering into an agreement with them, or by some other means.</p>
<h2><strong>Linking to '.get_bloginfo('name').' and Social Media Features</strong></h2>
<p>You may link to '.get_bloginfo('name').', provided you do so in a fair and legal way that does not damage our reputation or take advantage of it. Still, you must not establish a link in such a way as to suggest any form of association, approval, or endorsement on our part without our express written consent.</p>
<p>'.get_bloginfo('name').' may provide certain social media features that enable you to:</p>
<ul><li>link from your own or certain third-party websites to certain content on '.get_bloginfo('name').';</li></ul>
<ul><li>send emails or other communications with certain content, or links to certain content, on '.get_bloginfo('name').';</li></ul>
<ul><li>cause limited portions of content on '.get_bloginfo('name').' to be displayed or appear to be displayed on your own or certain third-party websites.</li></ul>
<p>You may use these features solely as they are provided by us and solely concerning the content they are displayed with and otherwise in accordance with any additional terms and conditions we provide with respect to such features. Subject to the foregoing, you must not:</p>
<ul><li>cause '.get_bloginfo('name').' or portions of '.get_bloginfo('name').' to be displayed, or appear to be displayed by, for example, framing, deep linking or in-line linking, on any other site,</li></ul>
<ul><li>otherwise take any action concerning the materials on '.get_bloginfo('name').' that is inconsistent with any other provision of these Terms and Conditions.</li></ul>
<p>The sites from which you are linking, or on which you make certain content accessible, must comply in all respects with the content standards set out in these Terms and Conditions.</p>
<p>You agree to cooperate with us in causing any unauthorized framing or linking immediately to cease. We reserve the right to withdraw linking permission without notice.</p>
<p>We may disable all or any social media features and any links at any time without notice at our sole discretion.</p>
<h2><strong>Links from '.get_bloginfo('name').'</strong></h2>
<p>If '.get_bloginfo('name').' contains links to other sites and resources provided by third parties, these links are provided for your convenience only. This includes links contained in advertisements, including banner advertisements and sponsored links. We have no control over, and assume no responsibility for, the contents, privacy policies, or practices of those sites or resources and accept no responsibility for them or for any loss or damage that may arise from your use of them. Inclusion of, linking to, or permitting the use or installation of any third-party site, applications, software, content, or advertising does not imply approval or endorsement thereof by us. If you decide to access any of the third-party sites linked to '.get_bloginfo('name').', you do so entirely at your own risk and subject to the terms and conditions of use for such sites. Further, you agree to release us from any and all liability arising from your use of any third-party website, content, service, or software accessed through '.get_bloginfo('name').'.</p>
<p>Your communications or dealings with, or participation in promotions of, sponsors, advertisers, or other third parties found through '.get_bloginfo('name').', are solely between you and such third parties. You agree that '.get_bloginfo('name').' shall not be responsible or liable for any loss or damage of any sort incurred due to any dealings with such sponsors, third parties, or advertisers or as the result of their presence on '.get_bloginfo('name').'.</p>
<h2><strong>Permitted Disclosures of Personal Information</strong></h2>
<p>'.get_bloginfo('name').' generally does not collect personally identifiable information (data such as your name, email address, password, and the content of your communications) unless you submit or communicate Content through '.get_bloginfo('name').' or register with us to use certain features of '.get_bloginfo('name').'. '.get_bloginfo('name').' will not disclose any personally identifiable information it collects or obtains except:</p>
<ul><li>As described in these Terms and Conditions or our Privacy Policy.</li><li>After obtaining your permission to a specific use or disclosure.</li><li>If '.get_bloginfo('name').' is required to do so to comply with any valid legal process or governmental request (such as a court order, search warrant, subpoena, civil discovery request, or statutory requirement) and may in our sole discretion advise you of such process or request.</li><li>As required to protect '.get_bloginfo('name').'’s property, safety, or operations, or the property or safety of others.</li><li>To a person that acquires '.get_bloginfo('name').', or the assets of '.get_bloginfo('name').'’s operator in connection with which such information has been collected or used.</li><li>As otherwise required by law.</li></ul>
<p>If '.get_bloginfo('name').' is required to respond to or comply with any of these information requests, we reserve the right to charge you with the cost of responding to or complying with such information request, including, but not limited to, costs of research, copies, media storage, mail, and document delivery, as well as any applicable legal fees.</p>
<p>'.get_bloginfo('name').' will have access to all information you have submitted or created for as long as reasonably required to comply with or investigate any information requests or protect '.get_bloginfo('name').'. To enforce these Terms and Conditions, protect intellectual property rights, comply with legal processes and the law, and protect '.get_bloginfo('name').', you agree to allow '.get_bloginfo('name').' to access your information.</p>
<h2><strong>Indemnification</strong></h2>
<p>To the extent permitted by applicable law, you agree to defend, indemnify and hold harmless '.get_bloginfo('name').', its site operator, its parent corporation, its respective affiliates, licensors, service providers, officers, directors, employees, agents, successors, and assigns from and against any and all claims, damages, judgments, awards, obligations, losses, liabilities, costs or debt, and expenses (including but not limited to attorney’s fees) arising from:</p>
<ul><li>Your use of and access to '.get_bloginfo('name').'.</li><li>Your violation of any term of these Terms and Conditions.</li><li>Your violation of any third party right, including without limitation any copyright, property, or privacy right.</li><li>Any claim that your Content caused damage to a third party.</li></ul>
<p>This defense and indemnification obligation will survive these Terms and Conditions and your use of '.get_bloginfo('name').'. You agree that we shall have the sole right and obligation to control the legal defense against any such claims, demands, or litigation, including the right to select counsel of our choice and to compromise or settle any such claims, demands, or litigation.</p>
<h2><strong>Disclaimers</strong></h2>
<p>YOU USE '.get_bloginfo('name').' AT YOUR SOLE RISK. WE PROVIDE '.get_bloginfo('name').' “AS IS” AND “AS AVAILABLE. “TO THE FULLEST EXTENT PERMITTED BY LAW, '.get_bloginfo('name').', ITS SITE OPERATOR, AND ITS RESPECTIVE OFFICERS, DIRECTORS, EMPLOYEES, AND AGENTS DISCLAIM ALL WARRANTIES OF ANY KIND RELATED TO '.get_bloginfo('name').' AND GOODS OR SERVICES PURCHASED AND OBTAINED THROUGH '.get_bloginfo('name').', WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR LOSS OF DATA THAT RESULTS FROM YOUR USE OF '.get_bloginfo('name').'. WE MAKE NO WARRANTY OR REPRESENTATION ABOUT THE ACCURACY OR COMPLETENESS OF '.get_bloginfo('name').'’S CONTENT OR THE CONTENT OF ANY SITES LINKED TO '.get_bloginfo('name').' OR THAT '.get_bloginfo('name').' WILL MEET YOUR REQUIREMENTS AND ASSUME NO LIABILITY OR RESPONSIBILITY FOR ANY (I) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT, (II) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF '.get_bloginfo('name').' OR OUR SERVICES, (III) ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SECURE SERVERS OR ANY AND ALL PERSONAL INFORMATION OR FINANCIAL INFORMATION STORED THEREIN, (IV) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM '.get_bloginfo('name').' OR OUR SERVICES, (IV) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE WHICH MAY BE TRANSMITTED TO OR THROUGH '.get_bloginfo('name').' OR OUR SERVICES BY ANY THIRD PARTY, OR (V) ANY ERRORS OR OMISSIONS IN ANY CONTENT OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF ANY CONTENT POSTED, EMAILED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA '.get_bloginfo('name').' OR OUR SERVICES. '.get_bloginfo('name').' DOES NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR ANY PRODUCT OR SERVICE ADVERTISED OR OFFERED BY A THIRD PARTY THROUGH '.get_bloginfo('name').' OR OUR SERVICES OR ANY HYPERLINKED SERVICES OR FEATURED IN ANY BANNER OR OTHER ADVERTISING, AND '.get_bloginfo('name').' WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT OR SERVICE THROUGH ANY MEDIUM OR IN ANY ENVIRONMENT, YOU SHOULD USE YOUR BEST JUDGMENT AND EXERCISE CAUTION WHERE APPROPRIATE.</p>
<p>NO INFORMATION OBTAINED BY YOU FROM US OR THROUGH '.get_bloginfo('name').' SHALL CREATE ANY WARRANTY NOT EXPRESSLY STATED IN THESE TERMS.</p>
<h2><strong>Limitation of Liability</strong></h2>
<p>IN NO EVENT SHALL '.get_bloginfo('name').', ITS SITE OPERATOR, AND ITS RESPECTIVE OFFICERS, DIRECTORS, EMPLOYEES, OR AGENTS, BE LIABLE TO YOU FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE, OR CONSEQUENTIAL DAMAGES WHATSOEVER RESULTING FROM ANY (I) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT, (II) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF '.get_bloginfo('name').' OR OUR SERVICES, (III) ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN, (IV) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM '.get_bloginfo('name').', (IV) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE, WHICH MAY BE TRANSMITTED TO OR THROUGH '.get_bloginfo('name').' OR SERVICES BY ANY THIRD PARTY, (V) ANY ERRORS OR OMISSIONS IN ANY CONTENT OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF YOUR USE OF ANY CONTENT POSTED, EMAILED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA '.get_bloginfo('name').' OR OUR SERVICES, AND/OR (VI) INTERACTIONS YOU HAVE WITH THIRD-PARTY ADVERTISEMENTS OR SERVICE PROVIDERS, OR THIRD-PARTY SITES, FOUND ON OR THROUGH '.get_bloginfo('name').', INCLUDING PAYMENT AND DELIVERY OF RELATED GOODS OR SERVICES, AND ANY OTHER TERMS, CONDITIONS, POLICIES, WARRANTIES OR REPRESENTATIONS ASSOCIATED WITH SUCH DEALINGS, WHETHER BASED ON WARRANTY, CONTRACT, TORT, OR ANY OTHER LEGAL THEORY, AND WHETHER OR NOT '.get_bloginfo('name').' OR ITS SITE OPERTOR ARE ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE PRECEDING LIMITATION OF LIABILITY SHALL APPLY TO THE FULLEST EXTENT PERMITTED BY LAW IN THE APPLICABLE JURISDICTION.</p>
<p>YOU SPECIFICALLY ACKNOWLEDGE THAT '.get_bloginfo('name').' SHALL NOT BE LIABLE FOR CONTENT OR THE DEFAMATORY, OFFENSIVE, OR ILLEGAL CONDUCT OF ANY THIRD PARTY AND THAT THE RISK OF HARM OR DAMAGE FROM THE FOREGOING RESTS ENTIRELY WITH YOU.</p>
<p>YOU FURTHER ACKNOWLEDGE THAT ANY CONTENT UPLOADED TO '.get_bloginfo('name').' MAY BE VIEWED, DOWNLOADED, REPUBLISHED, AND DISTRIBUTED – POTENTIALLY IN VIOLATION OF YOUR RIGHTS OR THIS AGREEMENT – AND THAT YOU ASSUME SUCH RISKS AS A MATERIAL PART OF THESE TERMS AND CONDITIONS.</p>
<p>YOU AGREE NOT TO FILE ANY LAWSUIT OR PROCEEDING INCONSISTENT WITH THE FOREGOING LIABILITY LIMITATIONS.</p>
<p>Any claim by you that may arise in connection with these Terms and Conditions will be compensable by monetary damages, and you will in no event be entitled to injunctive or other equitable relief.</p>
<h2><strong>Limitation on Time to File Claims</strong></h2>
<p>REGARDLESS OF ANY STATUTE OR LAW TO THE CONTRARY, ANY CAUSE OF ACTION OR CLAIM YOU MAY HAVE ARISING OUT OF OR RELATING TO THESE TERMS AND CONDITIONS OR '.get_bloginfo('name').' MUST BE COMMENCED WITHIN ONE (1) YEAR AFTER THE CAUSE OF ACTION ACCRUES. OTHERWISE, SUCH CAUSE OF ACTION OR CLAIM IS PERMANENTLY BARRED.</p>
<h2><strong>Your Comments and Concerns</strong></h2>
<p>'.get_bloginfo('name').' Ltd,&nbsp;<em>Address, City, Country ZIP Code.&nbsp;</em>All notices of copyright infringement claims should be sent to the copyright agent designated in our Copyright Policy in the manner and by the means set forth therein.</p>
<p>All other feedback, comments, requests for technical support, and other communications relating to '.get_bloginfo('name').' should be directed to support@mypornsite.com.</p>
<h2><strong>Assignment</strong></h2>
<p>These Terms and Conditions, and any rights and licenses granted hereunder, may not be transferred or assigned by you but may be assigned by us without restriction.</p>
<h2><strong>Fees</strong></h2>
<p>You acknowledge that '.get_bloginfo('name').' reserves the right to charge for its services and to change its fees from time to time in its sole discretion. Furthermore, in the event '.get_bloginfo('name').' terminates your rights to use '.get_bloginfo('name').' because of a breach of these Terms and Conditions, you shall not be entitled to the refund of any unused portion of subscription fees. If '.get_bloginfo('name').' is required to incur fees or expenses as a result of your activity, you agree to reimburse any such fees or expenses.</p>
<h2><strong>Miscellaneous</strong></h2>
<p>These Terms and Conditions, your use of '.get_bloginfo('name').', and the relationship between you and us shall be governed by the Netherlands’ laws, without regard to conflict of law rules. Nothing contained in these Terms and Conditions shall constitute an agreement to the application of any other nation’s laws to '.get_bloginfo('name').'. You agree that '.get_bloginfo('name').' shall be deemed passive that does not give rise to personal jurisdiction over us, either specific or general, in jurisdictions other than The Netherlands. The sole and exclusive jurisdiction and venue for any action or proceeding arising out of or related to these Terms and Services shall be in an appropriate court located in Amsterdam, The Netherlands. You hereby submit to the jurisdiction and venue of said Courts.</p>
<p>No waiver by us of any term or condition outlined in these Terms and Conditions shall be deemed a further or continuing waiver of such term or condition or a waiver of any other term or condition. Any failure by us to assert a right or provision under these Terms and Conditions shall not constitute a waiver of such right or provision.</p>
<p>If any provision of these Terms and Conditions is deemed invalid by a court of competent jurisdiction, the invalidity of such provision shall not affect the validity of the remaining provisions of these Terms and Conditions, which shall remain in full force and effect.</p>
<p>The Terms and Conditions, our Privacy Policy, our Copyright Policy, and any documents they expressly incorporate by reference constitute the sole and entire agreement between you and us with respect to '.get_bloginfo('name').'.</p>
<p>We may terminate these Terms and Conditions for any or no reason at any time by notifying you through a notice on '.get_bloginfo('name').', by email, or by any other method of communication. Any such termination will be without prejudice to our rights, remedies, claims, or defenses hereunder. Upon termination of the Terms and Conditions, you will no longer have a right to access your account or your Content. We will not have any obligation to assist you in migrating your data or your Content, and we may not keep any backup of any of your Content. We undertake no responsibility for deleting your Content under these Terms and Conditions. Note that, even if your Content is deleted from our active servers, it may remain in our archives (but we have no obligation to archive or backup your Content) and subject to the licenses outlined in these Terms and Conditions.</p>';
	$terms_conditions = [];
	$terms_conditions['ID'] = get_page_by_path('terms-and-conditions')->ID;
	$terms_conditions['post_content'] = $terms_content;
	wp_update_post(wp_slash($terms_conditions));

	$content_removal_content = '<h2>Report Abusive or Illegal Content</h2>
<p>'.get_bloginfo('name').' takes all content removal requests seriously, and our dedicated support team works around the clock to quickly process and remove content that violates our Terms and Conditions.</p>
<p>Your report is completely <strong>confidential</strong>. When you report content, the user who posted the content will not see your name or any information about you.</p>
<p>Please access the link provided below should you be the victim of or come across content that you have personal knowledge of as constituting:</p>
<ul><li>Non-consensual production or distribution of your image (including but not limited to such things as revenge porn, blackmail, exploitation);</li><li>Content that reveals personally identifiable information (including but not limited to such things as name, address, phone number, IP address);&nbsp; <strong>OR</strong></li><li>Otherwise abusive or illegal content</li></ul>
<p>Before continuing, we’d like you to know about some of the other avenues available that may be more appropriate, depending on the situation:</p>
<ul><li>You may not like everything you see on '.get_bloginfo('name').'. For content that you think is inappropriate or may violate our Terms and Conditions, we invite our '.get_bloginfo('name').' community to use our content-flagging feature.</li><li>For all other content removal requests related to copyright infringement, please contact copyright@mypornsite.com or use the Content Removal Request option on the following <a href="http://www.mypornsite.com/contact/">FORM</a>.</li><li>Your opinion is valuable! We listen and consider feedback from all users. To provide feedback, please reach out to our dedicated support team.</li></ul>';
	$content_removal = [];
	$content_removal['ID'] = get_page_by_path('content-removal')->ID;
	$content_removal['post_content'] = $content_removal_content;
	wp_update_post(wp_slash($content_removal));

	$parental_control_content = '<p>The '.get_bloginfo('name').' platform is intended to be a secure and sex-positive space for adult viewing and adult content <strong>only. </strong>We take our commitment to the safety of our users and the integrity of our platform seriously.</p>
<p>As clearly outlined in our Terms and Conditions, access to our platform is strictly limited to those who affirm that :</p>
<ul><li>They are at least eighteen (18) years of age (or older in any other location in which 18 is not the minimum age of majority) from which our platform is accessed.</li><li>Are fully able and competent to enter into the terms, conditions, obligations, affirmations, representations, and warranties outlined in our Terms and Conditions and abide by and comply with said Terms and Conditions.</li><li>The jurisdiction from which they access our platform does not prohibit the receiving or viewing of sexually explicit content.</li></ul>
<p>To help enforce our terms and assist in restricting access to minors, we have ensured that '.get_bloginfo('name').' is, and remains, fully <a href="https://www.rtalabel.org/">RTA</a> (Restricted to Adults) compliant and allows every page to be blocked by simple parental control tools.</p>
<p>We urge parents to monitor their children’s online activity and implement parental controls as appropriate to keep their children safe in the digital age. We firmly believe that parents are best placed to police their children’s activity using the plethora of tools already available in modern operating systems and devices.</p>
<p>We have set out below some simple guidelines and advice on limiting the potential for your child to access inappropriate content.</p>
<p>Take these measures to prevent your kids from stumbling upon adult sites.</p>
<h2><strong>Making the Internet Child-Friendly</strong></h2>
<p>There are many tools available for parents to make the internet safer for their children. ISPs, device manufacturers, and operating system developers have ensured an easy route to setting up parental controls. They all use simple step-by-step instructions, which you only need to follow once, giving you control over your children’s browsing habits beyond simple supervision.</p>
<p>'.get_bloginfo('name').'’s Restricted to Adults (RTA) tags to ensure that all such controls can automatically block our site when enabled by parents.</p>
<h2><strong>Parental Control Settings – Desktop Services</strong></h2>
<p>All modern operating systems have built-in parental controls, and they are simple to activate, requiring only a few minutes to set up. Microsoft Windows 10 allows parents to easily set up accounts for their children, restrict which apps and programs they can open, and block inappropriate websites at the touch of a button.</p>
<p>Visit the <a href="https://family.microsoft.com/">Microsoft Family Safety</a> site for more information.</p>
<p>Apple devices such as Macs, iPads, and iPhones have similar parental controls, which can be enabled by following the instructions on Apple’s dedicated <a href="https://www.apple.com/families/">Families site</a>.&nbsp;</p>
<h2><strong>Parental Control Settings – Mobile Devices</strong></h2>
<p>As many children use their personal devices to access the internet, mobile operating systems now include tools to ensure parents can stay firmly in control of their children’s browsing habits.</p>
<p>iOS devices from Apple, such as iPhones and iPads, can block inappropriate content, set screen time limits, and prevent apps from being installed without permission. More information is available on Apple’s dedicated <a href="https://www.apple.com/families/">Families site</a><em>.</em></p>
<p>Android products such as smartphones and tablets contain similar protections, allowing parents to choose what their children can see and do on their personal devices. The <a href="https://safety.google/families/">Google Safety Centre</a> will walk you through the setup process.</p>
<h2><strong>Internet Service Providers</strong></h2>
<p>Most, if not all, Internet Service Providers (ISPs) offer protections to limit the websites available to your home or handheld device. Such services block all traffic to inappropriate websites and can usually be enabled by logging into your ISP account online. Contact your ISP, and they can advise how to enable their content blocks.</p>
<h2><strong>Dedicated Parental Control Software</strong></h2>
<p>In addition to parental controls provided free of charge by operating systems, device manufacturers, and ISPs, there are multiple parental control apps available from third parties. A non-exhaustive list is provided below:</p>
<ul><li><a href="https://www.qustodio.com/">Qustodio</a></li><li><a href="https://www.kaspersky.co.uk/safe-kids">Kaspersky Safe Kids</a></li><li><a href="https://www.netnanny.com/">Net Nanny</a></li><li><a href="https://family.norton.com/">Norton Family</a></li><li><a href="https://www.mobicip.com/">Mobicip</a></li></ul>
<h2><strong>More Information on Digital Parenting and Supervision</strong></h2>
<p>If you want to find out more information on protecting your children online, how to talk to them, and how to set and agree on limits, there are several resources available.</p>
<ul><li><a href="https://www.fosi.org/">FOSI – Family Online Safety Institute</a></li><li><a href="https://www.saferinternet.org.uk/">UK Safer Internet Centre</a></li><li><a href="https://www.internetmatters.org/">Internetmatters.org</a></li></ul>
<h2><strong>Activate Safe Mode in Search Engines</strong></h2>
<p>'.get_bloginfo('name').' will never appear in the search results with these filters:</p>
<ul><li>Google:<a href="https://support.google.com/websearch/answer/510"> Filter explicit results using SafeSearch</a></li><li>Bing:<a href="https://www.bing.com/account"> Account Settings</a></li><li>Yahoo:<a href="https://help.yahoo.com/kb/SLN2247.html"> Select Yahoo SafeSearch settings</a></li></ul>
<p>You can also use<a href="http://www.kiddle.co/"> Kiddle</a>, a safe visual search engine for kids.</p>';
	$parental_control = [];
	$parental_control['ID'] = get_page_by_path('parental-control')->ID;
	$parental_control['post_content'] = $parental_control_content;
	wp_update_post(wp_slash($parental_control));

	$rta_content = '<p>'.get_bloginfo('name').' is rated with RTA label. Parents, you can easily block access to this site.</p><p>Please read this page&nbsp;<a rel="noreferrer noopener" href="http://www.rtalabel.org/index.php?content=parents" target="_blank">http://www.rtalabel.org/index.php?content=parents</a>&nbsp;for more information.</p>';
	$rta = [];
	$rta['ID'] = get_page_by_path('rta')->ID;
	$rta['post_content'] = $rta_content;
	wp_update_post(wp_slash($rta));
}

function arc_check_woocommerce() {
	if(is_plugin_active('woocommerce/woocommerce.php')) {
		$premium_plans = [
            '1 month' => [
                'post_author' => 1,
                'post_content' => '',
                'post_status' => "publish",
                'post_title' => "1 month",
                'post_type' => "product",
            ],
            '3 months' => [
                'post_author' => 1,
                'post_content' => '',
                'post_status' => "publish",
                'post_title' => "3 months",
                'post_type' => "product",
            ],
            '6 months' => [
                'post_author' => 1,
                'post_content' => '',
                'post_status' => "publish",
                'post_title' => "6 months",
                'post_type' => "product",
            ],
			'12 months' => [
				'post_author' => 1,
				'post_content' => '',
				'post_status' => "publish",
				'post_title' => "12 months",
				'post_type' => "product",
			],
		];
		foreach($premium_plans as $key => $premium_plan) {
			$id = post_exists($key, '', '', 'product');
			if(!$id) {
				$premium_plan_id = wp_insert_post($premium_plan);
				update_post_meta( $premium_plan_id, '_visibility', 'visible' );
				update_post_meta( $premium_plan_id, '_downloadable', 'no');
				update_post_meta( $premium_plan_id, '_virtual', 'no');
				update_post_meta( $premium_plan_id, '_manage_stock', 'no');
				update_post_meta( $premium_plan_id, '_backorders', 'no');
				wp_set_object_terms($premium_plan_id, "simple", 'product_type');
				update_post_meta( $premium_plan_id, '_stock_status', 'instock');
				update_post_meta( $premium_plan_id, '_tax_status', 'taxable');
                update_post_meta( $premium_plan_id, '_regular_price', 1);
                update_post_meta( $premium_plan_id, '_price', 1);
			}
		}

	}
}


// unregister all default WP Widgets
function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
}

function set_default_theme_widgets ($old_theme, $WP_theme = null) {
	if(get_option('widgets_has_been_installed') === false) {
		update_option( 'sidebars_widgets', array() );
		$home_1 = array(
			'title'             => __('Videos being watched', 'arc'),
			'video_type'        => 'most-viewed',
			'video_number'      => '8',
			'video_category'    => '0'
		);
		$home_2 = array(
			'title'             => '',
			'image'             => get_option('homepage_widget_boxed')
		);
		$home_3 = array(
			'title'             => '',
			'image'             => get_option('homepage_widget_full')
		);
		$home_4 = array(
			'title'             => __('Longest videos', 'arc'),
			'video_type'        => 'longest',
			'video_number'      => '8',
			'video_category'    => '0'
		);

		/** Sidebar **/
		$sidebar_2 = array(
			'title'             => __('Latest videos', 'arc'),
			'video_type'       => 'latest',
			'video_number'     => '8',
			'video_category'   => '0'
		);
		$sidebar_4 = array(
			'title'             => __('Featured videos', 'arc'),
			'video_type'       => 'featured', //featured
			'video_number'     => '8',
			'video_category'   => '0'
		);
		/** Footer **/
		$footer_1 = array(
			'title'             => '',
			'image'              => get_option('footer_widget_one')
		);
		$footer_2 = array(
			'title'             => '',
			'image'              => get_option('footer_widget_one')
		);
		$footer_3 = array(
			'title'             => '',
			'image'              => get_option('footer_widget_one')
		);
		$footer_4 = array(
			'title'             => '',
			'image'              => get_option('footer_widget_one')
		);
		arc_add_widget_theme_activation( 'homepage-top', 'widget_videos_block', 1, $home_1 );
		arc_add_widget_theme_activation( 'homepage-ads-boxed', 'media_image', 2, $home_2 );
		arc_add_widget_theme_activation( 'homepage-ads-full', 'media_image', 3, $home_3 );
		arc_add_widget_theme_activation( 'homepage-bottom', 'widget_videos_block', 4, $home_4 );

		arc_add_widget_theme_activation( 'sidebar', 'widget_videos_block', 5, $sidebar_2 );
		arc_add_widget_theme_activation( 'sidebar', 'widget_videos_block', 7, $sidebar_4 );

		arc_add_widget_theme_activation( 'footer', 'media_image', 8, $footer_1 );
		arc_add_widget_theme_activation( 'footer', 'media_image', 9, $footer_2 );
		arc_add_widget_theme_activation( 'footer', 'media_image', 10, $footer_3 );
		arc_add_widget_theme_activation( 'footer', 'media_image', 11, $footer_4 );
		add_option('widgets_has_been_installed', 'yes');
	}
	//wp_die(); // this is required to return a proper result
}

function arc_add_widget_theme_activation( $sidebar_id, $widget_type = 'videos_block', $widget_id, $args = array() ){
	global $sidebars_widgets;
	$ops[$widget_id] = '';
	//$sidebars_widgets = '';
	$sidebars_widgets = get_option('sidebars_widgets');
	if(!in_array( $widget_type . "-".$widget_id, (array)$sidebars_widgets[$sidebar_id] ) )
		$sidebars_widgets[$sidebar_id][] = $widget_type . "-" . $widget_id;
	$ops = get_option('widget_' . $widget_type);
	$ops[$widget_id] = $args;
	$ops["_multiwidget"] = 1;
	update_option('widget_' . $widget_type, $ops);
	update_option('sidebars_widgets', $sidebars_widgets);
}
