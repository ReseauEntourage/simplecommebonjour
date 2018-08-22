$(document).ready(function(){

  $('.modal .close').add($('.modal .donate')).on('click', function(){
    toggleModal(true);
  });

});

function toggleModal(hide) {
  if (hide) {
    localStorage.setItem('modalShown', 'true');
    $('body').removeClass('show-modal');
    $('.modal').fadeOut();
    return;
  }

  if (!$('body').hasClass('show-modal') && !localStorage.getItem('modalShown')) {
    $('body').addClass('show-modal');
    $('.modal').fadeIn();
  }
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}