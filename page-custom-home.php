<?php
/**
 * Template Name: Custom Home page
 *
 * @package WordPress
 * @subpackage Ships
 */
get_header();
echo get_template_part('content', 'menu');

?>


			<section>
				<div class='input-group'>
					<div class='input-group-addon'>
						Name
					</div>
					<input type='text' placeholder="Name" name="name" />
					<button>Go</button>
				</div>

				<div class='input-group'>
					<div class='input-group-addon'>
						Number
					</div>
					<input placeholder="Number" type='text' name="number" />
					<button>Go</button>
				</div>

			</section>

			<section>
				<?php the_post_thumbnail('', ['class' => 'ship_image']) ?>
				<!-- <img src="" alt='ship imag' class='ship_image'/> -->
			</section>

		</main>
	<?php get_footer(); ?>