<div class="container">
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
                        $cat_id = $cat->category_id;
                            echo '
                            <div class="header_chapitre">
                                <div class="ligne_titre_gauche"><img class="perso_un"';
                                if ($i % 2 == 1){echo 'src="wp-content/themes/SCB/images/perso1.png"';}else if($i % 2 == 0){echo 'src="wp-content/themes/SCB/images/perso3.png"';};
                                echo '/></div>
                                <div class="titre" id="chapitre-'.$i.'">
                                <p class="number">'.$i.'.</p>
                                <h2>'.$test.'</h2>
                                </div>
                                <div class="ligne_titre_droite"><img class="perso_deux"';
                                if ($i % 2 == 1){echo 'src="wp-content/themes/SCB/images/perso2.png"';}else if($i % 2 == 0){echo 'src="wp-content/themes/SCB/images/perso4.png"';};
                                echo '/></div>
                            </div>
                                ';
                            $query = new WP_Query( array( 'type-post' => 'post', 'category_name' => 'video-principale-'.$i ));
                            while ( $query->have_posts() ) {
                                $query->the_post();
                               
    		                    echo '
    		                        <div class="videos">
                                        <div class="video_principale">
                                            <h1>'.get_the_title().'</h1>
                                            <div class="image_principale"><a href="'.get_permalink().'"><img class="play" src="wp-content/themes/SCB/images/play.png">'.get_the_post_thumbnail( $query->ID, array( 800, 600) ).'</a></div>
                                            <div class="texte_video">
                                                <div class="guillemet_g">
                                                    <img width="30px" src="wp-content/themes/SCB/images/guillemet1.png">
                                                </div>
                                                <p>'.get_the_excerpt().'</p>
                                                <div class="guillemet_d">
                                                    <img width="30px" align ="right" valign="top" src="wp-content/themes/SCB/images/guillemet2.png">
                                                </div>
                                                <div class="voir_video">
                                                <a href="'.get_permalink().'"> Voir la vidéo...</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    		                    ';
    		                    
    	                        }
                        $i = $i + 1;
                }
        }
        ?>
</div>
<script>
    var hauteur_video = $(".texte_video").offset().top;
    var width_screen = $(window).width();
    if (width_screen<720){
        var height_screen = $(window).height();
        $('.header').css('height',height_screen)
    }
</script>
