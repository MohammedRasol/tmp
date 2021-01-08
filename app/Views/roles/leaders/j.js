$(document).ready(function(){
 $(".w").prop("disabled", true);
 $(".edit").click(function(){
 	$(".edit").hide();
 	$(".edit1").hide();
 	$(".bt1").show();
 	$(".bt2").show();
 	$(".d").show();
 	$(".w").prop("disabled", false);
 	$(".w").css('border', '1px solid gray');
 	$(".w").css('background-image',' linear-gradient(150deg,#d2d4d4,#f5f5f5,#ffffff)')
 	$(".bt1").css('display','inline-block');
 	$(".bt2").css('display','inline-block');
 	
 });
 $(".bt2").click(function(){
 	$(".edit1").show();
 	$(".edit").show();
 	$(".bt1").hide();
 	$(".bt2").hide();
 	$(".d").hide();
 	$(".w").prop("disabled", true);
 	$(".w").css('border', '0px');
 	$(".w").css('background-image','none');
 });

});