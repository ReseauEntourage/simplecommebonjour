<?php
/**
 * The main template file
 */
?>
<?php 
		setcookie("c9.live.user.click-through", "ok", time()+3600, "/", ".c9users.io");
		if ($_GET[version]=='beta'){
			setcookie("beta","yes");
		}
		if ($_GET[page]=='questions' or isset($_GET[tags]) or isset($_GET[s]) or isset($_GET[taxonomy]) or isset($_GET[formulaire]) or isset($_GET[categories])) {
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
<?php 
	if ($_COOKIE["beta"]=="yes" or $_GET[version]=='beta'){
		get_template_part( 'footer_beta', get_post_format() );
	} else {
		get_footer();
	}
	echo $_COOKIE["beta"];
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-101072727-1', 'auto');
  ga('send', 'pageview');

</script>



