$(document).ready(function(){
 /*$(".bt1").hide();
 $(".bt2").hide();
 $(".d").hide();*/
 $(".c").prop("disabled", true);
 $(".edit").click(function(){
 	$(".edit").hide();
 	$(".edit1").hide();
 	$(".bt1").show();
 	$(".bt2").show();
 	$(".d").show();
 	$(".c").prop("disabled", false);
 	/*$(".c").animate({
 		border:'2px solid gray'
 	});*/
 	$(".c").css('border', '1px solid gray');
 	$(".c").css('background-image',' linear-gradient(150deg,#d2d4d4,#f5f5f5,#ffffff)')
 	$(".bt1").css('display','inline-block');
 	$(".bt2").css('display','inline-block');
 	
 });
 $(".bt2").click(function(){
 	$(".edit1").show();
 	$(".edit").show();
 	$(".bt1").hide();
 	$(".bt2").hide();
 	$(".d").hide();
 	$(".c").prop("disabled", true);
 	$(".c").css('border', '0px');
 	$(".c").css('background-image','none');
 });
 //console.log('ahmad');
 /*$('#un').click(function(){
 	if($(this).attr('value') == '4'){
 		console.log('ahmad');
 	}
 });*/
});