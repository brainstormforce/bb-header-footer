<?php

/* Template Name: Template Page Builder */

dhf_get_header(); ?>

<?php if ( is_archive() ): ?>
	<div class="fl-archive container">
		<div class="row">

			<?php FLTheme::sidebar( 'left' ); ?>

			<div class="fl-content <?php FLTheme::content_class(); ?>" itemscope="itemscope"
			     itemtype="http://schema.org/Blog">

				<?php FLTheme::archive_page_header(); ?>

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
					<?php endwhile; ?>

					<?php FLTheme::archive_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'no-results' ); ?>

				<?php endif; ?>

			</div>

			<?php FLTheme::sidebar( 'right' ); ?>

		</div>
	</div>
<?php elseif ( is_single() ): ?>

	<div class="container">
		<div class="row">

			<?php FLTheme::sidebar( 'left' ); ?>

			<div class="fl-content <?php FLTheme::content_class(); ?>">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'single' ); ?>
				<?php endwhile; endif; ?>
			</div>

			<?php FLTheme::sidebar( 'right' ); ?>

		</div>
	</div>

<?php elseif ( is_page() ): ?>
	<div class="fl-content-full container">
		<div class="row">
			<div class="fl-content col-md-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
<?php endif ?>


<?php dhf_get_footer(); ?>