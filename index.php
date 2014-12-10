<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
         <link rel="shortcut icon" href="images/book.ico" >
        <link rel="stylesheet" type="text/css" href="css/indexStyle.css"/>
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/indexJQ.js"></script>
        <?php 
            session_start();
            require './php/konstante.php'; 
            if(isset($_SESSION["username"])){
            header("Location: ".URL."prva_strana.php");
            exit();
        }?>
    </head>
    <body>
        <script lang="javascript">
            $(document).ready(function(){
                
            <?php
                if (isset($_GET["succ"])){
                    if($_GET["succ"]==0){
                        echo "open_registration();";
                    }
                }
            ?>
            });
        
        </script>
        <div id="registration">
            <form id="reg_form" action="php/get_upiti_php.php?upit=registracija" method="post" enctype="multipart/form-data">
                <input id="user_name_down" type="text" name="user_name" 
                       value="<?php if (isset($_GET["username"])) echo $_GET["username"]; else echo "username"; ?>" />
                <br>
                <span id="user_name_down_check"> <?php if(isset($_GET["usernameq"])){
                    if($_GET["usernameq"]==0) echo "Invalid";}  ?> </span>
                <br>
                <input id="pass_down" type="password" name="password" value="<?php if (isset($_GET["password"])) echo $_GET["password"]; else echo "password"; ?>"/>
                <br>
                <span id="pass_down_check"><?php if(isset($_GET["passwordq"])){
                    if($_GET["passwordq"]==0) echo "Invalid";}  ?></span>
                <br>
                <input id="email_down" type="email" name="email" value="<?php if (isset($_GET["email"])) echo $_GET["email"]; else echo "email"; ?>"/>
                <br>
                <span id="email_down_check"><?php if(isset($_GET["emailq"])){
                    if($_GET["emailq"]==0) echo "Invalid";}  ?></span>
                <br>
               
                <select id="fax" name="faculty">
                    <option value=''>selecet your faculty</option>
                    <?php
                        require './php/php_funkcije.php';
                        if (isset($_GET["faculty"])) fakulteti($_GET["faculty"]); else fakulteti("prazno");
                    ?>
                </select>
                <br>
                <span id="fax_down_check"><?php if(isset($_GET["facultyq"])){
                    if($_GET["facultyq"]==0) echo "Invalid";}  ?></span>
                <br>
                
                
                <input id="skype_down" type="text" name="skype" value="<?php if (isset($_GET["skype"])) echo $_GET["skype"]; else echo "skype"; ?>"/>
                <br>
                <span id="skype_down_check"></span>
                <br>
                <input id="facebook" type="text" name="facebook" value="<?php if (isset($_GET["facebook"])) echo $_GET["facebook"]; else echo "facebook"; ?>"/>
                <br>
                <span id="facebook_down_check"></span>
                <br>
                <input id="g_plus" type="text" name="google" value="<?php if (isset($_GET["google"])) echo $_GET["google"]; else echo "google plus"; ?>"/>
                <br>
                <span id="fax_down_check"></span>
                <br>

                
                <select id="drzava" name="drzava">
                    <option value=''>choose country</option>
                    <?php
                        if (isset($_GET["drzava"])) drzave($_GET["drzava"]); else drzave("prazno");
                    ?>
                </select>
                <br>
                <span id="drzava_check"><?php if(isset($_GET["drzavaq"])){
                    if($_GET["drzavaq"]==0) echo "Invalid";}  ?></span>
                <br>
                <select id="grad" name="grad">
                    <option value=''>choose city</option>
                    <?php
                        if (isset($_GET["grad"])) gradovi($_GET["grad"]); else gradovi("prazno");
                    ?>
                </select>
                <br>
                <span id="grad_check"><?php if(isset($_GET["gradq"])){
                    if($_GET["gradq"]==0) echo "Invalid";}  ?></span>
                <br>
                <input type="file" name="slika" /><br>
                <input id="sbm_down" type="submit" value="Sign up"/>
                <button id="close" type="button" value="close"/>
            </form><br>
        </div>

        <div id="index_wrapper">
            <header id="log_in_header">
                <h1 id="naslov">NerdHub</h1>
                <h3 id="moto">Learn. Share. Connect.</h3>
<!--                <link rel="shortcut icon" href="images/book.ico" >-->
            </header>
            <section id="log_in_page_main_section">
                <article id="log_in_picture">
                    <img id="index_img" src="images/index1.png" alt="index slika"/>
                </article>
                <article id="log_in">
                    <form id='log_form' action="php/get_upiti_php.php?upit=login" method="post">
                        <input id="user_name" type="text" name="user_name" value="<?php if(isset($_GET["registration_complited"])) echo $_GET["registration_complited"]; else 
                            if (isset ($_GET["logusername"])) echo $_GET["logusername"]; else echo "username"?>"/>
                        <br>
                        <span id="user_name_check"><?php if(isset($_GET["logusernameq"])){
                    if($_GET["logusernameq"]==0) echo "Invalid";}  ?></span>
                        <br>
                        <input id="pass" type="password" name="password" value="<?php if (isset($_GET["logpassword"])) echo $_GET["logpassword"]; else echo "password"; ?>"/>
                        <br>
                        <span id="pass_check"><?php if(isset($_GET["logpasswordq"])){
                    if($_GET["logpasswordq"]==0) echo "Invalid";}  ?></span>
                        <br>
                        <input id="sbm" type="submit" value="Log in"/>
                    </form><br>
                    <p>You don't have account yet? <a href="#"><span id="create_acc">Sign up now.</span></a></p>
                </article>
            </section>
        </div>
    </body>
</html>
