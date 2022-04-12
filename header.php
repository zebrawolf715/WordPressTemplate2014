<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<?php if(is_page( 'jp' ) ): ?>
<html lang="ja">
<? else: ?>
<html <?php language_attributes(); ?>>
<?php endif; ?>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSSフィード" href="<?php bloginfo('rss2_url'); ?>">

	<meta name="Keywords" content="<?php wp_title( ',', true, 'right' ); ?>Front End Developer,Web designer,Illustrator,フロントエンドエンジニア,Webデザイナー,コーダー,イラストレーター" />
	<meta name="Description" content="<?php wp_title( '|', true, 'right' ); bloginfo('description'); ?>" />

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
<?php

//親ページを確認する
function is_parent_slug() {
	global $post;
	if ($post->post_parent) {
		$post_data = get_post($post->post_parent);
		return $post_data->post_name;
	}
}

if(is_page()):

// 現在表示しているページの投稿IDから投稿情報を取得します
$page = get_post( get_the_ID() );
// 投稿のスラッグを取得します
$slug = $page->post_name;

if (is_page('web')||is_parent_slug() == 'web'):
 ?>
    <link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/barutheme/web.css">
<?php else: ?>
    <link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/barutheme/<?php echo $slug; ?>.css">
<?php 
endif;
else: ?>
    <link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/barutheme/art.css">
<?php endif; ?>
    <link href='http://fonts.googleapis.com/css?family=Muli|Merriweather+Sans:700,400' rel='stylesheet' type='text/css'>
	<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />


<?php

//Web&Art 詳細ページ
//art
if( is_single() ){

	$image = imgset();
	$imagesize = $image[1] + 19;
	echo '
	<style>
	<!--
	@media screen and (max-width: '.$imagesize.'px){
		section#art div img {
			width:100%;
			heaght:aute;
		}
	}
	-->
	</style>
	';
}

//nav取得

// 指定したカテゴリーの ID を取得
$category_id1 = get_cat_ID( 'Web' );
$category_id2 = get_cat_ID( 'Art' );

// このカテゴリーの URL を取得
$category_link1 = get_category_link( $category_id1 );
$category_link2 = get_category_link( $category_id2 );

?>
</head>

<body>

<div id="wrap">

	<header id="header">
		<div>
			<h1><a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.gif" alt="<?php wp_title(); ?>" /></a></h1>
    		<nav class="pc_nav">
    			<ul>
        			<li class="nav_index"><a href="<?php echo home_url(); ?>">Home</a></li>
            		<li class="nav_profile"><a href="<?php echo home_url(); ?>/profile/">Profile</a></li>
            		<li class="nav_web"><a href="<?php echo home_url(); ?>/web/">Web</a></li>
            		<li class="nav_art"><a href="<?php echo esc_url( $category_link2 ); ?>">Art</a></li>
            		<li class="nav_contact"><a href="<?php echo home_url(); ?>/contact/">Contact</a></li>
                    <li class="nav_jap"><a href="<?php echo home_url(); ?>/jp/"><img src="<?php bloginfo('template_directory'); ?>/images/japan.gif" alt="Japanese" /></a></li>
        		</ul>
            </nav>
            <nav class="m_nav">
                <p><span>MENU</span></p>
            	<ul>
        			<li><a href="<?php echo home_url(); ?>"><span>Home</span></a></li>
            		<li><a href="<?php echo home_url(); ?>/profile/"><span>Profile</span></a></li>
            		<li><a href="<?php echo home_url(); ?>/web/"><span>Web</span></a></li>
            		<li><a href="<?php echo esc_url( $category_link2 ); ?>"><span>Art</span></a></li>
            		<li><a href="<?php echo home_url(); ?>/contact/"><span>Contact</span></a></li>
                    <li class="last"><a href="<?php echo home_url(); ?>/jp/"><span><img src="<?php bloginfo('template_directory'); ?>/images/japan.gif" alt="Japanese language" /> Japanese language</span></a></li>
        		</ul>
            </nav>
		</div>
	</header>