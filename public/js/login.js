var x=document.getElementById("num");
x.onfocus=function(){
	this.setAttribute('pl',this.getAttribute('placeholder'));
	this.setAttribute('placeholder','');
}
x.onblur=function(){
	//this.setAttribute('pl',this.getAttribute('placeholder'));
	this.setAttribute('placeholder',this.getAttribute('pl'));
}

var x=document.getElementById("pass");
x.onfocus=function(){
	this.setAttribute('pl',this.getAttribute('placeholder'));
	this.setAttribute('placeholder','');
}
x.onblur=function(){
	//this.setAttribute('pl',this.getAttribute('placeholder'));
	this.setAttribute('placeholder',this.getAttribute('pl'));
}
var mych=document.getElementById("ch");
var mypass=document.getElementById("pass");
//mych.defaultChecked="true";
function hide()
{
mypass.setAttribute("type","password");
document.getElementById("h").innerHTML=" اظهار كلمة السر";

}
function show()
{
mypass.setAttribute("type","text");
document.getElementById("h").innerHTML="   اخفاء كلمة السر ";


}

mych.onchange=function()
{
if(this.checked)
show();
else
hide();



}