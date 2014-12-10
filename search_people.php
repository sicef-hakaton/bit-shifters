<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="images/book.ico" >
        <title>Search people</title>
        <link rel="stylesheet" type="text/css" href="css/search_peopleStyle.css"/>
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/search_peopleJQ.js"></script>
        <?php 
            session_start();
            require './php/konstante.php'; 
            if(!isset($_SESSION["username"])){
            header("Location: ".URL."index.php");
            exit();
        }?>
    </head>
    <body>
        <!--<textarea id="area"></textarea>-->
        <!--<span id="uokviren_tag">Fudbal</span>-->
        <section id="main_section">
            <article id="search_form">
                <button id="back" onclick="javascript:window.location.href='<?php echo URL; ?>prva_strana.php'" >back</button>
                <form id='piple_form' action="#" method="post">
                    <select id="drzava_search" name="drzava">
                        <option value=''>choose country</option>
                        <?php
                            require './php/php_funkcije.php';
                            drzave("prazno");
                        ?>
                    </select>
                    <br>
                    <!--<span id="drzava_check"></span>-->
                    <!--<br>-->
                    <select id="grad_search" name="grad">
                        <option value=''>choose city</option>
                        <?php
                            gradovi("prazno");
                        ?>
                    </select>
                    <!--<br>-->
                    <!--<span id="grad_check"></span>-->
                    <br>
                    <select id="fakultet_search" name="fakultet">
                        <option value=''>select your faculty</option>
                        <?php
                            fakulteti("prazno");
                        ?>
                    </select>
                    <br>
                    <input id="user_name_search" type="text" name="user_name" value="username"/>
                    <br>
                    

                    <!--<span id="user_name_check"></span>-->
                    <!--<br>-->
                    <div id="uokvireno"></div><br>
                    <input id="tagovi" type="text" name="tagovi" value="tags"/>
                    <input id="tagovi_php" type="text" name="tagovi" value="" style="display: none"/>
                    <br>
                    <!--<span id="pass_check"></span>-->
                    <!--<br>-->
                    <input id="sbm_search" type="submit" value="Search"/>
                </form><br>
            </article>
            <article id="search_results">


            </article>

        </section>
    </body>
</html>
