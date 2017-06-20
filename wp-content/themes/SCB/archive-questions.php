<div class="page_questions">
    <div class="menu_burger active">
    <div class="burger">
        <div class="tranche"></div>
        <div class="tranche"></div>
        <div class="tranche"></div>
    </div>
    <h2>Simple comme bonjour !</h2>
</div>
<div class="menu_ouvert">
    <div class="fenetre_menu">
        <h3><i class="fa fa-times close_menu" aria-hidden="true"></i> MENU</h3>
        <div class="onglets">
            <a class="onglet" href="?formulaire=questions">
                <p class="lien_page_questions">Vous avez d'autres questions ?</p>
            </a>
            <a class="onglet" href="#null" onclick="javascript:history.back();">
                <p class="lien_page_questions"><span>&larr;</span> Revenir à la page précédente</p>
            </a>
        </div>
    </div>
</div>
    <div class="menu active">
        <a href="https://scb-theophane38.c9users.io/"><img class="logo" src="wp-content/themes/SCB/images/logo.png"></a>
        <div clas="onglets">
            <h1>Vos questions</h1>
        </div>
        <img class="questions" src="wp-content/themes/SCB/images/questions.PNG">
        <?php
        if (isset($_GET[formulaire]))
        {
            ?>
                <h4 class="retour_questions"><a href="?page=questions">Revenir aux questions</a></h4>
            </div>
            <div class="container">
                <p class="infos_formulaire">Vous avez une questions à laquelle vous n'avez pas trouvé de réponse sur le site ?</br>
                Nous vous invitons à nous l'envoyer à l'aide du formulaire ci-dessous.</br>
                Si votre question nous semble pertinente, et que vous l'accpeter, nous nous eprmettrons de l'ajouter à la liste des questions.</br>
                Nous vous enverrons dans tous les cas une réponse par mail.</p>
            </div>
            
            <div class="formulaire_questions">
                    <form method="post" action="">
    				<div class="text"><i class="fa fa-user" aria-hidden="true"></i><span>|</span><input type="text" name="prenom" class="prenom" placeholder="Prénom" value="<?php if(isset($msg_erreur) AND isset($_POST['prenom'])) { echo $_POST['prenom']; } ?>" ></input></div></br>
    				<div class="text"><i class="fa fa-envelope" aria-hidden="true"></i><span>|</span><input type="text" name="email" class="email " placeholder="Mail" value="<?php if(isset($msg_erreur) AND isset($_POST['email'])) { echo $_POST['email']; } ?>" ></div></br>
    				<div class="text"><i class="fa fa-question" aria-hidden="true"></i><span>|</span><input type="text" name="message" class="question" placeholder="Question" value="<?php if(isset($msg_erreur) AND isset($_POST['question'])) { echo $_POST['message']; } ?>" ></div></br>
    				<input id ="check" type="checkbox"><label for="check">J'accepte que ma question soit publiée sur le site.</label></br>
                    <div class="submit"></div><input type="submit" name="mailform" value="Envoyer &raquo;"></div>
                </form>
            </div>
            <div class="container">
            <?php
        } else {
            ?>
                <h4 class="vosquestions"><a href="?formulaire=questions">vous avez d'autres</br> questions ?</a></h4>
            </div>
            <div class="container">
            <div class="content_questions">
                <?php
        $args = array(
            'post_type'=> 'questions'
        );
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
        else if (isset($_GET[s])){
            $the_query = new WP_Query(array('post_type'=> 'question', 's'=>$_GET[s]));
            echo '<h4>&darr; Résultat de la recherche: "<span>'.$_GET[s].'</span>"</h4>';
        }
        else if (isset($_GET['term'])){
            $the_query = new WP_Query(array('post_type'=> 'question','tax_query' => array(
                array(
        			'taxonomy' => 'categories',
        			'field'    => 'slug',
        			'terms'    => $_GET[term]
        		),
    	    )));
    	    echo '<h4>&darr; Questions de la catégorie "<span>'.$_GET[term].'</span>"</h4>';
        };
        if($the_query->have_posts() ){
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                 $content =  wpautop( $post->post_content );
                 $ids = get_the_ID();
                echo '
                    <div class="texte_question">
                        <div class="titre_question">
                            <h3>'.get_the_title().'</h3>
                        </div>
                        <div class="infos_auteur">
                            '.get_the_post_thumbnail( $query->ID, array( 800, 600) ).'';
                            $key_1_value = get_post_meta( $ids, 'Auteur', false );
                            foreach($key_1_value as $auteur){
                                echo '<div class="text_infos_auteur"><p><b>'.$auteur.'</b></p>';
                            };
                            $key_2_value = get_post_meta( $ids, 'Statut', false );
                            foreach($key_2_value as $statut){
                                echo '<p>'.$statut.'</p></div>';
                            };
                            echo'
                                </div>
                                <div class="reponse">
                                    <p>'.get_the_content().'</p>
                            ';
                            $tags = wp_get_post_terms($ids, 'tags', array("fields" => "names"));
                            foreach ($tags as $tag){
                                echo '<a href="'.get_term_link($tag, 'tags').'">'.$tag.'</a>';
                            }
                            echo'
                                </div></div>
                            ';
            }
        }
        else {
            echo 'Aucune question trouvée.';
        };
        ?>
        </div>
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
        </div>
    </div>
    <?php }; ?>
</div>
<script>
    $('.burger').click(function(){
                        $('.menu_ouvert').css({'display':'block'});
                        console.log('patate');
                    });
                    $('.close_menu').click(function(){
                        $('.menu_ouvert').css({'display':'none'});
                        console.log('patate');
                    });
                    $('.onglet').click(function(){
                        $('.menu_ouvert').css({'display':'none'});
                        console.log('patate');
                    });
</script>