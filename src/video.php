<script>
    NProgress.start();
    NProgress.done();
</script>
<script>
    var x<?php echo get_the_id() ?> = getCookie("cookievideo<?php echo get_the_id() ?>");
    if (x<?php echo get_the_id() ?> == 'vue'){
        $('.video_playlist<?php echo get_the_id() ?>').addClass("vue");
    };
</script>
<div class="article">
    <div class="menu active ">
        <a href="index.php"><img class="logo" src="<?php asset_url('images/logo.png'); ?>"></a>
        <div class="navigation">
            <div class="onglets">
                <?php
                $category = get_the_category(); //récupération catégorie chapitre du post
                $category_description = substr($category[0]->category_description, 0, 1); //Reupération description catégorie chapitre du post
                ?>
                <script>
                var verif_page = <?php echo $category_description ?>;
                $( document ).ready(function() {
                var hauteur_video = $('.player').position();
                if (getCookie("verif_page") == verif_page){
                    if (hauteur_video.top > getCookie("niveau_scroll")){
                        var niveau_scroll_final = getCookie("niveau_scroll");
                    } else {
                        var niveau_scroll_final = hauteur_video.top - 120;
                    }
                    $(window).scrollTop( niveau_scroll_final );
                } else {
                    document.cookie = "verif_page=<?php echo $category_description ?>";
                }
                });
                $(window).scroll(function(){
                    var niveau_scroll = $(window).scrollTop();
                    document.cookie = "niveau_scroll= " + niveau_scroll + "";
                });
                </script>
<?php
    $i = 1; //counter
    $temps = 365*24*3600; //temps cookies
    $categories = get_categories(array('orderby' => 'slug')); //Récupération name toutes les catégories
    $category_description_texte = substr($category[0]->category_description, 2);
    $category_id =          $category[0]->cat_ID; //Reupération ID catégorie chapitre du post
    $category_name =  strtr($category[0]->cat_name, array('\*' => '<span>','*/' => '</span>','[ ]' => '</br>')); //Récupération name catégorie chapitre  du post
    $title =    get_the_title(); //Récupération titre post
    $content =  wpautop( $post->post_content ); //Récupération content post
    $ids = get_the_ID();
    // CREATION MENU
    foreach($categories as $cat) {
        if ($cat->category_parent == 0 and $cat->category_nicename != "non-classe" and $cat->category_nicename == $i){
            $categories_names = strtr($cat->cat_name, array('\*' => '<span>','*/' => '</span>','[ ]' => '</br>')); //Récupération name chaque categorie
            $categories_IDs = $cat->cat_ID;
            $query = new WP_Query( array( 'type-post' => 'post', 'category_name' => 'video-principale-'.$i ));
            while ( $query->have_posts() ) {
            $query->the_post();
            echo '
                <a class="onglet on'.$i.' ';
                    if ($i == $category_description)
                        echo 'current';
                    elseif ($i > $category_description)
                        echo 'inactive';

                    echo '" href="'.get_permalink().'">
                    <p class="number">'.$i.'.</p>
                    <h2>'.$categories_names.'</h2>
                </a>
            ';
            ;
            $i = $i + 1;
        };
        };
    };
    // FIN CREATION MENU
?>
            </div>
        </div>
        <img class="questions" src="<?php asset_url('images/questions.PNG'); ?>">
        <h4 class="vosquestions"><a href="?page=questions">vos questions</a></h4>
        <a id="donate-btn" href="https://www.entourage.social/don?utm_source=Bouton&utm_medium=SCB&utm_campaign=DON" target="_blank">
      <b>€</b>
      <span>Faire un don !</span>
    </a>
    </div><div class="fond_opaque"></div>
    <div class="menu_burger active">
    <div class="burger">
        <div class="tranche"></div>
        <div class="tranche"></div>
        <div class="tranche"></div>
    </div>
    <h2><a href="index.php">simple <span>comme</span> Bonjour !</a></h2>
</div>
<div class="menu_ouvert">
    <div class="fenetre_menu">
        <h3><i class="fa fa-times close_menu" aria-hidden="true"></i></h3>
        <div class="onglets">
            <a class="onglet" href="index.php">
                <h2>Accueil</h2>
            </a>
            <?php
                $i = 1;
                $categories = get_categories(
                array(
                    'orderby' => 'slug')
                );
                foreach($categories as $cat) {
        if ($cat->category_parent == 0 and $cat->category_nicename != "non-classe" and $cat->category_nicename == $i){
            $categories_names = strtr($cat->cat_name, array('\*' => '<span>','*/' => '</span>','[ ]' => '</br>')); //Récupération name chaque categorie
            $categories_IDs = $cat->cat_ID;
            $query = new WP_Query( array( 'type-post' => 'post', 'category_name' => 'video-principale-'.$i ));
            while ( $query->have_posts() ) {
                $query->the_post();
                echo '
                    <a class="onglet on'.$i.'';
                    if ($i <= $category_description){
                        echo ' active"';
                        }
                    else {
                        echo '"';
                    };

                        echo ' href="'.get_permalink().'">
                        <p class="number">'.$i.'.</p>
                        <h2>'.$categories_names.'</h2>
                    </a>
                ';
                ;
                $i = $i + 1;
            };
        };
    };

            ?>
        </div>
        <img class="questions" src="<?php asset_url('images/questions.PNG'); ?>">
        <h4 class="vosquestions"><a href="?page=questions">vos questions</a></h4>
        </div><div class="fond_opaque"></div>
    </div>
</div>
    <div class="felicitations">
        <div class="fenetre">
            <div class="fermer"><i class="fa fa-times" aria-hidden="true"></i></div>
            <h3>FELICITATIONS !</h3>
            <p>Vous avez visionné toutes les vidéos ! Vous êtes maintenant prêt(e) à <span>passer à l'action</span> !</p>
            <img src="<?php asset_url('images/perso_felicitations.png'); ?>">
            <div class="ok">J'ai compris !</div>
            <script>
                $('.felicitations .fermer').click(function(){
                    $('.felicitations').css('display','none')
                });
                $('.felicitations .ok').click(function(){
                    $('.felicitations').css('display','none')
                });
            </script>
        </div>
    </div>
    <div class="container content_article_title">
        <div class="content_article">
<?php
    echo '
        <div class="ligne_titre_gauche"><img class="perso_un"';
        if ($category_description % 2 == 1){echo 'src="'.raw_asset_url('images/perso1.png').'"';}else if($category_description % 2 == 0){echo 'src="'.raw_asset_url('images/perso3.png').'"';};
        echo '/></div>
        <div class="titre" id="chapitre-'.$category_description.'">
        <p class="number">'.$category_description.'.</p>
        <h2>'.$category_name.'</h2>
        </div>
        <div class="ligne_titre_droite"><img class="perso_deux"';
        if ($category_description % 2 == 1){echo 'src="'.raw_asset_url('images/perso2.png').'"';}else if($category_description % 2 == 0){echo 'src="'.raw_asset_url('images/perso4.png').'"';};
        echo '/></div>
        </div>
        </div>
        <div class="description_chapitre">
            <div class="container">
                <p class="descr_chapitre">
                '.$category_description_texte.'
                </p>
            </div>
        </div>
        <div class="container">
        <div class="content_article">
    '
;?>
                <div class="video_principale">
                    <div class="player">
                        <!-- <iframe width="800" height="466.66" src="<?php $key_1_value = get_post_meta( $ids, 'Lien', false );
                        foreach($key_1_value as $lien){
                            echo $lien;
                        };
                    ?>?autoplay=1&color=white&rel=0" frameborder="0" allowfullscreen></iframe> -->
                    <div id="player"></div>
                    <script>
                        var tag = document.createElement('script');
                        tag.src = "https://www.youtube.com/iframe_api";
                        var firstScriptTag = document.getElementsByTagName('script')[0];
                        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                        var player;
                        function onYouTubeIframeAPIReady() {
                            player = new YT.Player('player', {
                                videoId: '<?php
                                    $key_1_value = get_post_meta( $ids, 'Lien', false );
                                    foreach($key_1_value as $lien){
                                        echo $lien;
                                    };
                                ?>',
                                playerVars: { 'autoplay': 1, 'rel': 0 },
                                events: {
                                    'onStateChange': onPlayerStateChange
                                }
                            });
                        }
                        function onPlayerStateChange(event) {
                            var interval = setInterval(function(){
                                var testvideo = player.getVideoLoadedFraction();

                                // if (testvideo > 0.99)
                                //    toggleModal();

                                if (testvideo > 0.95){
                                    progress();
                                    $('.video_playlist<?php echo $ids ?>').addClass("vue");
                                    document.cookie = "cookievideo<?php echo $ids ?>=vue; expires=Thu, 18 Dec 2030 12:00:00 UTC";
                                    var x<?php echo $ids ?> = getCookie("cookievideo<?php echo $ids ?>; expires=Thu, 18 Dec 2030 12:00:00 UTC");
                                }

                            }, 2000);
                        }
                        function stopVideo() {
                            player.stopVideo();
                        }
                    </script>

                        <div class="playlist">
                            <h5>Les autres vidéos du chapitre</h5>
                            <div class="videos_playlist">
                            <?php
                            $query = new WP_Query( array( 'type-post' => 'post', 'category_name' => 'vidéo principale '.$category_description.''));
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                $key_1_value = get_post_meta( get_the_ID(), 'Lien', false );

                                foreach($key_1_value as $lien){
                                    $code_video = $lien;
                                    $lien_image = "'https://i.ytimg.com/vi/".$lien."/hqdefault.jpg'";
                                };

                                if ($title == get_the_title())
                                    continue;

                                echo '
                                    <a href="'.get_permalink().'">
                                        <div class="video_playlist video_playlist'.get_the_ID().'">';
                                ?>
                                <script>
                                    var x<?php echo get_the_id() ?> = getCookie("cookievideo<?php echo get_the_id() ?>");
                                    if (x<?php echo get_the_id() ?> == 'vue'){
                                        $('.video_playlist<?php echo get_the_id() ?>').addClass("vue");
                                    };
                                </script>
                                <?php
                                echo '
                                            <div class="image_video_playlist image_video_playlist'.get_the_ID().'">
                                            <script>
                                                $(".image_video_playlist'.get_the_ID().'").css("background-image","url('.$lien_image.')");
                                            </script>
                                            </div>
                                            <div class="infos_video_playlist">
                                                <h6>'.get_the_title().'</h6>
                                            </div>
                                        </div>
                                    </a>
                                ';
                            }
                            $query = new WP_Query( array( 'type-post' => 'post', 'category_name' => 'vidéo secondaire '.$category_description.''));
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                $key_1_value = get_post_meta( get_the_ID(), 'Lien', false );
                                foreach($key_1_value as $lien){
                                    $code_video = $lien;
                                    $lien_image = "'https://i.ytimg.com/vi/".$lien."/hqdefault.jpg'";
                                };

                                if ($title == get_the_title())
                                    continue;

                                echo '
                                    <a href="'.get_permalink().'">
                                        <div class="video_playlist video_playlist'.get_the_ID().' ';
                                if ($title == get_the_title()){
                                    echo 'active">';
                                } else {
                                    echo '">';
                                }; ?>
                                <script>
                                    var x<?php echo get_the_id() ?> = getCookie("cookievideo<?php echo get_the_id() ?>");
                                    if (x<?php echo get_the_id() ?> == 'vue'){
                                        $('.video_playlist<?php echo get_the_id() ?>').addClass("vue");
                                    };
                                </script>
                                <?php
                                echo '
                                        <div class="image_video_playlist image_video_playlist'.get_the_ID().'">
                                        <script>
                                            $(".image_video_playlist'.get_the_ID().'").css("background-image","url('.$lien_image.')");
                                        </script>
                                        </div>
                                        <div class="infos_video_playlist">
                                            <h6>'.get_the_title().'</h6>
                                        </div>
                                    </div>
                                </a>
                                ';
                            }
                            echo '</div>';

                            $cat_suivant = $category_description+1;
                            $nb_chapitres = $i;
                                if ($cat_suivant !== $nb_chapitres){
                            ?>
                            <a class="chapitre-suivant" href="<?php
                                    $query = new WP_Query( array( 'type-post' => 'post', 'category_name' => 'video-principale-'.$cat_suivant ));
                                    while ( $query->have_posts() ) {
                                    $query->the_post();
                                     echo get_permalink();
                                    }
                                     ?>">
                                <div class="video_playlist suivant">
                                    <h6>Passer au chapitre suivant</h6>
                                    <img src="<?php asset_url('images/fleche_suivant.png'); ?>">
                                </div>
                            </a>
                            <?php }; ?>
                        </div>
                    </div>
                    <div class="video-partage">
                        <h2>Partager cette vidéo sur :</h2>
                        <div class="partages">
                        <?php $key_1_value = get_post_meta( $ids, 'Lien', false );
                        foreach($key_1_value as $lien){
                            $lien_facebook = "https://www.facebook.com/dialog/share?app_id=239428523250939&href=https%3A//www.youtube.com/watch%3Fv%3D".$lien."";
                            $lien_twitter = "https://twitter.com/intent/tweet?url=https%3A//youtu.be/".$lien."";
                            $lien_google = "https://plus.google.com/share?url=https%3A//www.youtube.com/watch%3Fv%3D".$lien."";
                            echo '<img src="'.raw_asset_url('images/partage_facebook.png').'" class="share_icon" onclick="window.open(';
                            echo "'".$lien_facebook."', 'nom_interne_de_la_fenetre', config='height=700, width=700, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no')";
                            echo '"/>';
                            echo '<img src="'.raw_asset_url('images/partage_twitter.png').'" class="share_icon" onclick="window.open(';
                            echo "'".$lien_twitter."', 'nom_interne_de_la_fenetre', config='height=700, width=700, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no')";
                            echo '"></i>';
                        };
                            ?>
                        </div>
                    </div>
                    <div class="texte_video">
                        <?php echo $content ?>
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.9&appId=239428523250939";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <?php echo '<div class="fb-comments" data-href="http://www.simplecommebonjour.org/?p='.$ids.'" data-width="800" data-numposts="5"></div>'; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        <div class="content_article">
            <h4>Les autres vidéos du chapitre</h4>
            <div class="videos_papl">
            <?php
                $query = new WP_Query( array( 'type-post' => 'post', 'category_name' => 'vidéo principale '.$category_description.'' ));
                    while ( $query->have_posts() ) {
                        $query->the_post();
                            $key_1_value = get_post_meta( get_the_ID(), 'Lien', false );
                            foreach($key_1_value as $lien){
                                $code_video = $lien;
                                $lien_image = get_the_post_thumbnail_url( $query->ID, array( 367, 207) );
                            };
                            echo '
                            <div class="video_papl">
                                <div class="papl_g">
                                    <a href="'.get_permalink().'">
                                        <div class="image_papl image_papl'.get_the_ID().'">
                                            <img src="'.$lien_image.'">
                                            <div class="fond_flou">
                                                <img class="play" src="'.asset_url('images/play.png').'">
                                            </div>

                                        </div>
                                    </a>
                                </div>
                                <div class="papl_d">
                                    <a href="'.get_permalink().'">
                                        <h6>'.get_the_title().'</h6>
                                    </a>
                                    <p>'.wp_trim_words( get_the_content(), 20, ' [...]' ).'</p>
                                </div>
                                </a>
                            </div>
                        ';
                    }
                 $query = new WP_Query( array( 'type-post' => 'post', 'category_name' => 'vidéo secondaire '.$category_description.'' ));
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $key_1_value = get_post_meta( get_the_ID(), 'Lien', false );
                        foreach($key_1_value as $lien){
                            $code_video = $lien;
                            $lien_image = get_the_post_thumbnail_url( $query->ID, array( 367, 207) );
                        };
                        echo '
                            <div class="video_papl">
                                <div class="papl_g">
                                    <a href="'.get_permalink().'">
                                        <div class="image_papl image_papl'.get_the_ID().'">
                                            <img src="'.$lien_image.'">
                                            <div class="fond_flou">
                                                <img class="play" src="'.asset_url('images/play.png').'">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="papl_d">
                                    <a href="'.get_permalink().'">
                                        <h6>'.get_the_title().'</h6>
                                    </a>
                                    <p>'.wp_trim_words( get_the_content(), 20, ' [...]' ).'</p>
                                </div>
                                </a>
                            </div>
                        ';
                    }
                ?>
            </div>
                <script>
                    document.cookie = "cookievideo8000=vue; expires=Thu, 18 Dec 2030 12:00:00 UTC";
                    var nb_videos = <?php echo wp_count_posts('post')->publish; ?>;
                    var width_window = $(".container").width();
                    $('.item_pro').css("width",width_window/nb_videos-1.2);
                    progress()
                    function progress(){
                        var resultats = document.cookie.match(/cookievideo/g);
                        var resultats_final = resultats.length - 1;
                        if (resultats !== 0){
                        $(".progression > li:nth-child(-n+" + resultats_final + ")").css({
                           'background-color':'#e44d20',
                           'box-shadow': '-1px 0 7px orange',
                        });

                       };
                       var felicitations = getCookie("felicitations");
                       if (!felicitations){
                           document.cookie = "felicitations=non; expires=Thu, 18 Dec 2030 12:00:00 UTC";
                       }
                       if (resultats_final == nb_videos){
                           if (felicitations == 'non'){
                               $(window).on("scroll",function(){
                                   $(".felicitations").css({'display':'block'});
                                   var height_screen = $(window).height();
                                   var hauteur_feli = $(".felicitations .fenetre").height();
                                   $(".felicitations .fenetre").css({'margin-top':height_screen/2-hauteur_feli/2})
                                   document.cookie = "felicitations=oui; expires=Thu, 18 Dec 2030 12:00:00 UTC";
                                   $(window).off("scroll");
                               });
                           };
                       };
                    }
                </script>
                <script>
                    $( document ).ready(function() {
                        responsive();
                    });
                    window.onresize = function(){
                        responsive();
                    };

                    function responsive(){
                        var width_screen = $(window).width();

                        var width_video = $('#player').width();
                        var height_video = width_video/1.75;

                        var width_img_playlist = $(window).width()/100*29;
                        var height_img_playlist = width_img_playlist/1.75;
                        console.log(width_img_playlist);
                        console.log(height_img_playlist);

                        var width_papl = $(".image_papl").width();
                        var height_papl = width_papl/1.75;

                        $('.burger').click(function(){
                            $('.menu_ouvert').css({'display':'block'});
                        });
                        $('.close_menu').click(function(){
                            $('.menu_ouvert').css({'display':'none'});
                        });
                        $('.onglet').click(function(){
                            $('.menu_ouvert').css({'display':'none'});
                        });
                        $('.fond_opaque').click(function(){
                            $('.menu_ouvert').css({'display':'none'});
                        });
                        $('#player').css('height',height_video);
                        if (width_screen>1200){
                            //$('.player').css('height',height_video);
                            //$('.playlist').css('height',height_video);
                        } else {
                            $('.player').css('height','auto');
                            $('.content_article .playlist .video_playlist .image_video_playlist').css({'height':height_img_playlist});
                        }
                    };
                </script>
            </div>
        </div>
    </div>
</div>
