    <div class="menu">
        <img class="logo" src="wp-content/themes/SCB/images/logo.png">
    <div class="onglets">
        <?php
            $i = 1;
            $categories = get_categories( 
            array(
                'orderby' => 'slug')
            );
            foreach($categories as $cat) {
                if ($cat->category_parent == 0 and $cat->category_nicename != "non-classe" and $cat->category_nicename == $i){
                    $test = strtr($cat->cat_name, array(
                        '\*' => '<span>',
                        '*/' => '</span>',
                        '[ ]' => '</br>'
                    ));
                    echo 
                        '<a class="onglet on'.$i.'" href="#chapitre-'.$i.'">
                            <p class="number">'.$i.'.</p>
                            <h2>'.$test.'</h2>
                        </a>'
                    ;
                    $i = $i + 1;
                }
            }
        ?>
    </div>
    <img class="questions" src="wp-content/themes/SCB/images/questions.PNG">
</div>
<script>
    $(".menu .logo").click(function(){
        $('html, body').animate({
          	  scrollTop:$('body').offset()
        }, 'slow')
    });
    $(document).ready(function() {
		$('.onglet').on('click', function() { // Au clic sur un élément
			var page = $(this).attr('href'); // Page cible
			var speed = 750; // Durée de l'animation (en ms)
			$('html, body').animate( { scrollTop: $(page).offset().top-130 }, speed ); // Go
			return false;
		});
    });
</script>