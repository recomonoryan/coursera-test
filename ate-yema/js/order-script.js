$(function(){
	
});

(function (window){
	var dc = {};
	var undeliveredHTML = "../snippets/undelivered-snippet.html";
	var deliveredHTML = "../snippets/delivered-snippet.html";
	var processedHTML = "../snippets/processed-snippet.html";

	var insertHTML = function (selector, html){
		var targetElem = document.querySelector(selector);
		targetElem.innerHTML = html;
	};

	document.addEventListener("DOMContentLoaded", function(event){
		dc.loadUndelivered = function(){
			$ajaxUtils.sendGetRequest(undeliveredHTML, function(response){
				insertHTML(".table-responsive", response);
				$('#order-tracker').DataTable();
			});
		}

		dc.loadDelivered = function(){
			$ajaxUtils.sendGetRequest(deliveredHTML, function(response){
				insertHTML(".table-responsive", response);
				var table = $('#order-tracker').DataTable({
					buttons: [
				        'copy', 'excel', 'pdf'
				    ]
				});

				table.buttons().container()
    			.appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
			});
		}

		dc.loadProcessed = function(){
			$ajaxUtils.sendGetRequest(processedHTML, function(response){
				insertHTML(".table-responsive", response);
				$('#order-tracker').DataTable();
			});
		}

		dc.loadUndelivered();
	});

	window.$dc = dc;
})(window);