$(document).ready(function(){
	$('.un').change(function(e){
		var x = e.target.value;
 		if(x == 5){
 		//$(".d").css("")
 		$(".d").prop("disabled", true);
 		$('.un').val(5);
 		}
 		else{
 			$(".d").prop("disabled", false);
 			$('.un').val(parseInt(x));
 		}
 	});
$('#lead').change(function () {
    if($(this).prop("checked") == true){
                $(".d").prop("disabled", true);
                $(this).prop("disabled", false);
            }
            else if($(this).prop("checked") == false){
                $(".d").prop("disabled", false);
                $(this).prop("disabled", false);
            }

 });
});