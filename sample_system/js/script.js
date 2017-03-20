document.addEventListener("DOMContentLoaded", function(event){
	var login_flag = false;
    var pass_flag = false;
    var userClassErr_flag = true;
    var passClassErr_flag = true;

    var login_url = "login.php";

	function validateForm(event){
		var user = document.forms["login_form"]["username"].value;
		var pass = document.forms["login_form"]["password"].value;
		var classErr_user = document.getElementById("user_login").className;
		var classErr_pass = document.getElementById("user_pass").className;
		var user1 = document.getElementById("user_login");
		user1.pattern = "[0-9]{10,11}";
		if(user === ""){
			document.getElementById("user_err").innerHTML='<span>* This is a required field </span>';
			if(userClassErr_flag){
				classErr_user += " error-input";
				document.getElementById("user_login").className = classErr_user;
				userClassErr_flag = false;
			}
			event.preventDefault();
		}
		else if(user1.validity.patternMismatch){
			document.getElementById("user_err").innerHTML="<span>* Invalid Username Format </span>";
			if(userClassErr_flag){
				classErr_user += " error-input";
				document.getElementById("user_login").className = classErr_user;
				userClassErr_flag = false;
			}
			event.preventDefault();
		}
		else{
			document.getElementById("user_err").innerHTML="";
			login_flag = true;
			if(userClassErr_flag === false){
				classErr_user = classErr_user.replace(new RegExp("error-input", "g"), "");
				document.getElementById("user_login").className = classErr_user;
			}
			event.preventDefault();
		}

		if(pass === ""){
			document.getElementById("pass_err").innerHTML="<span>* This is a required field</span>";
			if(passClassErr_flag){
				classErr_pass += " error-input";
				document.getElementById("user_pass").className = classErr_pass;
				passClassErr_flag = false;
			}
			event.preventDefault();
		}
		else{
			document.getElementById("pass_err").innerHTML="";
			pass_flag = true;
			if(passClassErr_flag === false){
				classErr_pass = classErr_pass.replace(new RegExp("error-input", "g"), "");
				document.getElementById("user_pass").className = classErr_pass;
			}
			event.preventDefault();
		}

		if(login_flag && pass_flag){
			document.getElementById("login_form").action = "login.php";
			document.getElementById("login_form").submit();
		}
	}

    document.getElementById("button_login").addEventListener("click", function (event){
    	event.preventDefault();
    	validateForm(event);
    });
});