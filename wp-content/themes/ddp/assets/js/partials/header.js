jQuery( document ).ready(function() {

  // var text = jQuery(".search__form--showingResults").attr("data-results");
  //       var query = new RegExp(".*(" + text + ").*", "gim");
  //       console.log(query);
  //       var e = document.getElementById("bg").innerHTML;
  //       var enew = e.replace(/(<span>|<\/span>)/igm, "");
  //       // document.getElementById("bg").innerHTML = enew;
  //       var newe = enew.replace(query, "<span class='highlight'>$1</span>");
  //       document.getElementById("bg").innerHTML = newe;

    jQuery("#load-more")[0].innerHTML = "Voir l'article suivant ;) ";
    if (window.location.pathname === "/ddp/soumission-darticle/") {
      jQuery(".usp-add-another > a")[0].innerHTML = "Ajouter une photo";
      jQuery(".usp-input-category > option:first-of-type")[0].innerHTML = "Sélectionner votre catégorie";
    }

  jQuery("#menu-nav > li").mouseenter( function() {
    jQuery(this).children("ul").addClass("animated fadeInDown");
    jQuery(this).children("ul").removeClass("fadeOutUp");
  });
  jQuery("#menu-nav > li").mouseleave( function() {
    jQuery(this).children("ul").addClass("fadeOutUp");
    setTimeout(function(){jQuery(this).children("ul").removeClass("fadeInDown")},600)
  });

  jQuery(".video__lien").on("click", function(){
    jQuery(".video__lien").removeClass("video__lien--actif");
    jQuery(this).addClass("video__lien--actif");
  });

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

  //Change the height of the twtiteer viewport on sidebar
  jQuery('.timeline-Viewport').css("height", "260px");

  //change the width of the youtube player

    var videoID = jQuery(".video__lien");

    videoID.on("click", function(){
      var idVideo = jQuery(this).attr("data-videoid");
      jQuery(".youtube").removeClass("youtube--actif");
      jQuery("." + idVideo).addClass("youtube--actif");
    });
  // Faire disparaitre l'anti-spam (hidden field) de la newsletter
  jQuery("#wp-uspcontent-media-buttons").remove();

  var popupContainer        = jQuery("#popup");
  var popupCrossContainer   = jQuery("#popup__cross--container");


    var searchLoop = jQuery(".search, .burger__searchbutton");
    var searchFormContainer = jQuery(".search__form--container");
    searchLoop.on("click", function(){
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
