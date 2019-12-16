var url='chatAjax.php';
var lastId=0;
var timer= setInterval(getMessages,5000);

$function ()
{
	$("#chatForm form").submit(function()
	{
		clearInterval(timer);
		showLoader("#chatForm");
		var message = $("#chatForm form textarea").val();
		
		$.post(url,{action:"addMessage",message:message},function(data))
		{ 
			if(data.erreur == "ok")
			{ 
				getMessages();
				$("#chatForm form textarea").val("");
			}
			else
			{
				alert(data.erreur);
			}
			timer= setInterval(getMessages,5000);
			hideLoader();
		},"json")
		// empeche le formulaire de se poster
		return false;
	}

});

function getMessages()
{
	$.post(url,{action:"getMessage",lastId:lastId},function(data))
		{
			if(data.erreur == "ok")
			{ 
				$("#chat").append(data.result);
				lastId=data.lastId;
			}
			else
			{
				alert(data.erreur);
			}
			hideLoader();
		},"json");
		return false;
}

function showLoader(div)
{
	$(div).append('<div class="loader"></div>');
	$(".loader").fadeTo(500,0.6); 
}

function hideLoader(div)
{
	$(".loader").fadeOut(500,function(){
		(."loader").remove();
	});
}