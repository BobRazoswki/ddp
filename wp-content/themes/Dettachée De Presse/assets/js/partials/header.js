jQuery( document ).ready(function() {
  // Faire disparaitre l'anti-spam (hidden field) de la newsletter
  jQuery("#wp-uspcontent-media-buttons").empty();

  // Formulaire Newsletter H/F
  var newsletterFemme       = jQuery("#newsletter__femme");
  var newsletterHomme       = jQuery("#newsletter__homme");
  var newsletterBoutonHomme = jQuery(".newsletter__button--homme");
  var newsletterBoutonFemme = jQuery(".newsletter__button--femme");

  newsletterFemme.hide();
  newsletterBoutonHomme.css("text-decoration", "underline");

  newsletterBoutonHomme.on("click", function(){
    newsletterBoutonFemme.css("text-decoration", "none");
    newsletterBoutonHomme.css("text-decoration", "underline");
    newsletterFemme.hide();
    newsletterHomme.show();
  });
  newsletterBoutonFemme.on("click", function(){
    newsletterBoutonHomme.css("text-decoration", "none");
    newsletterBoutonFemme.css("text-decoration", "underline");
    newsletterHomme.hide();
    newsletterFemme.show();
  });

  // Navigation toggle mega menu on hover
  var subMenu       = jQuery(".sub-menu .menu-item, .nav__thumbnails")
  var mainMenuItems = jQuery(".nav__linkWithNoDepth")
  //subMenu.fadeOut("fast");

  // jQuery(function() {
  //     mainMenuItems.hover(function() {
  //         subMenu.fadeIn();
  //       },
  //       function(){
  //         subMenu.fadeOut();
  //       }
  //    );
  // });

  jQuery('#menu-nav > li').each(function(){
    if(jQuery(this).find('.sub-menu li ul').length){
      //alert('yeah!');
      jQuery(this).find('.sub-menu').first().addClass('multiple');
    }else{
      //alert(":'(");
    }
  });







});
