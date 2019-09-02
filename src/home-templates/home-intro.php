    <div class="bonjour">
        <?php
            $loop = new WP_Query( array( 'post_type' => 'bonjour', 'posts_per_page' => 1 ) );
            while ( $loop->have_posts() ) : $loop->the_post();
                $custom_fields = get_post_custom();
                echo '<h1>';
                the_title();
                echo '</h1>';
                echo '<div>';
                the_content();
                echo '<div class="onglets">';
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
                echo '</div></div>';
            endwhile;
        ?>
        <div class="telecharger-livret">
          <a title="Télécharger le livret au format PDF" alt="Lien de téléchargement du livret pédagogique" href="https://s3-eu-west-1.amazonaws.com/entourage-ressources/Livret_Simple_comme_Bonjour.pdf" target="_blank">
            Découvrez le livret !
          </a>
        </div>
    </div>
</div>
<div class="menu">
    <img class="logo" src="<?php asset_url('images/logo.png'); ?>">
    <div class="onglets add-opacity">
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
    <img class="questions" src="<?php asset_url('images/questions.PNG'); ?>">
    <h4 class="vosquestions"><a href="?page=questions">vos questions</a></h4>
    <a id="donate-btn" href="https://www.entourage.social/don?utm_source=Bouton&utm_medium=SCB&utm_campaign=DON" target="_blank">
      <b>€</b>
      <span>Faire un don !</span>
    </a>
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
        <img class="questions" src="<?php asset_url('images/questions.PNG'); ?>">
        <h4 class="vosquestions"><a href="?page=questions">vos questions</a></h4>
    </div><div class="fond_opaque"></div>
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
        $('.fond_opaque').click(function(){
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
    $(window).scroll(function() {
        var height = $(window).scrollTop();
        $('.chapitres .chapitre').each(function(e){
            var index = $(this).index();
            var currentTop = $('.chapitres .chapitre:nth-child(' + (index + 1) + ')').offset().top;
            if ($('.chapitres .chapitre:nth-child(' + (index + 2) + ')').length)
                var nextTop = $('.chapitres .chapitre:nth-child(' + (index + 2) + ')').offset().top;
            else
                var nextTop = 200000;
            if ((height >= currentTop) && (height < nextTop))
            {
                $('.menu .onglets a').addClass('inactive');
                $('.menu .onglets a:nth-child(' + (index + 1) + ')').removeClass('inactive');
            }
        });
    });
</script>
