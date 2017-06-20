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
        <h4 class="vosautresquestions"><a href="?formulaire=questions">vous avez d'autres questions ?</a></h4>
    </div><div class="fond_opaque"></div>
</div>
    <div class="menu active">
        <a href="https://scb-theophane38.c9users.io/"><img class="logo" src="wp-content/themes/SCB/images/logo.png"></a>
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
        
        
        <!-- PAGE FORMULAIRE -->
        
        <?php
        if (isset($_GET[formulaire]))
        {
            ?>
                <h4 class="retour_questions"><a href="?page=questions">Revenir aux questions</a></h4>
            </div>
            <div class="container">
                <p class="infos_formulaire">
                    Vous avez une question qui reste sans réponse ?</br>
                    Nous vous invitons à nous l'envoyer à l'aide du formulaire ci-dessous.</br>
                </p>
            </div>
            <?php
            if(isset($_POST['mailform']))
            {
            	if(!empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['question']))
            	{
            	    if (!empty($_POST['question'])){
            	        $accord = "L'expéditeur ACCEPTE que sa questions soit publiée sur le site !";
            	    } else {
            	        $accord = "L'expéditeur REFUSE que sa questions soit publiée sur le site !";
            	    }
            		$header="MIME-Version: 1.0\r\n";
            		$header.='From:'.$_POST['prenom'].'<simplecommebonjour.org>'."\n";
            		$header.='Content-Type:text/html; charset="uft-8"'."\n";
            		$header.='Content-Transfer-Encoding: 8bit';
                    
            		$message='
            		<html>
            			<body>
            				<div align="center">
            					<br />
                                <u>Prénom de l\'expéditeur :</u>'.$_POST['prenom'].'<br />
            					<u>Mail de l\'expéditeur :</u>'.$_POST['email'].'<br />
            					<u>Question de l\'expéditeur :</u>'.$_POST['question'].'<br />
            					<u>'.$accord.'</u>
            				</div>
            			</body>
            		</html>
            		';
            		@mail("theophane.duval@gmail.com", "CONTACT - simplecommebonjour.com", $message, $header);
            		$msg_correct="Votre message a bien été envoyé !";
            	}
            	if (empty($_POST['prenom'])) {
            		$msg_empty_prenom="Merci d'indiquer votre prénom.";
            	}
            	if (empty($_POST['email'])) {
            	    $msg_empty_email="Merci d'indiquer votre email.";
            	}
            	if (empty($_POST['question'])) {
            		$msg_empty_question="Sans question il sera difficile de vous répondre...";
            	}
            	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            	    
            	} else {
            	    $msg_false_email="Merci d'entrer une adresse mail valide..";
            	}
            }
            ?>
            <div class="formulaire_questions">
                    <form method="post" action="/?formulaire=questions">
                    <?php if(isset($msg_empty_prenom)){ echo'<p class="erreur">'.$msg_empty_prenom.'</p><span class="erreur_input">';} ?>
    				<div class="text"><i class="fa fa-user" aria-hidden="true"></i><span>|</span><input type="text" name="prenom" class="prenom" placeholder="Prénom" value="<?php if(isset($msg_erreur) AND isset($_POST['prenom'])) { echo $_POST['prenom']; } ?>" ></input></div></br>
    				<?php if(isset($msg_empty_prenom)){ echo'</span>';}; ?>
    				
    				<?php if(isset($msg_empty_email)){ echo'<p class="erreur">'.$msg_empty_email.'</p><span class="erreur_input">';}else{if(isset($msg_false_email)){ echo'<p class="erreur">'.$msg_false_email.'</p><span class="erreur_input">';}}; ?>
    				<div class="text"><i class="fa fa-envelope" aria-hidden="true"></i><span>|</span><input type="text" name="email" class="email " placeholder="Mail" value="<?php if(isset($msg_erreur) AND isset($_POST['email'])) { echo $_POST['email']; } ?>" ></div></br>
    				<?php if(isset($msg_empty_email) or isset($msg_false_email)){ echo'</span>';}; ?>
    				
    				<?php if(isset($msg_empty_question)){ echo'<p class="erreur">'.$msg_empty_question.'</p><span class="erreur_input">';} ?>
    				<div class="text"><i class="fa fa-question" aria-hidden="true"></i><span>|</span><input type="text" name="question" class="question" placeholder="Question" value="<?php if(isset($msg_erreur) AND isset($_POST['question'])) { echo $_POST['question']; } ?>" ></div></br>
    				<?php if(isset($msg_empty_question)){ echo'</span>';}; ?>
    				<input id ="check" name="checkbox" type="checkbox"><label for="check">J'accepte que ma question soit publiée sur le site.</label></br>
                    <div class="submit"></div><input type="submit" name="mailform" value="Envoyer &raquo;"></div>
                </form>
            </div>
            <?php
                if(isset($msg_correct))
                {
                    echo '<div class="message_envoye">
                    <i class="fa fa-times" aria-hidden="true"></i>
                <h3>Votre question a bien été envoyée ! </br><span>Merci !</span></h3>
            </div>';
                }
            ?>
            <div class="container">
            <?php
        } else {
            ?>
                <h4 class="vosquestions"><a href="?formulaire=questions">vous avez d'autres</br> questions ?</a></h4>
            </div>
            <div class="container">
                <img class="titre_vos_questions" src="wp-content/themes/SCB/images/titre_questions.png">
                <h3 class="texte_titre_vos_questions">Vos questions</h3>
                <div class="content_questions">
                    <div class="filtres">
                        <div class="rechercher">
                            <form method="post">
                                <input name="recherche" id="recherche" placeholder="Rechercher" type="text"/><input class="bouton_recherche" type="submit" value=""></input>
                            </form>
                        </div>
                        <ul id="menu_categorie">
                            <li>Catégories <i class="fa fa-caret-down" aria-hidden="true"></i>
                                <ul>
                                    <li><a href="?page=questions"><b>Tous les articles</b></a></li>
                                    <?php
                                        $categories = get_terms('categories', array("fields" => "names"));
                                        foreach ($categories as $categorie){
                                            echo '<li><a href="'.get_term_link($categorie, 'categories').'">'.$categorie.'</a></li>';
                                        };
                                    ?>
                                </ul>
                            </li>
                        </ul>
                        </div>


        <!-- PAGE VOS QUESTIONS-->


                    <?php
            $args = array(
                'post_type'=> 'questions'
            );
            
        /* PAGE VOS QUESTIONS : TAGS */
        
            if (isset($_GET[tags])){
                $the_query = new WP_Query(array('post_type'=> 'question','tax_query' => array(
                    array(
            			'taxonomy' => 'tags',
            			'field'    => 'slug',
            			'terms'    => $_GET[tags]
            		),
        	    ),
        	));
        	echo '<h4>&darr; Questions avec le mot-clé "<span>'.$_GET[tags].'</span>"</h4>';
            }
            
        /* PAGE VOS QUESTIONS : TOUTES LES QUESTIONS */
        
            else if ($_GET[page]=='questions'){
                $the_query = new WP_Query(array('post_type'=> 'question'));
                ?>
                
                <div class="search_bar_mobile">
                    <h3>Rechercher</h3>
                    <?php get_search_form(); ?>
                </div>
                <?php /*
                echo '<div class="categories_questions">
                    <h3>Catégories</h3>
                    <ul>';
                            $categories = get_terms('categories', array("fields" => "names"));
                            foreach ($categories as $categorie){
                                echo '<a href="'.get_term_link($categorie, 'categories').'"><li><i class="fa fa-question-circle" aria-hidden="true"></i>'.$categorie.'</li></a>';
                            };
                echo '
                    </ul>
                </div>'; */
                echo '<h4>&darr; Toutes les questions</h4>   ';
            }
            
        /* PAGE VOS QUESTIONS : RECHERCHE */
            
            else if (isset($_GET[s])){
                $the_query = new WP_Query(array('post_type'=> 'question', 's'=>$_GET[s]));
                echo '<h4>&darr; Résultat de la recherche: "<span>'.$_GET[s].'</span>"</h4>';
            }
            
        /* PAGE VOS QUESTIONS : CATEGORIES */
            
            else if (isset($_GET[categories])){
                $the_query = new WP_Query(array('post_type'=> 'question','tax_query' => array(
                    array(
            			'taxonomy' => 'categories',
            			'field'    => 'slug',
            			'terms'    => $_GET[categories]
            		),
        	    )));
        	    echo '<h4>&darr; Questions de la catégorie "<span>'.$_GET[categories].'</span>"</h4>';
            };
            
        /* AFFICHAGES ARTICLES */
        
            if($the_query->have_posts() ){
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $content =  wpautop( $post->post_content );
                    $ids = get_the_ID();
                    ?>
                    <div class="question_reponse">
                        <p class="nom_categorie">Catégorie : <span>
                            <?php $cats = wp_get_post_terms($ids, 'categories', array("fields" => "names"));
                                foreach ($cats as $cat){
                                    echo '<a href="'.get_term_link($cat, 'categories').'">'.$cat.'</a>';
                                } 
                            ?></span>
                        </p>
                        <div class="question">
                            <div class="profil_question">
                                <img class="avatar" src="wp-content/themes/SCB/images/avatar.png">
                            </div>
                            <div class="discussion">
                                <p class="infos">
                                    Josephine - Grenoble
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
                        <p class="mots_cles">Mots-clés :</p>
                        <ul>
                            <?php 
                                $tags = wp_get_post_terms($ids, 'tags', array("fields" => "names"));
                                foreach ($tags as $tag){
                                    echo '<li><a href="'.get_term_link($tag, 'tags').'">'.$tag.'</a></li>';
                                }
                            ?>
                        </ul>
                    </div>
                    <?php
                    }
                    }
                    else {
                        echo 'Aucune question trouvée.';
                    };
                    ?>
                <div class="autres_questions">
                    <i class="fa fa-question-circle" aria-hidden="true"></i><p>Vous ne trouvez pas de réponse à votre question ? <a href="?formulaire=questions">Envoyez la nous !</a></p>
                </div>
            </div>
            
        <!-- FILTRES -->
        
            <div class="navigation_questions">
                <div class="search_bar">
                    <h3>Rechercher</h3>
                    <?php get_search_form(); ?>
                </div>
                <div class="tags">
                    <h3>Mots-clés</h3>
                    <ul>
                        <?php 
                            $tags = get_terms('tags', array("fields" => "names"));
                            foreach ($tags as $tag){
                                echo '<li><a href="'.get_term_link($tag, 'tags').'">'.$tag.'</a></li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="categories">
                    <h3>Catégories</h3>
                    <ul>
                        <li><a href="?page=questions"><b>Tous les articles</b></a></li>
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
        </div>
    </div>
    <?php }; ?>
</div>
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