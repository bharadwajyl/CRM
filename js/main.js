//NAV BAR
function NavBar() {
var x = document.getElementById("myTopnav");
if (x.className === "topnav") {
x.className += " responsive";
} else {
x.className = "topnav";
}
}

//AJAX FORM
function ajaxform(type){
var data;
if(type == "0"){
data = $("#login_form").serialize() + "&formtype=login_form";
}else if (type == "1"){
data = "&formtype=logout";
}
else if (type == "2"){
data = $("#company_db").serialize() + "&formtype=company_db";
}
else if (type == "3"){
data = $("#employee_db").serialize() + "&formtype=employee_db";
}
else if (type == "4"){
data = $("#distance").serialize() + "&formtype=distance";
}
else if (type == "5"){
data = $("#employee_list").serialize() + "&formtype=deletion";
}
else{
data = "";
}
var url = "validation.php";
$.ajax({
data:data,
url:url,
type:"POST",
success:function(retrieve){
const popup = document.createElement("div");
popup.setAttribute("id","popup");
popup.innerHTML = retrieve;
if(retrieve.match(/Notice/gi)){
retrieve.replace(/Notice/gi," ");
popup.setAttribute("class","failure");
document.body.appendChild(popup);
}else if(retrieve.match(/log/gi)){
location.reload();
return 1;
}else if(retrieve.match(/kilometer/gi)){
document.getElementById("distance_result").innerHTML = retrieve;
return 1;
}else{
popup.setAttribute("class","success");
document.body.appendChild(popup);
}
setTimeout(function(){ 
var elem = document.querySelector('#popup');
elem.parentNode.removeChild(elem);
if (retrieve.match(/added|deleted/gi)){
$('#body').load(window.location.href + '#body');
}
}, 3000);
}
});
return 1;
}
