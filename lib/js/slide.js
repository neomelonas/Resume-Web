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
	
<<<<<<< HEAD
	
	$(".te").click(function(event) {
        event.preventDefault();
        $("#techGroups").slideToggle();
    });
    $("#techGroups a").click(function(event) {
        event.preventDefault();
        $("#techGroups").slideUp();
    });
	
    $(".ia").click(function(event) {
=======
	$(".ia").click(function(event) {
>>>>>>> cce638a96bbdf0cfe02d97b6685f4200ab6004d6
        event.preventDefault();
        $("#intact").slideToggle();
    });
    $("#intact a").click(function(event) {
        event.preventDefault();
        $("#intact").slideUp();
    });
<<<<<<< HEAD

    $(".rc").click(function(event) {
        event.preventDefault();
        $("#courses").slideToggle();
    });
    $("#courses a").click(function(event) {
        event.preventDefault();
        $("#courses").slideUp();
    });
});
=======
	
	$(".te").click(function(event) {
        event.preventDefault();
        $("#tech").slideToggle();
    });
    $("#tech a").click(function(event) {
        event.preventDefault();
        $("#tech").slideUp();
    });
});
>>>>>>> cce638a96bbdf0cfe02d97b6685f4200ab6004d6
