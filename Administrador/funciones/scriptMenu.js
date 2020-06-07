$(function() {
    $('#navbarDropdown').on("click", function() {
        $('.menu1').slideToggle(300, "linear");
    });

    $('.menu1').mouseleave(function() {
        $(this).slideToggle(300, "linear");
    });

    $('#navbarDropdown2').on("click", function() {
        $('.menu2').slideToggle(300, "linear");
    });

    $('.menu2').mouseleave(function() {
        $(this).slideToggle(300, "linear");
    });

    $('#navbarDropdown3').on("click", function() {
        $('.menu3').slideToggle(300, "linear");
    });

    $('.menu3').mouseleave(function() {
        $(this).slideToggle(300, "linear");
    });

});