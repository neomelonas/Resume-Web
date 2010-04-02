/*
 * --------------------------------------------------------------------
 * In-place editing system
 * by Siddharth S, www.ssiddharth.com, hello@ssiddharth.com
 * for Net Tuts, www.net.tutsplus.com
 * Version: 1.0, 20.09.2009 	
 * --------------------------------------------------------------------
 */

$(document).ready(function() 
{
    var oldText, newText;
    $(".editable").hover(
	function()
	{
	    $(this).addClass("editHover");
	},
	function()
	{
	    $(this).removeClass("editHover");
	}
    );

    $(".editable").bind("dblclick", replaceHTML);


    $(".btnSave").live("click",
	function()
	{
	    newText = $(this).siblings("form")
		 .children(".editBox")
		 .val().replace(/"/g, "&quot;");

	    $(this).parent()
	       .html(newText)
	       .removeClass("noPad")
	       .bind("dblclick", replaceHTML);
	}
    );

    $(".btnDiscard").live("click",
	function()
	{
	    $(this).parent()
		.html(oldText)
	       .removeClass("noPad")
	       .bind("dblclick", replaceHTML);
	}
    );

    function replaceHTML()
    {
	oldText = $(this).html()
	    .replace(/"/g, "&quot;");
	$(this).addClass("noPad")
	   .html("")
	   .html("<form><input type=\"text\" class=\"editBox\" value=\"" + oldText + "\" /> </form><a href=\"#\" class=\"btnSave\">Save changes</a> <a href=\"#\" class=\"btnDiscard\">Discard changes</a>")
	   .unbind('dblclick', replaceHTML);

    }
}
); 

