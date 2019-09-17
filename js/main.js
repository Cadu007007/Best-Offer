$ (function()
{
	$("#register").ajaxForm({
		beforeSend:function()
		{
			$ ("#result").html("<img src='images/loading.gif' width='50px' style='margin: 20px 0px;'  />" );
		},success:function(data)
		{
			$ ("#result").html(data);
		}
	});
});


$ (function()
{
	$("#login").ajaxForm({
		beforeSend:function()
		{
			$ ("#log_result").html("<img src='images/loading.gif' width='50px' style='margin: 20px 0px;'  />" );
		},success:function(data)
		{
			$ ("#log_result").html(data);
		}
	});
});
