<div class="page_questions">
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
        <img class="questions" src="wp-content/themes/SCB/images/questions.PNG">
        <h4 class="vosquestions"><a href="?formulaire=questions">vos questions</a></h4>
    </div>
    <div class="fond_opaque"></div>
</div>
<div class="menu active">
    <a href="/"><img class="logo" src="wp-content/themes/SCB/images/logo.png"></a>
    <div class="onglets">
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
    <img class="questions" src="wp-content/themes/SCB/images/questions.PNG">
    <h4 class="vosquestions"><a href="?page=questions">vos questions</a></h4>
    <a id="donate-btn" href="https://www.entourage.social/don?utm_source=Bouton&utm_medium=SCB&utm_campaign=DON" target="_blank">
      <b>€</b>
      <span>Faire un don !</span>
    </a>
</div>

<!-- PAGE FORMULAIRE -->

<?php if (isset($_GET[formulaire])): ?>

    <?php
        if(isset($_POST['mailform']))
        {
            if (empty($_POST['prenom']))
            {
                $msg_empty_prenom="Merci d'indiquer votre prénom.";
                $msg_erreur = true;
            }
            if (empty($_POST['email']))
            {
                $msg_empty_email="Merci d'indiquer votre email.";
                $msg_erreur = true;
            }
            else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $msg_false_email="Merci d'entrer une adresse mail valide..";
                $msg_erreur = true;
            }
            if (empty($_POST['question']))
            {
                $msg_empty_question="Sans question il sera difficile de vous répondre...";
                $msg_erreur = true;
            }
            
            if (!isset($msg_erreur))
            {
                if (!empty($_POST['question']))
                {
                    $accord = "L'expéditeur ACCEPTE que sa questions soit publiée sur le site !";
                }
                else
                {
                    $accord = "L'expéditeur REFUSE que sa questions soit publiée sur le site !";
                }
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: '.$_POST['prenom'].' <'.$_POST['email'].'>' . "\r\n";
                $headers .= 'Reply-To: '.$_POST['email']. "\r\n";

                $message='
                <html>
                    <body>
                        Prénom de l\'expéditeur :</u>'.$_POST['prenom'].'<br />
                        Mail de l\'expéditeur :</u>'.$_POST['email'].'<br />
                        Question de l\'expéditeur :</u>'.$_POST['question'].'<br />
                        '.$accord.'
                    </body>
                </html>
                ';
                wp_mail("guillaume@entourage.social", "CONTACT - simplecommebonjour.org", $message, $headers);
                $msg_sent = true;
            }
        }
    ?>

    <?php if (isset($msg_sent)): ?>
        <div class="formulaire_questions">
          <div class="message_envoye">
              <h3>Votre question a bien été envoyée !
              <span>Merci !</span></h3>
          </div>
      </div>
    <?php else: ?>
        <div class="container">
            <p class="infos_formulaire">
                <b>Vous avez une question qui reste sans réponse ?</b></br>
                Nous vous invitons à nous l'envoyer à l'aide du formulaire ci-dessous.
            </p>
        </div>
        <div class="formulaire_questions">
            <form method="post" action="/?formulaire=questions">
                <?php
                    if (isset($msg_empty_prenom))
                        echo '<p class="erreur">'.$msg_empty_prenom.'</p>';
                ?>
				<div class="text">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="prenom" class="prenom" placeholder="Prénom" value="<?php if(isset($msg_erreur) AND isset($_POST['prenom'])) { echo $_POST['prenom']; } ?>" />
                </div>

				<?php
                    if (isset($msg_empty_email))
                        echo '<p class="erreur">'.$msg_empty_email.'</p>';
                    else if (isset($msg_false_email))
                        echo '<p class="erreur">'.$msg_false_email.'</p>';
                ?>
				<div class="text">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="text" name="email" class="email " placeholder="Mail" value="<?php if(isset($msg_erreur) AND isset($_POST['email'])) { echo $_POST['email']; } ?>" />
                </div>

				<?php
                    if (isset($msg_empty_question))
                        echo '<p class="erreur">'.$msg_empty_question.'</p>';
                ?>
				<div class="text">
                    <i class="fa fa-question" aria-hidden="true"></i>
                    <textarea name="question" class="question" placeholder="Question"><?php if(isset($msg_erreur) AND isset($_POST['question'])) { echo $_POST['question']; } ?></textarea>
                </div>
				<div>
                    <input id ="check" name="checkbox" type="checkbox"/>
                    <label for="check">J'accepte que ma question soit publiée sur le site.</label>
                </div>
                <div class="submit"></div>
                <input type="submit" name="mailform" value="Envoyer !"/>
            </form>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="container">
        <div class="content_questions">

            <!-- PAGE VOS QUESTIONS-->

            <?php if ($_GET[page]=='questions'):
                $the_query = new WP_Query(array('post_type'=> 'question'));
            ?>

                <div class="search_bar_mobile">
                    <h3>Rechercher</h3>
                    <?php get_search_form(); ?>
                </div>
                <h4>Toutes les questions</h4>

                <div class="autres_questions">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    Vous ne trouvez pas de réponse à votre question ? <a href="?formulaire=questions">Envoyez-la nous !</a>
                </div>


            <!-- PAGE VOS QUESTIONS : RECHERCHE -->

            <?php elseif (isset($_GET[s])):
                $the_query = new WP_Query(array('post_type'=> 'question', 's'=>$_GET[s]));
                echo '<h4>Résultat de la recherche: "<span>'.$_GET[s].'</span>"</h4>';
            ?>


            <!-- PAGE VOS QUESTIONS : CATEGORIES -->

            <?php elseif (isset($_GET[categories])):
                $the_query = new WP_Query(array('post_type'=> 'question','tax_query' => array(
                    array(
            			'taxonomy' => 'categories',
            			'field'    => 'slug',
            			'terms'    => $_GET[categories]
            		),
        	    )));
        	    echo '<h4>Questions de la catégorie "<span>'.$_GET[categories].'</span>"</h4>';
            ?>
            <?php endif; ?>


            <!-- QUESTIONS -->

            <?php if ($the_query->have_posts()): ?>

                <?php while ( $the_query->have_posts() ):
                    $the_query->the_post();
                    $content =  wpautop( $post->post_content );
                    $ids = get_the_ID();
                ?>

                    <div class="question_reponse">
                        <?php $cats = wp_get_post_terms($ids, 'categories', array("fields" => "names")); ?>
                        <?php if (count($cats) > 0) { ?>
                            <div class="categories">
                                Catégories :
                                <ul class="noms_categories">
                                   <?php

                                    foreach ($cats as $cat){
                                        echo '<li><a href="'.get_term_link($cat, 'categories').'">'.$cat.'</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <div class="question">
                            <div class="profil_question">
                                <img class="avatar" src="wp-content/themes/SCB/images/avatar.png">
                            </div>
                            <div class="discussion">
                                <p class="infos">
                                    <?php $key_3_value = get_post_meta( $ids, 'Questionneur', false );foreach($key_3_value as $questionneur){echo $questionneur;}; ?>
                                </p>
                                <div class="bulle_discussion">
                                    <?php echo get_the_title() ?>
                                 </div>
                            </div>
                            <div class="profil_reponse">

                            </div>
                        </div>
                        <div class="reponse">
                            <div class="profil_question">

                            </div>
                            <div class="discussion">
                                <p class="infos">
                                    <?php $key_1_value = get_post_meta( $ids, 'Auteur', false );foreach($key_1_value as $auteur){echo $auteur;}; ?>
                                    -
                                    <?php $key_2_value = get_post_meta( $ids, 'Statut', false );foreach($key_2_value as $statut){echo $statut;}; ?>
                                </p>
                                <div class="bulle_discussion">
                                    <?php echo get_the_content() ?>
                                </div>
                            </div>
                            <div class="profil_reponse">
                                <?php echo get_the_post_thumbnail( $the_query->ID, array( 40, 40) ) ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                Aucune question trouvée
            <?php endif; ?>

        <div class="autres_questions">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
            Vous ne trouvez pas de réponse à votre question ? <a href="?formulaire=questions">Envoyez-la nous !</a>
        </div>

    </div>

    <!-- FILTRES -->

    <div class="navigation_questions">
        <div class="search_bar">
            <h3>Rechercher</h3>
            <?php get_search_form(); ?>
        </div>
        <div class="categories">
            <h3>Catégories</h3>
            <ul>
                <li><a href="?page=questions"><b>Toutes les questions</b></a></li>
                <?php
                    $categories = get_terms('categories', array("fields" => "names"));
                    foreach ($categories as $categorie){
                        echo '<li><a href="'.get_term_link($categorie, 'categories').'">'.$categorie.'</a></li>';
                    };
                ?>
            </ul>
        </div>
    </div>
    <div class="retour_top">
        <img class="fleche_retour_top" src="wp-content/themes/SCB/images/retour_top.png">
    </div>
<?php endif; ?>
<script>
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
    $(window).scroll(function() {
        var height = $(window).scrollTop();
        var height_screen = $(window).height();
        var offset_footer = $('.bandeau_entourage').offset().top;
        var height_display_arrow = offset_footer - height_screen;
        if (height>300 && height<height_display_arrow){
            $('.retour_top').css('display','block');
        } else {
            $('.retour_top').css('display','none');
        }
    });
    $('.retour_top').click(function(){
        $('html, body').animate({
            scrollTop: $('body').offset().top
        }, 500);
    });
    $('.bouton_recherche').click(function() {
        console.log('ok');
        $.post(
            'wp-content/themes/SCB/post.php', // Un script PHP que l'on va créer juste après
            {
                recherche : $("#recherche").val()  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
            },

            function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard
            document.location.href="/?s=" + data;
            },

            'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
         );

    });
        var height_screen = $(window).height();
        var height_message_envoye = $('.message_envoye').height();
        $('.message_envoye').css({'top':height_screen/2-height_message_envoye/2});
        $('.message_envoye i').click(function() {
            $('.message_envoye').css({
                'display':'none'
            });
        })
        $('.page_questions .content_questions #menu_categorie').click(function (){
            $('.page_questions .content_questions #menu_categorie > li ul').css({'max-height':'13em'});
            $('.page_questions .content_questions #menu_categorie > li li').css({'background-color':'rgba(255,255,255,0.1)'});
            $('.page_questions .content_questions #menu_categorie li').css({'background-color': '#e44d20','color':'white','transition':'0.1s'});
            $('.page_questions .content_questions #menu_categorie li i').css({'-webkit-transform':'rotate(0)','-moz-transform':'rotate(0)','-o-transform':'rotate(0)','tranform':'rotate(0)'});
        });
        var div_cliquable = $('.page_questions .content_questions #menu_categorie');
        $(document.body).click(function(e) {
            if( !$(e.target).is(div_cliquable) && !$.contains(div_cliquable[0],e.target) ) {
                $('.page_questions .content_questions #menu_categorie > li ul').css({'max-height':'0em'});
                $('.page_questions .content_questions #menu_categorie > li li').css({'background-color':'white'});
                $('.page_questions .content_questions #menu_categorie li').css({'background-color': 'white','color':'#e44d20','transition':'0.1s'});
                $('.page_questions .content_questions #menu_categorie li i').css({'-webkit-transform':'rotate(270deg)','-moz-transform':'rotate(270deg)','-o-transform':'rotate(270deg)','tranform':'rotate(270deg)'});
            }
        });
</script>
