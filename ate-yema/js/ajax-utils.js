(function(window){
	var ajaxUtils = {};

	function getRequestObject(){
		if(window.XMLHttpRequest){
			return (new XMLHttpRequest());
		}
		else if(window.ActiveXObject){
			return (new ActiveXObject("Microsoft.XMLHTTP"));
		}
		else{
			global.alert("AJAX is not supported");
			return;
		}
	}
	ajaxUtils.sendGetRequest = function (requestURL, responseHandler){
		var request = getRequestObject();
		request.onreadystatechange = function(){
			handleResponse(request, responseHandler);
		};
		request.open("GET", requestURL, true);
		request.send(null);
	};

	function handleResponse(request, responseHandler){
		if((request.readyState == 4) && (request.status == 200)){
			responseHandler(request.responseText);
		}
	};

	window.$ajaxUtils = ajaxUtils;
})(window);