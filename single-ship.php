<?php get_header(); ?>
<section>
<?php while(have_posts()): the_post(); ?>

	<h2>Shipping title: <?php the_title(); ?></h2>
	<p>
		<strong>Shippng Name:</strong> 
		<?php echo get_post_meta($post->ID, 'shipping_name', true) ?>
	</p>
	<p>
		<strong>Shipping Number:</strong> 
		<?php echo get_post_meta($post->ID, 'shipping_number', true) ?>
	</p>
	<p class="lh"> <?php echo get_the_content() ?> </p>

<?php endwhile; ?>
</section>
<?php get_footer(); ?>