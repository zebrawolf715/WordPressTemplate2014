<?php get_header(); ?>
	<div id="content">
        <h1 id="ch1" class="a_ch1"><span>Art</span></h1>

<?php 

	//$catに最上位カテゴリの情報を入れる
	$cat = get_category($cat);
	while ( $cat->parent > 0 )
	$cat = get_category( $cat->parent );

	//親カテゴリIDを取得
	$parentID = esc_attr($cat->cat_ID);

	//子カテゴリを取得し、配列に入れる
	$cats = get_terms( 'category', array(
		'hide_empty' => false,
		'child_of' => $parentID
	) );

	foreach($cats as $cat):
	
	$set_term_id = $cat->term_id;

?>

        <section id="<?php echo $cat->slug; ?>">
        	<div>
        		<h2><?php echo $cat->name; ?></h2>             
            	<ul>

<?

	

	//記事の投稿
	/*query_posts($query_string .'&orderby=modified');
	query_posts( 'posts_per_page=-1' );
	if ( is_category( $set_cate_slug ) ) :
	query_posts( array( $set_cate_name => $set_cate_slug, 'posts_per_page' => -1 ) );
	if ( have_posts() ) : while ( have_posts() ) : the_post();*/
	$posts = get_posts('numberposts=0&category='.$set_term_id);
	if($posts): foreach($posts as $post): setup_postdata($post);
	
	
	//画像出力
	$attachment_id = get_field('image_mini');
	$size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
	$image = wp_get_attachment_image_src( $attachment_id, $size );
	$attachment = get_post( get_field('field_name_01') );
	$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
	$image_title = $attachment->post_title;

?>
        			<li>
                    	<a href="<?php the_permalink(); ?>">
                        	<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(); ?>" />
                            <?php the_title('<span>','</span>'); ?>
                        </a>
                    </li>
<?php

	//endwhile; endif; endif;
	endforeach; endif;
	wp_reset_query();
	
?>
	
	</ul>
           		
           	</div>
        </section>
        
<? endforeach; ?>

</div>
<?php get_footer(); ?>