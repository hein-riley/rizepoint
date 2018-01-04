<?php 
/**
 *
 * The main template file
 *
 * @link https://rizepoint.com
 * @package WordPress
 * @subpackage RizePoint
 * @since RizePoint 1.0
 *
 */

get_header(); ?>


<style>
	/* DO NOT PUT THIS IN THE SASS FILE. NEED TO APPLY ONLY TO THE POST TEMPLATES */
	h1,h2,h3,h4,h5,h6{
		color:#28B29A;
	}	
	a.rad.blog-new-nav {
		color: #fff !important;
		background: #28B29A;
		border: none;
		box-shadow: black 0px 1px 5px -1px;
	}
	a.rad.blog-new-nav:hover {
		border: none !important;
	}
</style>

<div class="container-fluid gree-blue" id="blog-header">
	<?php include  __DIR__ . "/includes/page-header.php"; ?>
</div><!-- container-fluid -->

<article class="container-fluid blog-template">
	<div class="container blog-overview-wrapper wrap push">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 blog-post-content">
			<div class="search-content">
				<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
											$currentPage = get_query_var('paged');
											$relatedPosts = new WP_Query(array(
												'category_name'  => 'brand-protection, brand-experience, business intelligence, corporate-social-responsibility, corrective-action-plan, engage, food-safety, foodservice,fsma, hospitality, rize-and-shine, rizepoint',
												'posts_per_page' => 3,
												'paged' => $currentPage,
												'post_status'    => 'publish'
											));
								

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/post/content', 'excerpt' );

						endwhile; // End of the loop.


					else : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>
			
			</div>
		</div><!--blog-post-content -->
		
		<div class="blog-post-sidebar">
			<?php include  __DIR__ . "/includes/blog-sidebar.php"; ?>
		</div><!-- blog-post-sidebar -->
	</div><!-- blog-overview-wrapper -->
</article><!--blog-template-->



<script>
$(document).ready(function(){
	
	// for the blog / post template, hide the gradient header
	$("#blog-header").removeClass("green-blue");
	$('.main-nav a, .search-icon, .upper-nav a, .upper-nav li a').addClass("blog-new-nav");
	$(".logo-img, .regular-logo").attr("src","https://rizepoint.com/wp-content/themes/tribunal/assets/img/logo/logo.png");
	$(".menu-link").addClass("blog-new-nav");
	
	// hide the related posts if the user is viewing press-release article
	var first = $(location).attr('pathname');
	first.indexOf(1);
	first.toLowerCase();
	first = first.split("/")[1];
	
	var press = 'press-releases';
	var blog = 'blog';
	
	if(first == press){
		// hide the related wrapper on press release
		$('.related-wrapper').hide();
		
		// show the social icon bar on press release 
		$('.a2a_kit.a2a_kit_size_32.a2a_floating_style.a2a_vertical_style').show();
		
		// display the ACF fields on press release 
		$('.blog-content-section > p > strong').append('<div class="post-detail"><span class="post-location"><b><?php the_field('location') ?></b></span>  &#45; <span class="post-date"><?php the_field('date') ?></span> &#45;</div> ');
		
		// if there is no content in the ACF, hide the elements
		if( $('.post-detail > .post-location > b').is(':empty') || $('h2.post-sub-header').is(':empty') ){
			$('.post-detail').css('display','none')  
			$('h2.post-sub-header').css('display','none')  
		}else{ 
			console.log('error');
		}
		
		// hide the img in post | since we are calling the thumbnail at top
		$('.blog-content-section > p > strong > img').hide();
			
	
		
	}else if(first == blog){
		
		// display the social icon bar on blog
		$('.a2a_kit.a2a_kit_size_32.a2a_floating_style.a2a_vertical_style').show();
	 }else{
		console.log('Error loading content. Please try again. ');
	}
	
	
});
</script>


<?php get_footer(); ?>