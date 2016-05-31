jQuery( document ).ready(function() {

  // var text = jQuery(".search__form--showingResults").attr("data-results");
  //       var query = new RegExp("(\\B" + text + "\\B)", "gim");
  //       var e = document.getElementById("bg").innerHTML;
  //       var enew = e.replace(/(<span>|<\/span>)/igm, "");
  //       document.getElementById("bg").innerHTML = enew;
  //       var newe = enew.replace(query, "<span class='highlight'>$1</span>");
  //       document.getElementById("bg").innerHTML = newe;


  //Burger menu
  jQuery('.burger__button').click(function(){
    jQuery(this).toggleClass('open');
    jQuery('#menu-burger').toggleClass('open');
  });
  jQuery('#menu-burger>li').click(function(){
    jQuery(this).toggleClass('open');
  });
  jQuery('#menu-burger>li>a').click(function(e){
    e.preventDefault();
    console.log('hey');
  });

// Remove the free version sentence of the slider plugin
jQuery(".amazingcarousel-image > div").remove(); //css("display", "none");

  var newsletterBoutons = jQuery(".newsletter__button");
  newsletterBoutons.on("click", function(){
    var newsletter       = jQuery(this).parent().parent();
    var newsletterButton = jQuery(this);
    newsletter[0].classList.remove("newsletter--homme", "newsletter--femme");
    newsletter[0].classList.add("newsletter--" + this.name);
    newsletterBoutons.removeClass("newsletter__button--actif");
    newsletterButton[0].classList.add("newsletter__button--actif");
  });

  // Change the height of the twtiteer viewport on sidebar
  // jQuery('.timeline-Viewport').css("height", "260px");
  // change the width of the youtube player
  // var videoIframe = jQuery(".home__video p iframe")
  // videoIframe.width("100%");
  // videoIframe.height("350px");
  //
  //
  //   var videoID          = jQuery(".home__video--liens");
  //
  //   videoID.on("click", function(){
  //     var idVideo = jQuery(this).attr("data-videoid");
  //     // reset the other to make them go on non visible layer
  //     jQuery(".home__videoIdPlayer").css("z-index", "1");
  //     jQuery(".home__video--liens:after").css("display", "none");
  //     // showing up the right one
  //     jQuery('.videoID-'+idVideo).css("z-index", "2");
  //     jQuery('.videoIDLi-'+idVideo+':after').css("visibility", "visible");
  //   });
  // Faire disparaitre l'anti-spam (hidden field) de la newsletter
  jQuery("#wp-uspcontent-media-buttons").empty();

  // Formulaire Newsletter H/F
  // var newsletterFemme       = jQuery(".newsletter__femme");
  // var newsletterHomme       = jQuery(".newsletter__homme");
  // var newsletterBoutonHomme = jQuery(".newsletter__button--homme");
  // var newsletterBoutonFemme = jQuery(".newsletter__button--femme");
  //
  // var newsletterFemmeFooter       = jQuery(".home__newsletter .newsletter__femme");
  // var newsletterHommeFooter       = jQuery(".home__newsletter .newsletter__homme");
  // var newsletterBoutonHommeFooter = jQuery(".home__newsletter .newsletter__button--homme");
  // var newsletterBoutonFemmeFooter = jQuery(".home__newsletter .newsletter__button--femme");
  // newsletterFemmeFooter.hide();
  // newsletterBoutonHommeFooter.css("background-color", "#949797");
  //
  //
  // var newsletter = jQuery(".newsletter");
  //
  // function switchNewsletter(el) {
  //   console.log(el);
  // }
  // newsletterBoutonHomme.on("click", function(e){
  //   switchNewsletter(e);
  // });
  //
  // newsletterBoutonFemmeFooter.on("click", function(){
  //   newsletterBoutonHommeFooter.css("background-color", "white");
  //   newsletterBoutonFemmeFooter.css("background-color", "#949797");
  //   newsletterBoutonFemmeFooter.css("color", "white");
  //   newsletterHommeFooter.hide();
  //   newsletterFemmeFooter.fadeIn( "slow", function() {
  //   });
  // });
  var popupContainer        = jQuery("#popup");
  var popupCrossContainer   = jQuery("#popup__cross--container");


  //
  // newsletterFemme.hide();
  // newsletterBoutonHomme.css("background-color", "#3789A5");
  //
  // newsletterBoutonHomme.on("click", function(){
  //   newsletterBoutonFemme.css("background-color", "white");
  //   newsletterBoutonHomme.css("background-color", "#3789A5");
  //   newsletterFemme.hide();
  //   newsletterHomme.fadeIn( "slow", function() {
  //   });
  // });
  //
  // newsletterBoutonFemme.on("click", function(){
  //   newsletterBoutonHomme.css("background-color", "white");
  //   newsletterBoutonFemme.css("background-color", "#3789A5");
  //   newsletterHomme.hide();
  //   newsletterFemme.fadeIn( "slow", function() {
  //   });
  // });

// ESSAIS INFRUCTUEUX

// jQuery( document ).ready(function() {
//   var menuHasCHildren = jQuery("ul.burger > li.menu-item-has-children > a");
//   var menuSubMenu = jQuery("ul.burger > li.menu-item-has-children > .sub-menu");
//   menuHasCHildren.on("click",function(e) {
//   jQuery(this).find(".sub-menu").show();
//     // e.stopPropagation();
//     e.preventDefault();
//   });
// });

    var searchLoop = jQuery(".search");
    var searchFormContainer = jQuery(".search__form--container");
    searchLoop.on("click", function(){
      console.log("oui oui");
      searchFormContainer.toggleClass("translateY0");
    });

  popupCrossContainer.on("click", function(){
    popupContainer.fadeOut( "slow", function() {
    });
  });

  // Navigation toggle mega menu on hover
  var subMenu       = jQuery(".nav .sub-menu .menu-item, .nav__thumbnails")
  var mainMenuItems = jQuery(".nav .nav__linkWithNoDepth")


  jQuery('#menu-nav > li').each(function(){
    if(jQuery(this).find('.nav .sub-menu li ul').length){
      //alert('yeah!');
      jQuery(this).find('.nav .sub-menu').first().addClass('multiple');
    }else{
      //alert(":'(");
    }
  });

  jQuery(document).ready(function(){
    var startupBlockHeight     = jQuery(".home__strate--startup").height() + 6;
    var startupBlockMarginLeft = jQuery(".container").css("margin-left");
    var styles = {
        height: startupBlockHeight,
        width: jQuery(window).width(),
        marginLeft: "-" + startupBlockMarginLeft
      };
    jQuery(".bg__startup").css(styles);
  });
});
