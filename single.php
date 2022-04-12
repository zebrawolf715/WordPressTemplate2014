<?php

function imgset(){

	//画像出力
	$attachment_id = get_field('image');
	$size = "full"; // (thumbnail, medium, large, full or custom size)
	$attachment = get_post( get_field('field_name_01') );
	$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
	$image_title = $attachment->post_title;
	$image = wp_get_attachment_image_src( $attachment_id, $size );

	//画像の横幅取得
	//$imagesize = getimagesize($image[0]);
	
	$image[] = $image_title;

	return $image;

}
get_header();

$image = imgset();

/*
$cat = get_the_category(); $cat = $cat[0];
$cat->cat_name;
*/

$cats = get_the_category();
foreach((array)$cats as $cat){
	if($cat->parent){
		$parent = get_category($cat->parent);
		$parent_set = attribute_escape($parent->cat_name);
	}
}

if( $parent_set == 'Web' ){
	$title_line = 'w_ch1';
	$section_id = 'web';
}elseif( $parent_set == 'Art' ){
	$title_line = 'a_ch1';
	$section_id = 'art';
}

?>
<div id="content">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

        <h1 id="ch1" class="<?php echo $title_line; ?>"><span><?php echo $parent_set; ?></span></h1>

	<section id="<?php echo $section_id; ?>">
		<article>
			<h2><?php echo $image[4]; ?></h2>
			<div><?php echo '<img src="'.$image[0].'" alt="'.$image[4].'" />'; ?></div>			
<?php
global $post;
if ( !empty($post->post_content) ){
	echo '<aside>';
	the_content();
	echo '</aside>';
} ?>
		</article>
	</section>
<?php endwhile; ?>
<?php endif; ?>

</div>
<?php get_footer(); ?>