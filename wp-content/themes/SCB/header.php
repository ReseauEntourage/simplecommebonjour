<header class="header">
<video autoplay loop muted id="bgvid">
    <source src="wp-content/themes/SCB/images/Timeline_1.mp4" type="video/mp4">
  </video>
    <div class="accueil">
      <div class="logo">
        <img src="wp-content/themes/SCB/images/logo_header2.png">
        <h1 class="petit_guide">Petit guide pour aller à la rencontre </br>des personnes sans-abri</h1>
        <div class="liens">
          <a class="btn_video" href="#"><span>En vidéo</span></a>
          <a class="btn_livret" href="wp-content/themes/SCB/livret.pdf" target="_blank"><span>En PDF</span></a>
        </div>
    </div>
    <div class="fleche">
      <img src="wp-content/themes/SCB/images/fleche.PNG">
    </div>
    <div class="entourage">
      <div class="container_fleche">
        <img class="fleche_entourage" src="wp-content/themes/SCB/images/fleche_entourage.png">
      </div>
      <div class="container_logo">
        <img class="logo_entourage" src="wp-content/themes/SCB/images/logo_entourage.png">
      </div>
      <div class="container_texte">
        <p>Un site pensé par <a href="http://www.entourage.social/" target="_blank">Entourage</a></p>
      </div>
    </div>

  </div>
  <script>

  $(".btn_video").click(function(){
    $('html, body').animate({
  	  scrollTop:$('.menu').offset().top
      }, 'fast')
  });
  $(document).ready(function(){
    var offset_menu = $('.menu').offset().top;
    $(window).scroll(function() {
      var screen_width = $(window).width();
      var height = $(window).scrollTop();
      if(height  >= offset_menu) {
        if (screen_width > 768){
          $('.menu').addClass('active');
          $('.chapitres').addClass('active');
        };
      } else if (height < offset_menu) {
        $('.menu').removeClass('active');
        $('.chapitres').removeClass('active');
      };
      if (height > 10){
        $('.menu_burger').addClass('active');
      } else {
        $('.menu_burger').removeClass('active');
      };
    });
  });
  window.onresize = function(){
    var offset_menu = $('.menu').offset().top;
    $(window).scroll(function() {
      var height = $(window).scrollTop();
      if(height  >= offset_menu) {
        if (screen_width > 768){
          $('.menu').addClass('active');
          $('.chapitres').addClass('active');
        };
      } else if (height < offset_menu) {
        $('.menu').removeClass('active');
        $('.chapitres').removeClass('active');
      };
      if (height > 10){
        $('.menu_burger').addClass('active');
      } else {
        $('.menu_burger').removeClass('active');
      };
    });
  };
    </script>
</header>
