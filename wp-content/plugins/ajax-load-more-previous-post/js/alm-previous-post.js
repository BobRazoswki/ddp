/*
 * Ajax Load More - Previous Post
 * https://connekthq.com/plugins/ajax-load-more/add-ons/previous-post/
 *
 * Copyright 2016 Connekt Media - https://connekthq.com
 * Free to use under the GPLv2 license.
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Author: Darren Cooney
 * Twitter: @KaptonKaos
*/
var almPreviousPost = {};
jQuery(document).ready(function ($) {   
   
   if (typeof window.history.pushState == 'function') { // Wrap entire function is a browser support function
         
      almPreviousPost.init = true; 
      almPreviousPost.initPageTitle = document.title; 
      almPreviousPost.titleTemplate = ''; 
      almPreviousPost.pageview = true; 
      almPreviousPost.animating = false;
      almPreviousPost.scroll = true;  
      almPreviousPost.speed = 500;  
      almPreviousPost.offset = 30;   
      almPreviousPost.popstate = false;       
      
      almPreviousPost.active = false;      
      if($('.alm-listing').attr('data-previous-post') === 'true'){
	   	almPreviousPost.active = true;  
	   }          
      
      
      // Previous Post Scroll events
      var almPreviousPostTimer,
      	 almPreviousPostFirst = $('.alm-previous-post').eq(0);
      	 
      $(window).bind('scroll touchstart', function(){	   
	      
	      var scrollTop = $(this).scrollTop();
	      
	      if(almPreviousPost.active && !almPreviousPost.popstate && scrollTop > 1){   
		      
		      almPreviousPostTimer = window.setTimeout(function() {
			      
		         // Get container scroll position
		         var fromTop = scrollTop + almPreviousPost.offset,
		             posts = $('.alm-previous-post'),
		             url = window.location.href;
		             
		         var cur = posts.map(function(){
		            if ($(this).offset().top < fromTop)
		               return this;
		         });
		         
		         // Get the data attributes of the current element
		         cur = cur[cur.length-1];
		         var id = $(cur).data('id'),
		             permalink = $(cur).data('url'),
		             title = $(cur).data('title');
		             
		         if(id === undefined){
		            id = almPreviousPostFirst.data('id');
		            permalink = almPreviousPostFirst.data('url');
		            title = almPreviousPostFirst.data('title');
		         }
		         
		         //console.log(url, permalink);
		         if(url !== permalink){
				      almPreviousPost.setURL(id, permalink, title);            
		         }
		         
	         }, 200);
         
         }
                           
      });   
       
       
      
      /*
         $.fn.almSetPreviousPost
         
         Main Previous Post function
         - triggered from core ajax-load-more.js
         
      */    
      
      $.fn.almSetPreviousPost = function(alm, id, permalink, title){
         
         almPreviousPost.titleTemplate = alm.previous_post_title_template; // Title Template
         
         if(almPreviousPost.init){ // Is init
	         
         	almPreviousPost.siteTitle = alm.siteTitle; // Site Title
         	almPreviousPost.siteTagline = alm.siteTagline; // Site Tagline
         	almPreviousPost.pageview = alm.previous_post_pageview; // Send pageviews       
	      	almPreviousPost.scroll = alm.previous_post_scroll; // Scroll	      
	      	almPreviousPost.speed = alm.previous_post_scroll_speed; // Scroll Speed
	      	almPreviousPost.offset = parseInt(alm.previous_post_scroll_top); // Scroll Top
	      	
	      	if(almPreviousPost.scroll === 'true'){
			      almPreviousPost.scroll = true;
		      }else{
			      almPreviousPost.scroll = false;
		      } 
		      
				almPreviousPost.init = false;
				
	      }else{      
                        
            if(almPreviousPost.scroll){ // If scoll, then slide to post
					almPreviousPost.scrollToPost(id);
				}
								
         }          
                  
      }
      
      
      
      /*
         popstate
         Fires when users click back or forward browser buttons
      */
      
      window.addEventListener('popstate', function(event) {    
					
			if( !almPreviousPost.init ){ // Safari fix - only fire if not init
   			
   	      // Wrap function is a data attr check
   			// - if wrapper doesnt have data-previous-post="true" don't fire popstate
   	      if(almPreviousPost.active){   
   		      almPreviousPost.popstate = true; 
   	         var id;
   	         if(event.state){
   	            id = event.state.postID;
   					almPreviousPost.setPageTitle(event.state.title); 
   	         }else{
   	            id = $('.alm-reveal').eq(0).data('id');
   					document.title = almPreviousPost.initPageTitle; 
   	         }     	              
   	         
   	         // Move page to post
            	var top = $('.alm-reveal.alm-previous-post.post-'+id).offset().top - almPreviousPost.offset + 5;
            	$('html, body').animate({ scrollTop: top +'px' }, 1, function(){
   	         	almPreviousPost.popstate = false;
            	});
            	
            }
         }
         
      });
      
      
      
      /*
         almSEO.getPageState()
         Set the browser URL to current permalink then scroll user to post
         
         @return null
      */
      
      almPreviousPost.setURL = function(id, permalink, title){	
	      
			almPreviousPost.setPageTitle(title);	      
	      
         var state = { 
            postID: id,
            permalink: permalink,
            title: title
         };
         history.pushState(state, title, permalink);
         
         if ($.isFunction($.fn.almUrlUpdate)) {
            $.fn.almUrlUpdate(permalink, 'previous-post');				
         } 
         
         // Google Analytics - send pageview
         if(almPreviousPost.pageview === 'true'){ // Send pageviews to Google Analytics
         	var location = window.location.href,
         	    path = '/'+window.location.pathname;
         	
         	// Standard GA Tracking
         	if (typeof ga !== 'undefined' && $.isFunction(ga)) {
				   ga('send', 'pageview', path);
				}
				// Yoast SEO
				if (typeof __gaTracker !== 'undefined' && $.isFunction(__gaTracker)) { // Check that func exists
				   __gaTracker('send', 'pageview', path);
				}
			}
			
      }
      
      
      
      /*
         almPreviousPost.scrollToPost
         Scroll user to current post
      */      
      
      almPreviousPost.scrollToPost = function(id){ 
	      
      	var top = $('.alm-reveal.alm-previous-post.post-'+id).offset().top - almPreviousPost.offset + 5;
      	$('html, body').animate({ scrollTop: top +'px' }, almPreviousPost.speed, "alm_easeInOutQuad", function(){
         	almPreviousPost.animating = false;
      	});  
      	
      }
      
      
      
      /*
         almPreviousPost.setPageTitle
         Set the page title
      */      
      
      almPreviousPost.setPageTitle = function(title){ 
      	
      	if(almPreviousPost.titleTemplate === ''){	      	
	      	document.title = document.title;	      	
	      }else{		  
   	      
		      var str = almPreviousPost.titleTemplate;		      
		      str = str.replace('{site-title}', almPreviousPost.siteTitle); // Replace site title	      
		      str = str.replace('{tagline}', almPreviousPost.siteTagline); // Replace tagline			      
		      str = str.replace('{post-title}', title); // Replace Post Title
		      
		      document.title	= str;	      
		      
	      } 
	      
      }
      
      
      
      /*
         alm_easeInOutQuad()
         Custom easing function
         
         @return easing
      */
      
      $.easing.alm_easeInOutQuad = function (x, t, b, c, d) {
         if ((t /= d / 2) < 1) return c / 2 * t * t + b;
         return -c / 2 * ((--t) * (t - 2) - 1) + b;
      };
   
   }
   
});