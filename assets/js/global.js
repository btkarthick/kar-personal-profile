/*
 * global.js
 * Used for global javascripts
 * Uses closure style scripting
 */

(function (g) {
	
	
	g.emptyUserName = "Please enter username";
	g.emptyPassword = "Please enter password";
	
	
}(window.globalFn = window.globalFn || {}));


/*Login related functions*/

(function (l){
	
	l.validateLogin = function(){
		
		var username = $("#username").val();
		var pass = $("#pwd").val();
		var error_holder = $("#error");
		if(username === "")
		{
			$(error_holder).empty().text(globalFn.emptyUserName);
			return false;
		}
		
		else if(pass === "")
		{
			$(error_holder).empty().text(globalFn.emptyPassword);
			return false;
		}
		
		return true;
	};
	
	
}(window.loginFn = window.loginFn || {}));

/*End of Login*/

var onDocumentReady = function(){
	
	// Document Ready related functions goes here
};


$(document).on("ready" , onDocumentReady);