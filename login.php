<html>
<head>
<title>

</title>
<link rel="stylesheet" href="login.css">
</head>

<body>
<div id="form">

<form method="post">
<h4 id='hmai'> Email</h4>
<input type="email" id="mail" name='mail' required/>

<h4><p id='p1' >Passward</p></h4>
<input type="password" id='pass1' name="pass" required/>
<br><br><input type="submit" value="login" id="sub"/><br>
<h4 id="rd"></h4>

<h4>create an account <a href="index2.php">sign up</a></h4>
</form>
</div>
<div id="div1">
            <div id="box">
            <button id="cl" onClick="clos()">sign up</button>

                <h4 id="box1">user not found</h4>
                <button id="cl" onClick="clos()">sign up</button>
            </div>
        </div>
</body>

<?php
$conn=mysqli_connect("localhost","root","123456","logdata",3333);
$ar=[0,0];
$userArray=[];
if($conn){
    echo "connected";

    $result=0;
    $userArray=[];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email=$_POST["mail"];
        $pass1=$_POST["pass"];

        $sql="select(select count(*) from logindata where email='{$email}') as coun;";
        $op=mysqli_query($conn,$sql);
        if($op->num_rows > 0){
            while($row = mysqli_fetch_assoc($op)){
                $ch=$row['coun'];
                if($ch== '1'){
                    echo " user found";
                    $ar[0]=1;
                    $sql2="select(select password from logindata where email='{$email}') as pass;";
                    $op2=mysqli_query($conn,$sql2);
                    if($op2->num_rows > 0){
                        while($row = mysqli_fetch_assoc($op2)){
                            $ch2=$row["pass"];
                            if($ch2== $pass1){
                            echo "unlocked";
                            $ar[1]=1;
                            $sql3= "select * from logindata where email='{$email}'";
                            $op3=mysqli_query($conn,$sql3);
                            if($op3){
                            if($op3->num_rows > 0){
                                while ($row = mysqli_fetch_assoc($op3)) {
                                    $userArray = array(
                                        'user' => $row['user'],
                                        'name' => $row['name'],
                                        'email' => $row['email'],
                                        'phno' => $row['phno'],
                                        'password' => $row['password']
                                    );
                                }

                            }
                        }else{
                            echo "no data";
                        }
                        $userArray=json_encode($userArray);
                            //echo $userArray;
                            echo "<script>";
                            echo "var arr = [" . implode(",", $ar) . "];"; 
                            echo "var arr12 = " . $userArray . ";";
                            echo "if(arr[0] == 1 && arr[1] == 1) {"; 
                            echo "localStorage.setItem('userData', JSON.stringify(arr12));";
                           //echo "document.getElementById('p1').innerHTML=arr12;}"; 
                           echo "  window.location.href = 'Profile.php'; }";
                            echo "</script>";
                            }else{
                                echo "<script>";
                                echo "document.getElementById('rd').innerHTML='wrong password';";
                                echo "</script>";                                
                                $ar[1]=0;

                            }
                        }
                    }
                }else{
                    echo "<script>";
                    echo "document.getElementById('rd').innerHTML='user not found';";
                    echo "</script>";
                
                }
    }
}

$ar=json_encode($ar);
$userArray=json_encode($userArray);

}

}

?>

<script>
mai=document.getElementById('mail');
hmai=document.getElementById('hmai');
sub=document.getElementById('sub');

mai.addEventListener('input',function(){
    mailid=0;
    document.getElementById('rd').innerHTML="";
var maipat = /^[a-zA-Z0-9._]+@[a-zA-Z0-9.]+\.[a-zA-Z]{2,15}(?:\.[a-zA-Z]{2,5})?$/;
mai.value=mai.value.replace(/[^a-zA-Z0-9@_.]/g, '');
maii=mai.value.trim();
mai.value=maii;
if(maii!=""){
if(maipat.test(maii) && maii.length>7 && maii[0] !== '@' && maii[0] !== '_' && maii[0] !== '.'){
mailid=1;
hmai.innerHTML="Email ok";
}else{
    hmai.innerHTML="Enter a valid email";
}
}else{
    hmai.innerHTML="Email";

}

});

pass1=document.getElementById('pass1');
pass1.addEventListener('input',function(){
    document.getElementById('rd').innerHTML="";

})

</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>