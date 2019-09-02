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
                            echo '<div class="chapitre">
                                <div class="header_chapitre">
                                    <div class="ligne_titre_gauche"><img class="perso_un"';
                                if ($i % 2 == 1){echo 'src="'.asset_url('images/perso1.png').'"';}else if($i % 2 == 0){echo 'src="'.asset_url('images/perso3.png').'"';};
                                echo '/></div>
                                <div class="titre" id="chapitre-'.$i.'">
                                <p class="number">'.$i.'.</p>
                                <h2>'.$test.'</h2>
                                </div>
                                <div class="ligne_titre_droite"><img class="perso_deux"';
                                if ($i % 2 == 1){echo 'src="'.asset_url('images/perso2.png').'"';}else if($i % 2 == 0){echo 'src="'.asset_url('images/perso4.png').'"';};
                                echo '/></div>
                            </div>
                                ';
                            $query = new WP_Query( array( 'type-post' => 'post', 'category_name' => 'video-principale-'.$i ));
                            while ( $query->have_posts() ) {
                                $query->the_post();

    		                    echo '
    		                        <div class="videos">
                                        <div class="texte_video">
                                            '.get_the_excerpt().'
                                        </div>
                                        <div class="video_principale">
                                            <div class="image_principale">
                                                <a href="'.get_permalink().'">
                                                    '.get_the_post_thumbnail( $query->ID, array( 800, 600) ).'
                                                </a>
                                            </div>
                                            <div class="videos_secondaires">
    		                    ';

                              $other_videos = new WP_Query( array( 'type-post' => 'post', 'category_name' => 'vidéo secondaire '.$i, 'posts_per_page' => 4 ));

                              while ( $other_videos->have_posts() ) {
                                $other_videos->the_post();

                                $youtube_id = get_post_meta( get_the_ID(), 'Lien', false )[0];
                                $image_url = "https://i.ytimg.com/vi/".$youtube_id."/mqdefault.jpg";
                                echo '
                                                <div class="video_secondaire">
                                                  <a href="'.get_permalink().'">
                                                    <img src="'.$image_url.'"/>
                                                  </a>
                                                </div>
                                    ';
                              }

                              echo '
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
    $( document ).ready(function(){
        var left_play = ($('.chapitres .videos .video_principale .image_principale .wp-post-image').width())/2-50;
        var top_play = ($('.chapitres .videos .video_principale .image_principale .wp-post-image').width())/1.77/2-50;
        $('.chapitres .videos .video_principale .image_principale .play').css({'left':left_play,'top':top_play});
        if (width_screen<1200){
            var height_screen = $(window).height();
            $('.header').css('height',height_screen)
        }
    });
    window.onresize = function(){
        var left_play = ($('.chapitres .videos .video_principale .image_principale .wp-post-image').width())/2-50;
        var top_play = ($('.chapitres .videos .video_principale .image_principale .wp-post-image').height())/2-50;
        $('.chapitres .videos .video_principale .image_principale .play').css({'left':left_play,'top':top_play});
        if (width_screen<1200){
            var height_screen = $(window).height();
            $('.header').css('height',height_screen)
        }
    };
</script>
