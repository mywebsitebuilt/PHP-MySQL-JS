<html>
<head>
<title>login</title>
<style>
p{
    color:red;
    display: inline;
}
</style>

</head>
<body>
<form method="post">
<h2 id="result"></h2>

<h4 id='h'> user name</h4>
<input type='text' id='ip' minlength="3" maxlength="15" name='user' required/>
<h4 id="hnam">Full Name</h4>
<input type="text" id="nam" minlength="3" maxlength="35" spellcheck="false" name='nam' required/>

<h4 id='hmai'> Email</h4>
<input type="email" id="mail" name='mail' required/>
<h4 id='hpno'> Phone Number</h4>

<input type="tel" id="pno" minlength="10" maxlength="10" name='tel' required/>
<h4><p id='p1' style="{color:black;}">Passward</p><p id='p2'></p><p id='p3'></p><p id='p4'></p><p id='p5'></p></h4>
<input type="password" id='pass' minlength="8" maxlength="30" name='pass' required/>
<!--<h4 id='himg'>upload photo</h4>
<input type="file" accept="image/jpeg, image/png, image/jpg" name="imageUpload" multiple="false" id="image" name='photo' required><br>-->
<input type='submit' id='sub' disabled/>


</form>
</body>

<?php
$conn = new mysqli("localhost","root", "123456", "logdata",3333);
if($conn){

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
    $name = $_POST["nam"];
    $use=$_POST["user"];
    $pass = $_POST["pass"];
    $phno = $_POST["tel"];
    $mail = $_POST["mail"];
    //$phot = $_POST["photo"];
    //echo $phot;
    $sql = "INSERT INTO logindata VALUES ('$use', '$pass', '$name', '$mail', '$phno')";
 if (mysqli_query($conn, $sql)) {
 //echo "<h1>Registration successful!</h1>";
 $next=1;
 $next=json_encode($next);
 }

}

?>


<script>
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


hpno=document.getElementById('hpno');
hmai=document.getElementById('hmai');
hpas=document.getElementById('hpas');
hnam=document.getElementById('hnam');
//himg=document.getElementById('himg');


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
    if(used.length>3 && (used.slice(-1)!="@") && (used.slice(-1)!="_")){
    userid=exist(users,used,h,"user name");
    Checkst();
}else{
    h.innerHTML="user name A-Z a-z 0=9 @ _ min:3 max:15";
}
});

mai.addEventListener('input',function(){
    mailid=0;
    Checkst();

var maipat = /^[a-zA-Z0-9._]+@[a-zA-Z0-9.]+\.[a-zA-Z]{2,15}(?:\.[a-zA-Z]{2,5})?$/;
mai.value=mai.value.replace(/[^a-zA-Z0-9@_.]/g, '');
maii=mai.value.trim();
mai.value=maii;
if(maii!=""){
if(maipat.test(maii) && maii.length>7 && maii[0] !== '@' && maii[0] !== '_' && maii[0] !== '.'){
mailid=exist(emails,mai.value,hmai,"Email");
Checkst();
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
phnoid=exist(phnos,phnn,hpno,"Phone Number");
Checkst();
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
Checkst();
    }else{hnam.innerHTML="Enter Full Name"}
}else{
    hnam.innerHTML="Enter a valid name";
}
});


t="Passward";
function pcolorchange(){
    document.getElementById('p1').innerHTML=t;
    document.getElementById('p1').style.color="black";
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
document.getElementById('p1').style.color="black";
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
document.getElementById('p1').style.color="green";
}else{
    document.getElementById('p1').style.color="red";
    if(passs.length==0 || passs==""){
    document.getElementById('p1').style.color="black";
    }
}
if(/[a-z]/.test(passs)){
document.getElementById('p2').style.color="green";
}else{
    document.getElementById('p2').style.color="red";
}
if(/[0-9]/.test(passs)){
document.getElementById('p3').style.color="green";
}else{
    document.getElementById('p3').style.color="red";
}
if(/[^a-zA-Z0-9]/.test(passs)){
document.getElementById('p4').style.color="green";
}else{
    document.getElementById('p4').style.color="red";
}
if(passs.length>7){
document.getElementById('p5').style.color="green";
}else{
    document.getElementById('p5').style.color="red";
}

if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=]).{8,}$/.test(passs)){
passid=1;
    document.getElementById('p1').style.color="black";
    Checkst();
t="Passward ok";   
pcolorchange();
}

});

/*
img1.addEventListener('input',function(){
    imgid=0;
    himg.innerHTML="upload photo";
    Checkst();
file = this.files[0];
file=file.name;
file1=file.toString();
file1=file1.toLowerCase();
if(file1!="" || img1.value!=""){
if(file1.endsWith('.png') || file1.endsWith('.jpg') || file1.endsWith('.jpeg')){
    imgid=1;
    Checkst();
    himg.innerHTML="photo ok "+file1;
    
}else{
    img1.value="";
}
}
if(file1=="" || img1.value=="" || imgid==0 ){
    himg.innerHTML="upload photo (format .jpg .png .jpeg)";
    img1.value="";
    imgid=0;
}
});
*/



function idreset(){
userid="";
mailid="";
phnoid="";
nameid="";
passid="";
//imgid="";
}
idreset();


function resultres(){
    document.getElementById("result").innerHTML="";

}

sub=document.getElementById('sub');



function Checkst(){
if(userid==1 && mailid==1 && phnoid==1 && nameid==1 && passid==1 ){
sub.disabled=false;
}else{
        document.getElementById("result").innerHTML="Fill the form"+userid+" "+mailid+" "+phnoid+" "+passid+" "+nameid+" ";
        sub.disabled=true;
    }

}

sub.addEventListener('click',function(){
        dataip=[use.value,pass.value,nam.value,mai.value,pno.value];
        document.getElementById("result").innerHTML="Submited ";
        idreset();
    
});
    
</script>

</html>