$(function() {
    $(".all").click(function(event) {
        event.preventDefault();
        $(".slip").slideDown();
    });
    $(".up").click(function(event) {
        event.preventDefault();
        $(".slip").slideUp();
    });

    $(".ps").click(function(event) {
        event.preventDefault();
        $("#statement").slideToggle();
    });
    $("#statement a").click(function(event) {
        event.preventDefault();
        $("#statement").slideUp();
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
        $("#proexp").slideToggle();
    });
    $("#proexp a").click(function(event) {
        event.preventDefault();
        $("#proexp").slideUp();
    });
	
	
	$(".te").click(function(event) {
        event.preventDefault();
        $("#techGroups").slideToggle();
    });
    $("#techGroups a").click(function(event) {
        event.preventDefault();
        $("#techGroups").slideUp();
    });
	
    $(".ia").click(function(event) {
        event.preventDefault();
        $("#intact").slideToggle();
    });
    $("#intact a").click(function(event) {
        event.preventDefault();
        $("#intact").slideUp();
    });

    $(".rc").click(function(event) {
        event.preventDefault();
        $("#courses").slideToggle();
    });
    $("#courses a").click(function(event) {
        event.preventDefault();
        $("#courses").slideUp();
    });
});
