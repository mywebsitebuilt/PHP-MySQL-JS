<html>
<head>

<link rel="stylesheet" href="profile.css">
</head>
<body>
<h2 align="center" id="profilehead">Your Profile</h2>

<div id='over'>

<section id="profile">
    <div id="datadiv">
    <div id="butt">
<button type="button" id="edit" onClick="openEdit()">edit</button><p id="detl">Your Details</p>
<button onclick="logout()" id="logout">Log Out</button>
</div>
<strong><h3 id="un"></h3></strong>
<strong><h3 id="full"></h3></strong>
<strong><h3 id="ph"></h3></strong>
<strong><h3 id="mailed"></h3></strong>
</div>
</section>


<section id="form1">
    
<div id="form">
<form method="post" id="formed"><button onClick="closed('form')" id="closeb" style="float:right;">X</button>
<div id="close"><h1 id="result">Edit Your Profile</h1></div>

<input type="text" id="pastuser" name="pastusers" style="display:none;"/>
<h4 id='h'> user name</h4>
<input type='text' id='ip' minlength="3" maxlength="15" name='user' required/>
<h4 id="hnam">Full Name</h4>
<input type="text" id="nam" minlength="3" maxlength="35" spellcheck="false" name='nam' required/>

<h4 id='hmai'> Email</h4>
<input type="email" id="mail" name='mail' required/>
<h4 id='hpno'> Phone Number</h4>

<input type="tel" id="pno" minlength="10" maxlength="10" name='tel' required/>
<div id="passdiv">
<h4><p id='p1' >Passward</p><p id='p2'></p><p id='p3'></p><p id='p4'></p><p id='p5'></p></h4>
<input type="password" id='pass' minlength="8" maxlength="30" name='pass' required/>
</div>
<br><br><input type='submit' id='sub' value="save" disabled/>
</form>
</div>
</section></div>
<div id="div1">
            <div id="box"><button id="closeb" onClick="closed('div1')" style="float:right;">X</button>
                <h4 id="box1">changes saved</h4>
            </div>
        </div>

        <div id="div2">
            <div id="box">
                <h4 id="box2">Your Session Expired<br>please sign in</h4>
                <button id="cl" onClick="login()"><a href="login.php" style="color:black;">sign in</a></button>
            </div>
        </div>
        <div id="discarddiv" style="display:none">
        <div id="box">
            <h4 id="box2">Discard Changes</h4>
            <button id="closeb" onClick="closed('discarddiv')" >cancel</button>
           <button id="closeb" onClick="closed('div1')" >Discard</button>
            </div>
        </div>
        <div id="passcheck">
        <div id="box">

        <button onClick="closed('passcheck')" style="margin-left:60%;float:right;">X</button><br>
            <h4 id="box2" align="center" >Enter Your Password</h4>
           <input type="password" id="ippass" required/>           
           <input type="submit" value="Enter" style="width:auto;font-size:15px;" onClick="passcheker()" />
    <br>
            <h4  id="inpass" >incorrect password</h4>
            </div>
        </div>
</body>
<?php
$conn = new mysqli("localhost","root", "123456", "logdata",3333);
if($conn){
$cdcode=0;
$user=[];
$email=[];
$phno=[];
$sql="select user,email,phno from logindata;";
$op=mysqli_query($conn,$sql);
if($op->num_rows > 0){
    while($row = mysqli_fetch_assoc($op)){
    
    array_push($user,$row['user']);
    array_push($email,$row['email']);
    array_push($phno,$row['phno']);
    }

}
}

$data = [
    'user' => $user,
    'email' => $email,
    'phno' => $phno
];

$data=json_encode($data);

//data submit

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pastuserd=$_POST["pastusers"];
    $name = $_POST["nam"];
    $use=$_POST["user"];
    $pass = $_POST["pass"];
    $phno = $_POST["tel"];
    $mail = $_POST["mail"];
    $sql3 = "delete from logindata where user='$pastuserd';";
    if (mysqli_query($conn, $sql3)) {
    $sql2 = "INSERT INTO logindata VALUES ('$use', '$pass', '$name', '$mail', '$phno')";
 if (mysqli_query($conn, $sql2)) {
echo "<script>";
echo "document.getElementById('div1').style.display='flex';";
echo "</script>";
}
}
}
?>


<script>
    


    //document.getElementById("form").style.display="none";

        var pdata = JSON.parse(localStorage.getItem('userData'));
    //display user data
    function userdatadis(){
       // var pdata = JSON.parse(localStorage.getItem('userData'));
    if(pdata===null){
pdata={user:"",name:"",phno:"",email:""}
document.getElementById("profile").style.display="none";

    }else{
        document.getElementById('un').innerHTML=  "User Name     : "+pdata["user"];
document.getElementById('full').innerHTML="Full Name     : "+pdata["name"];
document.getElementById('ph').innerHTML=  "Phone Number  : "+pdata["phno"];
document.getElementById('mailed').innerHTML="Email address : "+pdata["email"];
  }
}
userdatadis();

//logout display message
function pageout(){
    if(localStorage.getItem("userData") === null){
        document.getElementById("div2").style.display="flex";
        closed('form');
        pageout();

    }else{
        document.getElementById("div2").style.display="none";
    }
}
pageout();

//edit box


function openEdit(){
   //setting old user
   document.getElementById("passcheck").style.display="flex";
    
}
//off incorrect password
ippass=document.getElementById('ippass');
ippass.addEventListener('input',function(){
    document.getElementById("inpass").style.display="none";
});
//check enter password
function passcheker(){
    if(ippass.value==pdata["password"]){
        document.getElementById("passcheck").style.display="none"
        document.getElementById('pastuser').value=pdata["user"];
    document.getElementById('ip').value=pdata["user"];
    document.getElementById('nam').value=pdata["name"];
    document.getElementById('pno').value=Number(pdata["phno"]);
    document.getElementById('pass').value=pdata["password"];
    document.getElementById('mail').value=pdata["email"];

    document.getElementById("form1").style.display="flex";
    Checkst();
    }else{
        document.getElementById("inpass").style.display="flex";
    }
}




function closed(ided){
    /*
    if(ided=="form" && (document.getElementById('sub').disabled).toString()=="true"){
        document.getElementById("discarddiv").style.display="flex";
    }else{
        document.getElementById(ided).style.display="none";
    }*/
    document.getElementById(ided).style.display="none";

}

function logout(){
localStorage.removeItem("userData");
userdatadis();
pageout();
}

var users = <?php echo json_encode($user); ?>;
var emails = <?php echo json_encode($email); ?>;
var phnos = <?php echo json_encode($phno); ?>;


use=document.getElementById('ip');
mai=document.getElementById('mail');
pno=document.getElementById('pno');
pass=document.getElementById('pass');
nam=document.getElementById('nam');
sub=document.getElementById('sub');
//img1=document.getElementById('image');


sub.addEventListener('click',function(){
//alert(cdcode);
document.getElementById("formed").method="post";

userDatas={"user":use.value,"name":nam.value,"phno":pno.value,"password":pass.value,"email":mai.value};
localStorage.removeItem("userData");
localStorage.setItem("userData",JSON.stringify(userDatas));
pdata=localStorage.setItem(JSON.parse("userData"));

userdatadis();
});

hpno=document.getElementById('hpno');
hmai=document.getElementById('hmai');
hpas=document.getElementById('hpas');
hnam=document.getElementById('hnam');
//himg=document.getElementById('himg');


//dilogue box next


//exist checking
function exist(list,ip,po,type){
    if(list.includes(ip) ){
    po.innerHTML=type+" already exists";
    idk=0;
    }else{
        po.innerHTML=type+" ok";
        idk=1;
    }
    return idk;
}

use.addEventListener('input',function(){
    userid=0;
    Checkst();

    usee=use.value;
    used=usee.replace(/[^a-zA-Z0-9_@]/g, '')
    use.value=used;
    if(used.length!=0){
    if(used.length>3 && (used.slice(-1)!="@") && (used.slice(-1)!="_")){
        if(used!=pdata["user"]){

    userid=exist(users,used,h,"user name");
    Checkst();
        }else{
            userid=1;
            h.innerHTML="user name";
        }
}else{
    h.innerHTML="user name A-Z a-z 0=9 @ _ min:3 max:15";
}
}else{
    h.innerHTML="user name";
}
});

mai.addEventListener('input',function(){
    mailid=0;
    Checkst();

var maipat = /^[a-zA-Z0-9._]+@[a-zA-Z0-9.]+\.[a-zA-Z]{2,15}(?:\.[a-zA-Z]{2,5})?$/;
mai.value=mai.value.replace(/[^a-zA-Z0-9@_.]/g, '');
maii=mai.value.trim();
mai.value=maii.toLowerCase();

if(maii!=""){
if(maipat.test(maii) && maii.length>7 && maii[0] !== '@' && maii[0] !== '_' && maii[0] !== '.'){
    if(maii!=pdata["email"]){
mailid=exist(emails,mai.value,hmai,"Email");
Checkst();
    }else{
        mailid=1;
        hmai.innerHTML="Email";
    }
}else{
    hmai.innerHTML="Enter a valid email";
}
}else{
    hmai.innerHTML="Email";

}

});




pno.addEventListener('input',function(){
    phnoid=0;
    Checkst();

phpat2=/^[6-9]$/;
phnn=pno.value.replace(/\D/g, '')
pno.value=phnn;
phh=pno.value;
if(phnn!=""){
if(Number(phnn[0])>5){
    if(phnn.length>9){
        if(phnn!=pdata["phno"]){
phnoid=exist(phnos,phnn,hpno,"Phone Number");
Checkst();
}else{
            phnoid=1;
            hpno.innerHTML="Phone Number";
            Checkst();
        }
}else{
    hpno.innerHTML="phone number must be 10 digits";
}
}else{
    hpno.innerHTML="Enter a valid Phone Number";
}


}else{
    hpno.innerHTML="Phone Number";
}
});


nam.addEventListener('input',function(){
    nameid=0;
    Checkst();

namm= nam.value.replace(/[^a-zA-Z\s]/g, '');
nam.value=namm.toUpperCase();
if(namm.length>2 && namm[0]!=" " && namm.slice(-1)!=" "){
    
    if(namm.includes(" ")){
    hnam.innerHTML="Name ok";
    nameid=1;
    if(namm==pdata["name"]){
    hnam.innerHTML="Name";
    nameid=1;
    }
Checkst();
    }else{hnam.innerHTML="Enter Full Name"}
}else{
    hnam.innerHTML="Enter a valid name";
}
});


t="Passward";
function pcolorchange(){
    document.getElementById('p1').innerHTML=t;
    document.getElementById('p1').style.color="aliceblue";
    document.getElementById('p2').innerHTML="";
    document.getElementById('p3').innerHTML="";
    document.getElementById('p4').innerHTML="";
    document.getElementById('p5').innerHTML="";
}
pcolorchange();


pass.addEventListener('input',function(){

pass.value=pass.value.trim();
passs=pass.value;
passid=0;
document.getElementById('p1').innerHTML="A-Z ";
document.getElementById('p1').style.color="aliceblue";
document.getElementById('p2').innerHTML="a-z ";
document.getElementById('p3').innerHTML="0-9 ";
document.getElementById('p4').innerHTML="^%#$*@&^$ ";
document.getElementById('p5').innerHTML="8 letters";
Checkst();

if(passs.length==0 || passs==""){
    t="Passward";
    pcolorchange();
}

if(/[A-Z]/.test(passs)){
document.getElementById('p1').style.color="rgb(124, 238, 128)";
}else{
    document.getElementById('p1').style.color="red";
    if(passs.length==0 || passs==""){
    document.getElementById('p1').style.color="aliceblue";
    }
}
if(/[a-z]/.test(passs)){
document.getElementById('p2').style.color="rgb(124, 238, 128)";
}else{
    document.getElementById('p2').style.color="red";
}
if(/[0-9]/.test(passs)){
document.getElementById('p3').style.color="rgb(124, 238, 128)";
}else{
    document.getElementById('p3').style.color="red";
}
if(/[^a-zA-Z0-9]/.test(passs)){
document.getElementById('p4').style.color="rgb(124, 238, 128)";
}else{
    document.getElementById('p4').style.color="red";
}
if(passs.length>7){
document.getElementById('p5').style.color="rgb(124, 238, 128)";
}else{
    document.getElementById('p5').style.color="red";
}

if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=]).{8,}$/.test(passs)){
passid=1;
    document.getElementById('p1').style.color=" aliceblue";
    if(passs!=pdata["password"]){
t="Passward ok";
    }else{
        t="Passward";
    }
    
    Checkst();
pcolorchange();
}

});




function idreset(){
userid="";
mailid="";
phnoid="";
nameid="";
passid="";
}
idreset();


function resultres(){
    document.getElementById("result").innerHTML="";

}

sub=document.getElementById('sub');



function Checkst(){
if(((userid==1 || use.value==pdata["user"]) && (mailid==1 || mai.value==pdata["email"]) && ( phnoid==1 || pno.value==pdata["phno"]) &&( nameid==1 || nam.value==pdata["name"]) && (passid==1 || pass.value==pdata["password"])) && (use.value!==pdata["user"] || mai.value!==pdata["email"] || pno.value!==pdata["phno"] || nam.value!=pdata["name"] || pass.value!==pdata["password"])){
    
        sub.disabled=false;
sub.style.backgroundColor='rgb(165, 234, 151)';
    
}else{
       // document.getElementById("result").innerHTML="Fill the form"//+userid+" "+mailid+" "+phnoid+" "+passid+" "+nameid+" ";
        sub.disabled=true;
        sub.style.backgroundColor='rgb(244, 143, 152)';
        document.getElementById("formed").method="";

    }
    document.getElementById("result").innerHTML="Edit Your Profile"//+userid+" "+mailid+" "+phnoid+" "+passid+" "+nameid+" ";
}

sub.addEventListener('click',function(){
        dataip=[use.value,pass.value,nam.value,mai.value,pno.value];
        document.getElementById("result").innerHTML="Submited ";
        idreset();
    
});
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        userdatadis();
        pageout();
    }
</script>
</html>