$(document).ready(function(){
	$(".container").before(
		"<nav class=\"navbar navbar-inverse navbar-fixed-top\"> " +
		"<div class=\"container\"> <div class=\"navbar-header\"> " +
		"<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapsed\" data-target=\"bs-navbar\" aria-expanded=\"false\"> " +
		"<span class=\"sr-only\"></span> <span class=\"icon-bar\"></span> <span class=\"icon-bar\"></span>" +
		"<span class=\"icon-bar\"></span> </button> " +
		"<a href=\"#\" class=\"navbar-brand\">logo</a> </div> " +
		"<div class=\"collapse navbar-collapse\" id=\"bs-navbar\"> " +
		"<ul class=\"nav navbar-nav navbar-right\"> " +
		"<li><a id=\"homepage\" href=\"index.html\">HOME</a></li> " +
		"<li><a id=\"signinpage\"  href=\"signIn.html\">×¢²á</a></li> " +
		"<li><a id=\"signuppage\" href=\"signUp.html\">µÇÂ¼</a></li> " +
		"</ul> <form action=\"#\" role=\"search\" class=\"navbar-form navbar-right\"> " +
		"<div class=\"input-group\"> <input type=\"text\" class=\"form-control\" placeholder=\"Search for...\">" +
		"<span class=\"input-group-btn\"> <button class=\"btn btn-default\" type=\"button\">Go!</button> </span> </div> </form> </div> </div> </nav>");
	})