$(document).ready(function () {
	
	var y_text_Old = $('#y_text').val();
	
	$('#y_text').on('input', function () {
		var y_text = $('#y_text').val();
		
		if (!checkYChange(y_text))
		{
			$('#y_text').val(y_text_Old);
			return;
		}
		
		y_text_Old = $('#y_text').val();
	});
	
	$('#input_form').on('submit', function (event) {
		
		event.preventDefault();

		if($('input[name=x_input]:checked').val() === undefined)
		{
			alert("Неверно введён X");
			return false;
		}


		if(!checkY($("#y_text").val()))
		{
			alert("Неверно введён Y");
			return false;
		}
		
		if($('input[name=r_input]:checked').val() === undefined)
		{
			alert("Неверно введён R");
			return false;
		}
		

		let x = '';
		
		$('input[name=x_input]:checked').each( function () {
			if(x != '')
				x += '&';
			x += 'x[]=' + Number($(this).val());
		});
		
		let y = Number($('input[name=y_input]').val());
		let r = Number($('input[name=r_input]:checked').val());
		let curTime = new Date().getTimezoneOffset();

		$.ajax({
			url: './php/main.php',
			method: 'GET',
			data: `${x}&y=${y}&r=${r}&curTime=${curTime}`,
			success: function(response){
				$('#result_table_body').prepend(response);

				for(let i=1; i<=9; i++)
					$('#result_table_body tr:nth-child(' + i + ') td').animate({borderWidth: "0px"}, "fast", "linear");


			},
			error : function(request, status, error) {
				var statusCode = request.status;
				alert(statusCode);
			}
		});
		
		
	});
	
});

function checkYChange(y_text)
{		
	return y_text != '-' && (Number(y_text) >= 5 || Number(y_text) <=-5 || isNaN(Number(y_text))) ? false : true;
}

function checkY(y_text)
{
	return y_text==='' || Number(y_text) >= 5 || Number(y_text) <=-5 || isNaN(Number(y_text)) ? false : true;
}

function checkX() {
	
}