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
					<input type='text' placeholder="Name" id="shipping_name" name="shipping_name" />
					<button id="shipping_name_button">Go</button>
				</div>

				<div class='input-group'>
					<div class='input-group-addon'>
						Number
					</div>
					<input placeholder="Number" type='text' name="shipping_number" />
					<button id="shipping_number_button">Go</button>
				</div>

			</section>

			<section id="output"></section>

			<section>
				<?php the_post_thumbnail('', ['class' => 'ship_image']) ?>
				<!-- <img src="" alt='ship imag' class='ship_image'/> -->
			</section>
<script>
var shipping = [];


<?php
$args = array(
  'post_type' => 'ship',
  'posts_per_page' => 100
);
$query = new WP_Query($args);
while($query->have_posts()):
$query->the_post();
?>

shipping.push({
	number: `<?php echo get_post_meta($post->ID, 'shipping_number', true) ?>`,
	name: `<?php echo get_post_meta($post->ID, 'shipping_name', true) ?>`,
	ref: `<?php echo get_the_permalink(); ?>`,
	title: `<?php echo get_the_title(); ?>`,
	excerpt: `<?php echo get_the_excerpt(); ?>`,
})

<?php
		endwhile;
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>
;(function () {
	App = {
		shipping,
		init: function() {
			this.domCached();
			this.bindEvents();
			this.boot();
		},
		boot: function () {
			this.outputDiv.style.display = 'none';
		},
		renderSinglePost: function (post) {
			let content = `
			<div class='single-post'>
				<h3>
					<a href='${post.ref}'>${post.title}</a>
				</h3>
				<p>
					<strong>Shippng Name:</strong> ${post.name}
				</p>
				<p>
					<strong>Shipping Number:</strong> ${post.number}
				</p>
				<p class="lh"> ${post.excerpt} </p>
			</div>
			`;
			return content;
		},
		render: function (arr) {
			this.outputDiv.style.display = 'block';
			if (arr.length) {
				let result = ``;
				arr.forEach(singlePost => {
					result += this.renderSinglePost(singlePost)
				})
				this.outputDiv.innerHTML = result;
			}else {
				this.outputDiv.innerHTML = `
					<h1>No result found for your search. Please search with different keyword</h1>
				`
			}
		},
		domCached: function () {
			this.nameField = document.querySelector('[name=shipping_name]')
			this.numberField = document.querySelector('[name=shipping_number]')
			this.nameButton = document.querySelector('#shipping_name_button');
			this.numberButton = document.querySelector('#shipping_number_button');
			this.outputDiv = document.querySelector('#output');
		},
		bindEvents: function () {
			this.nameButton.addEventListener('click', this.nameClick.bind(this))
			this.numberButton.addEventListener('click', this.numberClick.bind(this))
		},
		nameClick: function() {
			let name = this.nameField.value;
			let filterResult = this.shipping.filter(el => el.name.toLowerCase().indexOf(name.toLowerCase()) > -1)
			this.render(filterResult);

		},
		numberClick: function () {
			let number = this.numberField.value;
			let filterResult = this.shipping.filter(el => el.number.toLowerCase().indexOf(number.toLowerCase()) > -1)
			this.render(filterResult);
		}


	}
	App.init();
}() )


</script>

		</main>

	<?php get_footer(); ?>



