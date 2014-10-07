/*
 * global.js
 * Used for global javascripts
 * Uses closure style scripting
 */

(function (g) {
	
	
	g.emptyUserName = "Please enter username";
	
	g.emptyPassword = "Please enter password";
	
	g.colorBoxOptions = {width : "900px" , height : "600px" , photo : true , rel : "default" , transition:"none"}
	
	g.init = function(){
		
		if($(window).width() <= 1100){
			
			$('.mobNavImg').on("click"  , function(){

				$('.navigation').slideToggle('fast');	
				
			});
			
		}
		
		
		
	}
	
	
}(window.globalFn = window.globalFn || {}));


/*Login related functions*/

(function (l){
	
	l.init = function(){
		
		if($("#frmLogin").length > 0)
		{
			$("#frmLogin").on("submit" , validateLogin);
		}
	};
	
	var validateLogin = function(){
		
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


/*Achievements related functions*/

(function (a){ 

	
	var linkList = ["curriculam_college" ,  "curriculam_hsc" ,  "curriculam_ssc" , "ecurriculam_college" , "ecurriculam_hsc" , "ecurriculam_ssc" ];
	
	
	a.init = function(){
		
		if($("#my-achievements").length > 0)
		{
		
			$.each(linkList , function(i,item){
				
				$("a." + item).colorbox(  $.extend(globalFn.colorBoxOptions , {rel : item})  );
				
			});
			
			
		}
		
		
	};

}(window.achieveFn = window.achieveFn || {}));

/*End of Achievements*/


var onDocumentReady = function(){
	
	globalFn.init();
	loginFn.init();
	achieveFn.init();
};


$(document).on("ready" , onDocumentReady);