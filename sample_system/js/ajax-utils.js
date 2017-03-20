(function(window){
	var ajaxUtils = {};

	function getRequestObject(){
		if (window.XMLHttpRequest()){
			return (new XMLHttpRequest());
		}
		else if(window.ActiveXObject){
			return (new ActiveXObject("Microsoft.XMLHTTP"));
		}
		else{
			window.alert("AJAX is not supported");
			return (null);
		}
	}

	ajaxUtils.sendRequest = function(requestURL, responseHandler, isJSON){
		var request = getRequestObject();
		request.onreadystatechange = function (){
			handleResponse(request, responseHandler, isJSON);
		}
		request.open("POST", requestURL, true);
		request.send();
	};

	function handleResponse(request, responseHandler, isJSON){
		if((request.readyState === 4) && (request.status === 200)){
			if(isJSON === undefined){
				isJSON = false;
			}

			if(isJSON){
				responseHandler(JSON.parse(response.responseText))
			}
			else{
				responseHandler(response.responseText);
			}
		}
	}

	window.$ajaxUtils = ajaxUtils;
})(window);