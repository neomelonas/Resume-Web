$(function() {
    $(".all").click(function(event) {
        event.preventDefault();
        $(".slip").slideDown();
    });
    $(".up").click(function(event) {
        event.preventDefault();
        $(".slip").slideUp();
    });
	
	$(".ed").click(function(event) {
        event.preventDefault();
        $("#education").slideToggle();
    });
    $("#education a").click(function(event) {
        event.preventDefault();
        $("#education").slideUp();
    });
	
	$(".rc").click(function(event) {
        event.preventDefault();
        $("#curriculum").slideToggle();
    });
    $("#curriculum a").click(function(event) {
        event.preventDefault();
        $("#curriculum").slideUp();
    });
	
	$(".pe").click(function(event) {
        event.preventDefault();
        $("#experience").slideToggle();
    });
    $("#experience a").click(function(event) {
        event.preventDefault();
        $("#experience").slideUp();
    });
	
	$(".ia").click(function(event) {
        event.preventDefault();
        $("#intact").slideToggle();
    });
    $("#intact a").click(function(event) {
        event.preventDefault();
        $("#intact").slideUp();
    });
	
	$(".te").click(function(event) {
        event.preventDefault();
        $("#tech").slideToggle();
    });
    $("#tech a").click(function(event) {
        event.preventDefault();
        $("#tech").slideUp();
    });
});