jQuery( document ).ready(function() {

  // Change the height of the twtiteer viewport on sidebar
  // jQuery('.timeline-Viewport').css("height", "260px");
  // change the width of the youtube player
  var videoIframe = jQuery(".home__video p iframe")
  videoIframe.width("100%");
  videoIframe.height("350px");



    var videoID          = jQuery(".home__video--liens");

    videoID.on("click", function(){
      var idVideo = jQuery(this).attr("data-videoid");
      // reset the other to make them go on non visible layer
      jQuery(".home__videoIdPlayer p").css("z-index", "1");
      jQuery(".home__video--liens:after").css("display", "none");
      // showing up the right one
      jQuery('.videoID-'+idVideo+' p').css("z-index", "2");
      jQuery('.videoIDLi-'+idVideo+':after').css("visibility", "visible");
    });
  // Faire disparaitre l'anti-spam (hidden field) de la newsletter
  jQuery("#wp-uspcontent-media-buttons").empty();

  // Formulaire Newsletter H/F
  var newsletterFemme       = jQuery(".newsletter__femme");
  var newsletterHomme       = jQuery(".newsletter__homme");
  var newsletterBoutonHomme = jQuery(".newsletter__button--homme");
  var newsletterBoutonFemme = jQuery(".newsletter__button--femme");

  var newsletterFemmeFooter       = jQuery(".home__newsletter .newsletter__femme");
  var newsletterHommeFooter       = jQuery(".home__newsletter .newsletter__homme");
  var newsletterBoutonHommeFooter = jQuery(".home__newsletter .newsletter__button--homme");
  var newsletterBoutonFemmeFooter = jQuery(".home__newsletter .newsletter__button--femme");
  newsletterFemmeFooter.hide();
  newsletterBoutonHommeFooter.css("background-color", "#949797");

  newsletterBoutonHommeFooter.on("click", function(){
    newsletterBoutonFemmeFooter.css("background-color", "white");
    newsletterBoutonHommeFooter.css("background-color", "#949797");
    newsletterBoutonHommeFooter.css("color", "white");
    newsletterFemmeFooter.hide();
    newsletterHommeFooter.fadeIn( "slow", function() {
    });
  });

  newsletterBoutonFemmeFooter.on("click", function(){
    newsletterBoutonHommeFooter.css("background-color", "white");
    newsletterBoutonFemmeFooter.css("background-color", "#949797");
    newsletterBoutonFemmeFooter.css("color", "white");
    newsletterHommeFooter.hide();
    newsletterFemmeFooter.fadeIn( "slow", function() {
    });
  });
  var popupContainer        = jQuery("#popup");
  var popupCrossContainer   = jQuery("#popup__cross--container");



  newsletterFemme.hide();
  newsletterBoutonHomme.css("background-color", "#3789A5");

  newsletterBoutonHomme.on("click", function(){
    newsletterBoutonFemme.css("background-color", "white");
    newsletterBoutonHomme.css("background-color", "#3789A5");
    newsletterFemme.hide();
    newsletterHomme.fadeIn( "slow", function() {
    });
  });

  newsletterBoutonFemme.on("click", function(){
    newsletterBoutonHomme.css("background-color", "white");
    newsletterBoutonFemme.css("background-color", "#3789A5");
    newsletterHomme.hide();
    newsletterFemme.fadeIn( "slow", function() {
    });
  });



  popupCrossContainer.on("click", function(){
    popupContainer.fadeOut( "slow", function() {
    });
  });

  // Navigation toggle mega menu on hover
  var subMenu       = jQuery(".sub-menu .menu-item, .nav__thumbnails")
  var mainMenuItems = jQuery(".nav__linkWithNoDepth")


  jQuery('#menu-nav > li').each(function(){
    if(jQuery(this).find('.sub-menu li ul').length){
      //alert('yeah!');
      jQuery(this).find('.sub-menu').first().addClass('multiple');
    }else{
      //alert(":'(");
    }
  });
});
