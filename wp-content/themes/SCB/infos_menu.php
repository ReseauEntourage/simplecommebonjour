    <div class="bonjour">
            <?php 
            $loop = new WP_Query( array( 'post_type' => 'bonjour', 'posts_per_page' => 1 ) );
            while ( $loop->have_posts() ) : $loop->the_post();
              echo '<h1>';
              the_title();
              echo '</h1>';
              echo '<p>';
              the_content();
              echo '</p>';
            endwhile;
            ?>
    </div>
</div>
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
    <?php
    echo '<script>';
            $i = 1;
            foreach($categories as $cat) {
                if ($cat->category_parent == 0 and $cat->category_nicename != "non-classe" and $cat->category_nicename == $i){
                    $test =  strtr($cat->cat_name, array(
                        '\*' => '<span>',
                        '*/' => '</span>',
                        '[ ]' => '</br>'
                    ));
                    echo '
                        $(document).ready(function(){
                          var offset_titre_'.$i.' = $("#chapitre-'.$i.'").offset().top;
                          $(window).scroll(function() {
                            var height = $(window).scrollTop();
                            if(height  >= (offset_titre_'.$i.'-120)) {
                                $(".on'.$i.'").addClass("active");
                            } else if (height < offset_titre_'.$i.') {
                              $(".on'.$i.'").removeClass("active");
                            }
                          });
                        });
                        window.onresize = function(){
                          var offset_titre_'.$i.' = $("#chapitre-'.$i.'").offset().top;
                          $(window).scroll(function() {
                            var height = $(window).scrollTop();
                            if(height  >= (offset_titre_'.$i.'-120)) {
                                $(".on'.$i.'").addClass("active");
                            } else if (height < offset_titre_'.$i.') {
                              $(".on'.$i.'").removeClass("active");
                            }
                          });
                        };
                        ';
                        $i = $i + 1;
                }
            }
            echo '</script>';
            ?>
<img class="questions" src="wp-content/themes/SCB/images/questions.PNG">
<h4 class="vosquestions"><a href="?page=questions">vos questions</a></h4>
</div>
<div class="menu_burger">
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
                            echo 
                                '<a class="onglet on'.$i.'" href="'.get_permalink().'">
                                    <p class="number">'.$i.'.</p>
                                    <h2>'.$categories_names.'</h2>
                                </a>'
                            ;
                                $i = $i + 1;
                        }
                    }
                }
                
            ?>
        </div>
        <img class="questions" src="wp-content/themes/SCB/images/questions.PNG">
        <h4 class="vosquestions"><a href="?page=questions">vos questions</a></h4>
    </div>
</div>
<script>
    $( document ).ready(function(){
        responsive();
    });
    window.onresize = function(){
        responsive();
    };
    function responsive(){
        var screen_height = $(window).height();
        var screen_width = $(window).width();
        $('.burger').click(function(){
            $('.menu_ouvert').css({'display':'block'});
        });
        $('.close_menu').click(function(){
            $('.menu_ouvert').css({'display':'none'});
        });
        $('.onglet').click(function(){
            $('.menu_ouvert').css({'display':'none'});
        });
        $('.menu .logo').click(function(){
            $('html, body').animate({
              	  scrollTop:$('body').offset()
            }, 'slow')
        });
        if (screen_width>768){
            $('.onglet').on('click', function() {
                var page = $(this).attr('href');
        		var speed = 750;
        		$('html, body').animate( { scrollTop: $(page).offset().top-130 }, speed );
        		return false;
            });
    		var width_onglets = $('.onglets').width();
    		var width_dispo = $(window).width()-300;
    		if (width_onglets >= width_dispo){
    	    };
	    } else {
	        $('.onglet').on('click', function() {
                var page = $(this).attr('href');
        		var speed = 750;
        		$('html, body').animate( { scrollTop: $(page).offset().top-50 }, speed );
        		return false;
    	    });
	    };
    };
</script>