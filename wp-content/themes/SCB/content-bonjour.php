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