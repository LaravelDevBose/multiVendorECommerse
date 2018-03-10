$(function(){
     $("li.tab").on("click", function (e) {
  


  $(this).addClass("tab-active");
  $(this).siblings().removeClass("tab-active");
  });
  $('li.visible-1').click(function(){
      $('#product1').fadeIn(100);
       $('#product2').fadeOut(100);
        $('#product3').fadeOut(100);
  })
  $('li.visible-2').click(function(){
      $('#product1').fadeOut(100);
       $('#product2').fadeIn(100);
        $('#product3').fadeOut(100);
  })
  $('li.visible-3').click(function(){
      $('#product1').fadeOut(100);
       $('#product2').fadeOut(100);
        $('#product3').fadeIn(100);
  })
   $("ul.feature-listing").hide();

  $(".feature-heading ").click(function() {
    $(this).next().find('ul.feature-listing').slideToggle(300);
    $(this).toggleClass('rotate');
  });
  
  $(".wecom-dropdown").click(function(){
    $(".dropdown-ul").slideToggle(200);
     $(this).toggleClass('rotate');
  })
  $('.t-shirt-dropdown').hover(function(){
    $('.t-shirt-menu').addClass('visible').stop(true,true).slideToggle(300);
    
});
$("#myCarousel").carousel();
    
    // Enable Carousel Indicators
    $(".item1").click(function(){
        $("#myCarousel").carousel(0);
    });
    $(".item2").click(function(){
        $("#myCarousel").carousel(1);
    });
    $(".item3").click(function(){
        $("#myCarousel").carousel(2);
    });
    $(".item4").click(function(){
        $("#myCarousel").carousel(3);
    });

     // Enable Carousel Indicators
    $(".item1").click(function(){
        $("#vedio-wrap-carousel").carousel(0);
    });
    $(".item2").click(function(){
        $("#vedio-wrap-carousel").carousel(1);
    });
    $(".item3").click(function(){
        $("#vedio-wrap-carousel").carousel(2);
    });
    $(".item4").click(function(){
        $("#vedio-wrap-carousel").carousel(3);
    });
     
      $(".left-item1").click(function(){
        $("#slider-right").carousel(0);
    });
    $(".left-item2").click(function(){
        $("#slider-right").carousel(1);
    });
    $(".left-item3").click(function(){
        $("#slider-right").carousel(2);
    });
    $(".left-item4").click(function(){
        $("#slider-right").carousel(3);
    });

     $("li.tab-list").on("click", function (e) {
  $(this).addClass("choose-style-active");
  $(this).siblings().removeClass("choose-style-active");
  });

      $('li.ist-visible-1').click(function(){
      $('#style-align-1').css("display","block");
       $('#style-align-2').css("display","none");
        $('#style-align-3').css("display","none");
  })
  $('li.ist-visible-2').click(function(){
      $('#style-align-1').css("display","none");
       $('#style-align-2').css("display","block");
        $('#style-align-3').css("display","none");
  })
  $('li.ist-visible-3').click(function(){
      $('#style-align-1').css("display","none");
       $('#style-align-2').css("display","none");
        $('#style-align-3').css("display","block");
  })
  $('#vedio-wrap-carousel .carousel-indicators li').on("click", function (e) {
  $(this).addClass("active");
  $(this).siblings().removeClass("active");
  });
});

jQuery(document).ready(function ($) {

    var mySwiper = new Swiper ('.swiper-container', {
        // Optional parameters,
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        paginationClickable: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            type:'image'
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });
    jQuery(document).ready(function() {
        jQuery('.tabs .tab-links a').on('click', function(e)  {
            var currentAttrValue = jQuery(this).attr('href');

            // Show/Hide Tabs
            jQuery('.tabs ' + currentAttrValue).show().siblings().hide();

            // Change/remove current tab to active
            jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

            e.preventDefault();
        });
    });


    jQuery('.tabss .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');

        // Show/Hide Tabs
        jQuery('.tabss ' + currentAttrValue).show().siblings().hide();

        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

        e.preventDefault();
    });


});