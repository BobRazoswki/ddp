jQuery( document ).ready(function() {
  // Faire disparaitre l'anti-spam (hidden field) de la newsletter
  jQuery("#wp-uspcontent-media-buttons").empty();

  // Formulaire Newsletter H/F
  var newsletterFemme       = jQuery(".newsletter__femme");
  var newsletterHomme       = jQuery(".newsletter__homme");
  var newsletterBoutonHomme = jQuery(".newsletter__button--homme");
  var newsletterBoutonFemme = jQuery(".newsletter__button--femme");
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
    console.log("inside");
  });

  if (jQuery('body > article').hasClass("popup")) {
    jQuery('html').click(function() {
      closeNewsletter()
      alert("Jai clique sur le htnl");
    });

    jQuery('.popup').click(function(event){
        event.stopPropagation();
    });
  }

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
