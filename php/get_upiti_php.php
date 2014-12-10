<?php
    //registracija
    function vrati_na_register($username,$password,$email,$drzava,$grad,$faculty,$skype,$google,$facebook,
            $usernameQ,$passwordQ,$emailQ,$drzavaQ,$gradQ,$facultyQ){
        //require './konstante.php';
        
        $str="index.php?succ=0&username=".$username."&password=".$password.
                "&email=".$email."&drzava=".$drzava."&grad=".$grad.
                "&faculty=".$faculty."&skype=".$skype."&google=".$google."&facebook=".$facebook.
                "&usernameq=".$usernameQ."&passwordq=".$passwordQ.
                "&emailq=".$emailQ."&drzavaq=".$drzavaQ."&gradq=".$gradQ."&facultyq=".$facultyQ;
        header("Location: ".URL.$str);
    }
    function registracija(){
        
        $p=TRUE;
        $username="";
        $password="";
        $email="";
        $drzava="";
        $grad="";
        $faculty="";
        $skype="";
        $google="";
        $facebook="";
        $fajl="";
        $usernameQ=1;
        $passwordQ=1;
        $emailQ=1;
        $drzavaQ=1;
        $gradQ=1;
        $facultyQ=1;
        require './db_connection.php';
        require './php_funkcije.php';
        require './konstante.php';
        if (!isset($_POST['user_name']) || empty($_POST['user_name'])){
            $p=FALSE;
            $usernameQ=0;
        }else{
            $username= mysql_real_escape_string($_POST['user_name']);            
        }
        
        if (!isset($_POST['password']) || empty($_POST['password'])){
            $p=FALSE;
            $passwordQ=0;
        }else{
            $password=  mysql_real_escape_string($_POST['password']);
        }
        
        if (!isset($_POST['email']) || empty($_POST['email'])){
            $p=FALSE;
            $emailQ=0;
        }else{
            $email=  mysql_real_escape_string($_POST['email']);
        }
        
        if (!isset($_POST['drzava']) || empty($_POST['drzava'])){
            $p=FALSE;
            $drzavaQ=0;
        }else{
            $drzava=  mysql_real_escape_string($_POST['drzava']);
        }
        
        if (!isset($_POST['grad']) || empty($_POST['grad'])){
            $p=FALSE;
            $gradQ=0;
        }else{
            $grad=  mysql_real_escape_string($_POST['grad']);
        }
        if (!isset($_POST['faculty']) || empty($_POST['faculty'])){
            $p=FALSE;
            $facultyQ=0;
        }else{
            $faculty=  mysql_real_escape_string($_POST['faculty']);
        }
        if (!isset($_POST['skype']) || empty($_POST['skype'])){
            $skype="";
        }else{
            $skype=  mysql_real_escape_string($_POST['skype']);
        }
        if (!isset($_POST['google']) || empty($_POST['google'])){
            $google="";
        }else{
            $google=  mysql_real_escape_string($_POST['google']);
        }
        if (!isset($_POST['facebook']) || empty($_POST['facebook'])){
            $facebook="";
        }else{
            $facebook=  mysql_real_escape_string($_POST['facebook']);
        }
        
        if (!isset($_FILES['slika'])){
            $p=FALSE;
        }else{
            $fajl=  $_FILES['slika'];
        }
        
        if(!$p){
            //header("Location: http://www.google.com");exit();
            vrati_na_register($username, $password, $email, $drzava, $grad,
                    $faculty,$skype,$google,$facebook,$usernameQ, $passwordQ, $emailQ, $drzavaQ, $gradQ,$facultyQ);
            exit();
        }
        //[a-zA-Z0-9_] regex
        //SELECT count(*) AS broj FROM user WHERE username='stefan'
        if(!digit_character_underscoreQ($username) || !string_lengthQ($password, 4, 20)
                || !emailQ($email)){
            $p=false;
            if (!digit_character_underscoreQ($username)) $usernameQ=0;
            if (!string_lengthQ($password, 4, 20)) $passwordQ=0;
            if (!emailQ($email)) $emailQ=0;
        }
        if(!$p){
            
            vrati_na_register($username, $password, $email, $drzava, $grad,
                    $faculty,$skype,$google,$facebook,$usernameQ, $passwordQ, $emailQ, $drzavaQ, $gradQ,$facultyQ);exit();
        }
        
        $sql="SELECT count(*) AS broj FROM user WHERE username='$username'";
        $kveri=mysql_query($sql);
        if($row=  mysql_fetch_assoc($kveri)){
            if($row['broj']!=0) {
                $p=false;
                $usernameQ=0;
            }
        }else{
            $p=false;
            $usernameQ=0;
        }
        $sql="SELECT count(*) AS broj FROM grad WHERE grad='$grad'";
        $kveri=mysql_query($sql);
        if($row=  mysql_fetch_assoc($kveri)){
            if($row['broj']==0) {
                $p=false;
                $gradQ=0;
            }
        }else{
            $p=false;
            $gradQ=0;
        }
        $sql="SELECT count(*) AS broj FROM fakultet WHERE fakultet='$faculty'";
        $kveri=mysql_query($sql);
        if($row=  mysql_fetch_assoc($kveri)){
            if($row['broj']==0) {
                $p=false;
                $facultyQ=0;
            }
        }else{
            $p=false;
            $facultyQ=0;
        }
        $sql="SELECT count(*) AS broj FROM drzava WHERE drzava='$drzava'";
        $kveri=mysql_query($sql);
        if($row=  mysql_fetch_assoc($kveri)){
            if($row['broj']==0) {
                $drzavaQ=0;
                $p=false;
            }
        }else{
            $drzavaQ=0;
            $p=false;
        }
        $grad_id=0;
        $sql="SELECT id FROM grad WHERE grad='$grad'";
        $kveri=mysql_query($sql);
        if($row=  mysql_fetch_assoc($kveri)){
            $grad_id=$row['id'];
        }else{
            $p=false;
            $gradQ=0;
        }
        $fakultet_id=0;
        $sql="SELECT id FROM fakultet WHERE fakultet='$faculty'";
        $kveri=mysql_query($sql);
        if($row=  mysql_fetch_assoc($kveri)){
            $fakultet_id=$row['id'];
        }else{
            $p=false;
            $facultyQ=0;
        }
        if ($p){
            $url="";
            if(imageQ($fajl["tmp_name"])){
                try{
                    $temp = explode(".",$fajl["name"]);
                    $newfilename = $username . '.' .end($temp);
                    //move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename;

                    $target_dir="../images/users_profile_images/";
                    $targer_file = $target_dir.  $newfilename;
                    move_uploaded_file($fajl["tmp_name"], $targer_file);
                    $url=URL."images/users_profile_images/".$newfilename;
                }  catch (Exception $e){
                    $url=URL."images/users_profile_images/default.png";
                }
            }else{
                $url=URL."images/users_profile_images/default.png";
            }
            $url=  mysql_real_escape_string($url);
            $sql="INSERT INTO user VALUES ('$username','$password','$email','$skype','$facebook','$google','$url','$fakultet_id','$grad_id');";
            $kveri=mysql_query($sql);   
           // header("Location: ".URL."index.php");
            header("Location: ".URL."index.php?registration_complited=".$username);
            exit();
        }else{
            
            vrati_na_register($username, $password, $email, $drzava, $grad,
                    $faculty,$skype,$google,$facebook,$usernameQ, $passwordQ, $emailQ, $drzavaQ, $gradQ,$facultyQ);exit();
        }
    }
    function login_return($ime,$sifra,$un,$pass){
        $str="index.php?logusername=".$ime."&logpassword=".$sifra.
               "&logusernameq=".$un."&logpasswordq=".$pass;
        header("Location: ".URL.$str);
        exit();
    }
    //logovanje
    function uloguj_se($un,$pass){
        session_start();
        $sql="SELECT * FROM user WHERE username='$un'";
        $kveri=mysql_query($sql);
        if($row=  mysql_fetch_assoc($kveri)){
            $_SESSION["username"]=$un;
            $_SESSION["email"]=$row["email"];
            $_SESSION["slika_url"]=$row["slika_url"];
            $grad_id=$row["grad_id"];
            $sql2="SELECT * FROM grad WHERE id='$grad_id'";
            $kveri2=  mysql_query($sql2);
            
            if($row2= mysql_fetch_assoc($kveri2)){
                $_SESSION["grad"]=$row2["grad"];
                $drzava_id=$row2["drzava_id"];
                $sql3="SELECT * FROM drzava WHERE id='$drzava_id'";
                $kveri3= mysql_query($sql3);
                if($row3=  mysql_fetch_array($kveri3)){
                    $_SESSION["drzava"]=$row3["drzava"];
                    header("Location: ".URL."prva_strana.php");exit();
                }
            }
        }
    }
    function login(){
        $p=TRUE;
        $username="";
        $password="";
        $usernameQ=1;
        $passwordQ=1;
        require './db_connection.php';
        require './konstante.php';
        if (!isset($_POST['user_name']) || empty($_POST['user_name'])){
           $usernameQ=0;
           $p=FALSE;
        }else{
            $username= mysql_real_escape_string($_POST['user_name']);            
        }
        
        if (!isset($_POST['password']) || empty($_POST['password'])){
            $passwordQ=0;
            $p=FALSE;
        }else{
            $password=  mysql_real_escape_string($_POST['password']);
        }
        if(!$p){
            login_return($username,$password,$usernameQ, $passwordQ);
        }
        $sql="SELECT count(*) AS broj FROM user WHERE username='$username'";
        $kveri=mysql_query($sql);
        if($row=  mysql_fetch_assoc($kveri)){
            if($row['broj']==0) {
                $p=false;
                $usernameQ=0;
                login_return($username,$password,$usernameQ, $passwordQ);
            }
        }else{
            $p=false;
            $usernameQ=0;
            $passwordQ=0;
            login_return($username,$password,$usernameQ, $passwordQ);
        }
        $sql="SELECT count(*) AS broj FROM user WHERE username='$username' AND password='$password'";
        $kveri=mysql_query($sql);
        if($row=  mysql_fetch_assoc($kveri)){
            if($row['broj']==0) {
                $p=false;
                $passwordQ=0;
                login_return($username,$password,$usernameQ, $passwordQ);
            }
        }else{
            $p=false;
            $usernameQ=0;
            $passwordQ=0;
            login_return($username,$password,$usernameQ, $passwordQ);
        }
        uloguj_se($username, $password);
    }
    function logout(){
        //header("Location: http://www.google.com");exit();
        session_start();
        session_unset();
        require './konstante.php';
        header("Location: ".URL);
        
    }
    if (isset($_GET['upit']) && !empty($_GET['upit'])) {
        $action = $_GET['upit'];
        //require './db_connection.php';
        switch ($action) {
            case 'registracija' : registracija();
                break;
            case 'login' : login() ;
                break;
            case 'logout' : logout() ;
                break;
        
        }
    }
    
       
?>