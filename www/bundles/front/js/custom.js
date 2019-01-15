$(document).ready(function(){
    
    $("#index-owl-gallery").owlCarousel(
    {
        margin:0,
        loop:false,
        autoplay:true,
        items:1,
        nav: false,
        center:true,
        URLhashListener:false,
        autoplayHoverPause:true,
        startPosition: 0
    });
    
    $("#orderMessageModal").modal();
    
    $("#menu-toggler").click(function(e){
        e.stopPropagation();
        $("#mobileMenu").animate({left : "0"});
    });
    
    $("body").click(function(){$("#mobileMenu").animate({left : "-100%"});});
    var top = $(".portfolioCategories").offset().top + 150;
    $(".portfolioCategories").css("margin-top", -1 * top);
    
});