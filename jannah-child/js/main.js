
jQuery(document).ready(function ($) {

  jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ) {
      this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
    }
  };
  jQuery.event.special.touchmove = {
    setup: function( _, ns, handle ) {
      this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
    }
  };
  jQuery.event.special.wheel = {
    setup: function( _, ns, handle ){
      this.addEventListener("wheel", handle, { passive: true });
    }
  };
  jQuery.event.special.mousewheel = {
    setup: function( _, ns, handle ){
      this.addEventListener("mousewheel", handle, { passive: true });
    }
  };

  $(".card-item").find(".card-item__show").click(function() {
    var t=$(this);
    t.parent(".card-item").find(".card-item__hidden").slideToggle("slow");
    t.toggleClass("open")
  });

  $(".faq-title").on('click', function() {
    $(this).parent().children(".faq-answer").slideToggle(300, function() {
      if($(this).is(":hidden")) {
        $(this).siblings().children().removeClass("open");
      }
      else {
        $(this).siblings().children().addClass("open");
      }
    }); 
    return false;
  });

  $(".card-single").find(".card-single__show").click(function() {
    var t=$(this);
    t.parent(".card-single").find(".card-single__open").toggleClass("open");
    t.toggleClass("open");
  });

  $(document).on("scroll", window, function () {
    if ($(window).scrollTop()>600)
    {
      $(".hide-block").show();
    }
    else
    {
      $(".hide-block").hide();
    }
  });

});






