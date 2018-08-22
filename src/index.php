<?php
/**
 * The main template file
 */
?>
<?php
	get_header();


	if ($_GET[page]=='questions' or isset($_GET[tags]) or isset($_GET[s]) or isset($_GET[taxonomy]) or isset($_GET[formulaire]) or isset($_GET[categories])) {
        get_template_part( 'questions', get_post_format() );
    }
	else {
		while ( have_posts() ) : the_post(); 
			$j = $j + 1;
		endwhile;
		if ( $j > 1) {
			get_template_part( 'home-templates/home-header', get_post_format() );
			echo '<div class="container">';
			get_template_part( 'home-templates/home-intro', get_post_format() );
			echo '<div class="chapitres">';
			get_template_part( 'home-templates/home-content', get_post_format() );
			echo '</div>';
		}
		else {
			while ( have_posts() ) : the_post();
				get_template_part( 'video', get_post_format() );
			endwhile;
		};
	};

	echo '</div></div>';

	get_footer();
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-103175609-1', 'auto');
  ga('send', 'pageview');

</script>



