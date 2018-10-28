<?php
get_header();
echo get_template_part( 'content', 'menu' );
?>

<section>
<?php while(have_posts()): the_post(); ?>

	<div class='single-post'>
		<h3>
			<a href='<?php the_permalink(); ?>'>
				<?php the_title() ?>
			</a>
		</h3>
		<p class="lh"> <?php  the_excerpt() ?> </p>
	</div>

<?php endwhile; ?>
</section>
<?php get_footer(); ?>