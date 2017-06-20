<?php
/**
 * The main template file
 */
?>

		<?php
		if ($_GET[page]=='questions' or isset($_GET[tags]) or isset($_GET[s]) or isset($_GET[taxonomy]) or isset($_GET[formulaire])) {
			get_template_part( 'head', get_post_format() );
            get_template_part( 'archive-questions', get_post_format() );
        }
		else {
			while ( have_posts() ) : the_post(); 
				$j = $j + 1;
			endwhile;
			if ( $j > 1) {
				get_template_part( 'head', get_post_format() );
				get_header();
				echo '<div class="container">';
				get_template_part( 'infos_menu', get_post_format() );
				echo '<div class="chapitres">';
				get_template_part( 'content', get_post_format() );
				echo '</div>';
			} else {
				while ( have_posts() ) : the_post();
					get_template_part( 'head', get_post_format() );
					get_template_part( 'content_article', get_post_format() );
				endwhile;
			};
		};
		?>
	</div>
</div>
<?php get_footer();?>



