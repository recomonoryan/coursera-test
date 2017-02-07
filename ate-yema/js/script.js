$(function(){
	$("#customer-form .form-tile:nth-child(4)").hide();
	$("#customer-form .form-tile:nth-child(3)").hide();
	$("#customer-form .form-tile:nth-child(2)").hide();
	$("#register-form").hide();
	$("#customer-form .form-tile:nth-child(1)").fadeIn("slow");

	//next
	$("#customer-form .btn-next").on("click", function(event) {
		var parent_field = $(this).parents(".form-tile");
		var next = true;

		if(next){
			parent_field.fadeOut(400, function() {
				$(this).next().fadeIn();
			});
		}
	});

	//previous
	$("#customer-form .btn-previous").on("click", function(event) {
		$(this).parents(".form-tile").fadeOut(400, function(){
			$(this).prev().fadeIn();
		});
	});

	//add to cart
	$("#customer-form #add-yema").on("click", function(event) {
		if($("#yema").val()){
			alert("HURRAY!");
		}
		else{
			alert("awww!");
		}
	});
});

(function (window){
	var dc = {};
	var orderHTML = "snippets/order-form.html";
	var loginHTML = "snippets/login-snippet.html";

	var insertHTML = function (selector, html){
		var targetElem = document.querySelector(selector);
		targetElem.innerHTML = html;
	};

	document.addEventListener("DOMContentLoaded", function(event){
		$ajaxUtils.sendGetRequest(orderHTML, function(response){
			insertHTML("#main-content", response);
		});

		dc.loadLogin = function(){
			$ajaxUtils.sendGetRequest(loginHTML, function(response){
				insertHTML("#main-content", response);
				$("#register-form").hide();
				//register
				$("a#register-link").on("click", function(event) {
					$("#login-form").fadeOut(400, function(){
						$("#register-form").fadeIn("slow");
					});
					event.preventDefault();
				});

				//login
				$("a#login-link").on("click", function(event) {
					$("#register-form").fadeOut(400, function(){
						$("#login-form").fadeIn("slow");
					});
					event.preventDefault();
				});
			});
		}
	});

	window.$dc = dc;
})(window);