<?php
get_header();
echo get_template_part( 'content', 'menu' );
?>

<section>
<?php
$args = array(
  'post_type' => 'ship',
  'posts_per_page' => 10
);
$query = new WP_Query($args);

 while($query->have_posts()):
 	$query->the_post();

 	 ?>

	<div class='single-post'>
		<h3>
			<a href='<?php the_permalink(); ?>'>
				<?php the_title() ?>
			</a>
		</h3>
		<p>
			<strong>Shippng Name:</strong> 
			<?php echo get_post_meta($post->ID, 'shipping_name', true) ?>
		</p>
		<p>
			<strong>Shipping Number:</strong> 
			<?php echo get_post_meta($post->ID, 'shipping_number', true) ?>
		</p>
		<p class="lh"> <?php  the_excerpt() ?> </p>
	</div>

<?php endwhile; ?>



</section>
<?php get_footer(); ?>