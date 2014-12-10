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
        <title>Your page</title>
        <link rel="stylesheet" type="text/css" href="css/prva_stranaStyle.css"/>
        <link rel="stylesheet" type="text/css" href="css/boki.css"/>
        <link rel="stylesheet" type="text/css" href="css/luka_style.css"/> 
        <link rel="stylesheet" type="text/css" href="css/goalPrograss.css"/>

        <!--js-->
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/luka.js"></script>

        <!--js i css za datepiskere-->
        <script src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css" />
        <script src="js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.css" />
        <script src="js/jquery.ptTimeSelect.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.ptTimeSelect.css" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />
        <script src="js/datepair.js"></script>
        <script src="js/jquery.datepair.js"></script>

        <?php 
            session_start();
            require './php/konstante.php'; 
            if(!isset($_SESSION["username"])){
                header("Location: ".URL."index.php");
                exit();
            }
        ?>

    </head>
    <body>
        <div id="prva_str_wrapper">
            <header id="prva_strana_header">
                <h1 id="naslov_prva_str">NerdHub</h1>
                <h3 id="moto">Learn. Share. Connect.</h3>
            </header>
            <section id="log_in_page_main_section">
                <article id="boki_part">
                    <?php
                        require './php/db_connection.php';
                        $username=$_SESSION['username'];
                        $datum=date('Y-m-d H:i:s');
                        $sql="SELECT id AS id, user_id AS username, tekst AS tekst, 1 AS tip, 'planned activity' AS pomocni_tekst, datum_objave AS cmp_date FROM aktivnost
                              WHERE user_id in (SELECT user_id_2 FROM prati WHERE user_id_1='$username')
                              UNION
                              SELECT id AS id, user_id AS username, tekst AS tekst, 1 AS tip, 'current activity' AS pomocni_tekst, pocetni_datum AS cmp_date FROM aktivnost
                              WHERE user_id in (SELECT user_id_2 FROM prati WHERE user_id_1='$username') AND '$datum' BETWEEN pocetni_datum AND krajnji_datum
                              UNION
                              SELECT id AS id, user_id AS username, tekst AS tekst, 1 AS tip, 'finished activity' AS pomocni_tekst, krajnji_datum AS cmp_date FROM aktivnost
                              WHERE user_id in (SELECT user_id_2 FROM prati WHERE user_id_1='$username') AND '$datum' > krajnji_datum
                              ORDER BY cmp_date DESC;";
                        $kveri=mysql_query($sql);
                        while($row=  mysql_fetch_assoc($kveri)){
                            $pisac=$row["username"];
                            $art_id=$row["id"];
                            $res="<div id='novosti'><div id='user_data'><img id='user_img' src='";
                            $sql2="SELECT slika_url FROM user WHERE username='$pisac'";
                            $kveri2=  mysql_query($sql2);
                            if($row2= mysql_fetch_assoc($kveri2)){
                                $res.=$row2["slika_url"];
                            }
                            $res.="' /><div id='usn_fax'><h3 id='username'>".$pisac."</h3><p id='fax_prva_str'>";
                            $sql2="SELECT fakultet FROM user,fakultet WHERE username='$pisac' AND user.fakultet_id=fakultet.id";
                            $kveri2=  mysql_query($sql2);
                            if($row2= mysql_fetch_assoc($kveri2)){
                                $res.=$row2["fakultet"];
                            }
                            $res.="</p><p id='text_aktivnost_prva_str'>".$row["pomocni_tekst"]."<br>".$row["tekst"];
                            $res.="</p></div><div id='tags'>";
                            $sql3="SELECT tag FROM aktivnost_tag, tag
                                   WHERE aktivnost_tag.tag_id=tag.id 
                                   AND aktivnost_tag.aktivnost_id='$art_id';";
                            $kveri3=  mysql_query($sql3);
                            while($row3=  mysql_fetch_assoc($kveri3)){
                                $res.="<span id='tag_sp'>".$row3["tag"]."</span>";
                            }
                            $res.="</div><div id='fajlovi'><div id='dokumentacija'><p>Files:</p></div>";
                            $sql3="SELECT fajl FROM aktivnost_fajl, fajl
                                   WHERE aktivnost_fajl.fajl_id=fajl.id 
                                   AND aktivnost_fajl.aktivnost_id='$art_id';";
                            $kveri3=  mysql_query($sql3);
                            while($row3=  mysql_fetch_assoc($kveri3)){
                                $res.="<a href='".$row3["fajl"]."' target='_blank'><span id='file_sp'>";
                                $tmp_str="";
                                try{
                                    $path_parts = pathinfo($row3["fajl"]);
                                    $tmp_str=$path_parts['basename'];
                                }catch(Exception $e){
                                    $tmp_str="Fajl";
                                }
                                $res.=$tmp_str."</span></a>";
                            }     
                            $res.="</div></div></div>";
                            echo $res;
                        }          
                                    
                            
                    ?>
<!--//                    
//                    <div id="novosti">
//                        <div id="user_data">
//                            <img id="user_img" src="images/moon.png" />
//                            <div id="usn_fax">
//                                <h3 id="username">Boki</h3>
//                                <p id="fax_prva_str">Prirodno-matematicki fakultet Nis</p>
//                                <p id="text_aktivnost_prva_str">Ucim matematiku</p>
//                            </div>
//                            <div id="tags">
//                                <span id="tag_sp">Analiza 1</span>
//                                <span id="tag_sp">Redovi</span>
//                                <span id="tag_sp">prvi semestar</span>
//                            </div>
//                            <div id="fajlovi">
//                                <div id="dokumentacija">
//                                    <p>Files:</p>
//                                </div>
//                                <a href="#" target="_blank"><span id="file_sp">Analiza 1</span></a> 
//                                <a href="#" target="_blank"><span id="file_sp">Redovi</span></a>
//                                <a href="#" target="_blank"><span id="file_sp">prvi semestar</span></a>
//                            </div>
//                        </div>
//                    </div>
//                    
//                    
//                    
//                    <div id="novosti">
//                        <div id="user_data">
//                            <img id="user_img" src="images/moon.png" />
//                            <div id="usn_fax">
//                                <h3 id="username">Boki</h3>
//                                <p id="fax_prva_str">Prirodno-matematicki fakultet Nis</p>
//                                <p id="text_aktivnost_prva_str">Ucim matematiku</p>
//                            </div>
//                         
//                            <div id="tags">
//                                <span id="tag_sp">Analiza 1</span>
//                                <span id="tag_sp">Redovi</span>
//                                <span id="tag_sp">prvi semestar</span>
//
//                            </div>
//                            <div id="fajlovi">
//                                <div id="dokumentacija">
//                                    <p>Files:</p>
//                                </div>
//                                <a href="#"><span id="file_sp">Analiza 1</span></a> <a href="#"><span id="file_sp">Redovi</span></a>
//                                <a href="#"><span id="file_sp">prvi semestar</span></a>
//                            </div>
//
//                        </div>
//                    </div>-->
                </article>
                
<!--     Luka part         -->                
                
                 <article id="luka_part">
                    <!--yes no dugme-->
                    <div class="confirm"><div id="yes" >Yes</div> <div id="no" class="hover">No</div> </div>  
                    <div class="confirmloguot"><div id="yes1" >Yes</div> <div id="no1" class="hover">No</div> </div>

                    <div id="usernameluka"><?php echo $_SESSION["username"];?></div>
                    <a class="closepom" id="logout">logout</a>
                    <div id="profile_photo" style="background-image: url('<?php echo $_SESSION["slika_url"];?>');"></div>

                     <!--MENI LISTA-->
                    <div >  
                        <ul >
                            <li class="menu hover" id="memu_findf">Find Friends</li> 
                            <li class="menu hover" id="menu_friends">Friends</li>
                            <li class="menu hover" id="menu_recomende">Recommendations</li>
                            <li class="menu hover" id="menu_stats">Stats</li>
                            <li class="menu hover" id="menu_activities">Activities</li>
                        </ul>
                    </div>


                    <!--FRIEND LISTA-->
                    <div class="hidden friends">

                        <ul>
                            <?php
                                $sql="SELECT user_id_2 FROM prati WHERE user_id_1='$username' ORDER BY user_id_2 ASC";
                                $kveri=  mysql_query($sql);
                                while($row=  mysql_fetch_assoc($kveri)){
                                    $covek=$row["user_id_2"];
                                    $sql4="SELECT * FROM user WHERE username='".$covek."'";
                                    $kveri4=mysql_query($sql4);
                                    if($row4=  mysql_fetch_assoc($kveri4)){
                                        //echo $row4["facebook"]+"xD";
                                        $res="<li  class='list hover prijatelji' ><img id='slika_prijatelj' src='".$row4["slika_url"]."'/>";
                                        $res.="<p id='ime_prijatelja'>".$covek."</p>  <br/><p id='email_prijatelja'>email: ";
                                        $res.=$row4["email"]."</p><br><p id='skype_prijatelja'>skype: ".$row4["skype"]."</p><br>";
                                        $res.="<a id='facebook_link' href='".$row4["facebook"]."' target='_blank'><div style=";
                                        $res.='"'."background-image: url('images/icons/icon_facebook_small.png');".'"';
                                        $res.="id='facebok_button' class='hover'> </div></a><a id='google_plus_link' href='";
                                        $res.=$row4["google"]."' target='_blank'><div style=".'"'."background-image: url('images/icons/google_icon_small.png');".'"';
                                        $res.=" id='google_button' class='hover'> </div></a><a class='close' >×</a></li>";
                                        echo $res;
                                    }
                            
                                }
                            ?>

                          
                        </ul>

                    </div>

                    <!--ACTIVITIES LIST-->
<!--                    <div class="hidden activities">
                        <ul>
                            add new activity
                           
                            <div  class="hover " id="add_new_slide_down">Add new...</div>
                             <div id="add_new_activity">
                            <textarea id="text_aktivnosti"  >activity text</textarea>
                            <div id="basicExample" >
                                <input type="text" class="piker date start" value="date start"/>
                                <input type="text" class="piker time start" value="time start" /><span class="to">to</span>
                                <input type="text" class="piker time end" value="time end" />
                                <input type="text" class="piker date end" style="display: none;"/>
                            </div>
                            <select id="select_topic">
                                <option disabled selected>select topic</option>
                                <option value="Matemtika 2">Matemtika 2</option>
                                <option value="Makijeva predavanja">Makijeva predavanja</option>
                                <option value="Programiranje">Programiranje</option>
                                <option value="add_topic" id="add_topic">add topic...</option>
                            </select>
                            <input type="text" id="new_topic" value="new topic" />

                            <div id="uokvireno"></div><br>
                            <input id="tagovi" type="text" name="tagovi" value="tags"/>
                            <div id="uokvirenofajl"></div><br/>
                            <input id="fajlovi" type="text" name="fajlovi" value="url predavanja"/>
                              <div class="hover addnew">Add</div>
                            </div>
                            <div id="lista_taskova_boki">
                            lista
                            <div id="hovertext"></div>
                            <li  class="date_of_activity">Petak 26 09 2014</li>
                            <div class="hovertextlist" hovertext="Makijeva predavanja">
                            <li  class="list hover "  >
                                <table >
                                    <tr>
                                        <td style="background-color: aquamarine;">14:30 13:43</td>
                                        <td >  Igram kosarku i volim da se druzim i cevapi.</td>
                                        <td ><div style="display: none;">dsdsfsdfssdf</div> <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                            </div>
                             <div class="hovertextlist" hovertext="Krca 2">
                            <li  class="list hover">
                                <table >
                                    <tr>
                                        <td style="background-color: green;">14:30 13:43</td>
                                        <td >  Igram kosarku i volim dsdfsd ffsfsf sfsdf sfsdfsdfsdfs dfsdfsd gfgds gdfg dfgdgd gdg dfgdgd fgd gdfga se druzim i cevapi.</td>
                                        <td > <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                             </div>
                             <div class="hovertextlist" hovertext="Algebra">
                            <li  class="list hover">
                                <table >
                                    <tr>
                                        <td style="background-color: blue;">14:30 13:43</td>
                                        <td >  Igram kosarku i volim da se druzim i cevapi.</td>
                                        <td > <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                             </div>
                             <div class="hovertextlist" hovertext="Jumbova predavanja">
                            <li  class="list hover">
                                <table >
                                    <tr>
                                        <td style="background-color: blueviolet;">14:30 13:43</td>
                                        <td >  Igram kosarku i volim da se druzim i cevapi.</td>
                                        <td > <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                             </div>
                            <li  class="date_of_activity">Subota 27 09 2014</li>
                            <li  class="list hover">
                                <table >
                                    <tr>
                                        <td >14:30 13:43</td>
                                        <td >  Igram kosarku i volim da se druzim i cevapi.</td>
                                        <td > <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                            <li  class="list hover">
                                <table >
                                    <tr>
                                        <td >14:30 13:43</td>
                                        <td >  Igram kosarku i volim da se druzim i cevapi.</td>
                                        <td > <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                            <li  class="list hover">
                                <table >
                                    <tr>
                                        <td >14:30 13:43</td>
                                        <td >  Igram kosarku i volim da se druzim i cevapi.</td>
                                        <td > <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                            <li  class="date_of_activity">Nedelja 27 09 2014</li>
                            <li  class="list hover">
                                <table >
                                    <tr>
                                        <td >14:30 13:43</td>
                                        <td >  Igram kosarku i volim da se druzim i cevapi.</td>
                                        <td > <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                            <li  class="list hover">
                                <table >
                                    <tr>
                                        <td >14:30 13:43</td>
                                        <td >  Igram kosarku i volim da se druzim i cevapi.</td>
                                        <td > <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                            <li  class="list hover">
                                <table >
                                    <tr>
                                        <td >14:30 13:43</td>
                                        <td >  Igram kosarku i volim da se druzim i cevapi.</td>
                                        <td > <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                            <li  class="list hover">
                                <table >
                                    <tr>
                                        <td >14:30 13:43</td>
                                        <td >  Igram kosarku i volim da se druzim i cevapi.</td>
                                        <td > <a class="closea">×</a></td>
                                    </tr>
                                </table>
                            </li>
                        </ul>
                        </div>-->
<!--                    </div>-->

<!--RECOMMENDATIONS-->
                    <div class="hidden menu_recomende">

                        <ul>
                            <?php
                            
                                $sql="SELECT
                                        u.username, 
                                        u.slika_url as slika_url,
                                        u.skype as skype,
                                        u.facebook as facebook,
                                        u.google as google,
                                        u.email as email,
                                        g.grad as grad, 
                                        d.drzava as drzava, 
                                        COUNT(t.tag) AS dobar
                                       FROM
                                        user u, aktivnost a, tag t, aktivnost_tag at, grad g, drzava d
                                       WHERE
                                        u.username = a.user_id
                                        AND a.id = at.aktivnost_id
                                        AND at.tag_id = t.id
                                        AND u.grad_id = g.id
                                        AND g.drzava_id = d.id
                                        AND t.id IN(
                                         SELECT
                                          t.id
                                         FROM
                                          user u, aktivnost a, tag t, aktivnost_tag at
                                         WHERE
                                          u.username = '$username'
                                          AND u.username = a.user_id
                                          AND a.id = at.aktivnost_id
                                          AND at.tag_id = t.id
                                         )
                                        AND u.username NOT IN(
                                         SELECT
                                          user_id_2
                                         FROM
                                          prati p
                                         WHERE 
                                          user_id_1 = '$username'
                                        )
                                       GROUP BY
                                        1
                                       ORDER BY
                                        dobar DESC
                                       LIMIT
                                        1,5";
                               $kveri=  mysql_query($sql);
                               while ($row=  mysql_fetch_assoc($kveri)){
                                   $res="<li  class='list hover prijatelji' ><div id='recomended_friend'><img id='slika_prijatelj' src='".$row["slika_url"]."'/>";
                                        $res.="<p id='ime_prijatelja'>".$row["username"]."</p>  <br/><p id='email_prijatelja'>email: ";
                                        $res.=$row["email"]."</p><br><p id='skype_prijatelja'>skype: ".$row["skype"]."</p><br>";
                                        $res.="<a id='facebook_link' href='".$row["facebook"]."' target='_blank'><div style=";
                                        $res.='"'."background-image: url('images/icons/icon_facebook_small.png');".'"';
                                        $res.="id='facebok_button' class='hover'> </div></a><a id='google_plus_link' href='";
                                        $res.=$row["google"]."' target='_blank'><div style=".'"'."background-image: url('images/icons/google_icon_small.png');".'"';
                                        $res.=" id='google_button' class='hover'> </div></a><button id='follow' type='button'>Follow</button></div>";
                                        echo $res;
                               }
                            
                            ?>
                            
<!--                            <li  class='list hover prijatelji' >
                             <div id='recomended_friend'>
                                <img id="slika_prijatelj" src="images/users_profile_images/MninawaNtloko_PROFILE.png"/>
                                <p id="ime_prijatelja">Nikola</p>  <br/>
                                <p id="email_prijatelja">email: nikolastevanovic92@gmail.com</p><br>
                                <p id="skype_prijatelja">skype: nik.92s</p><br>
                                <a id="facebook_link" href="https://www.facebook.com/nikolamufc" target="_blank"><div style="background-image: url('images/icons/icon_facebook_small.png');" id="facebok_button" class="hover"> </div></a>
                                <a id="google_plus_link" href="https://plus.google.com/+NikolaStevanović" target="_blank"><div style="background-image: url('images/icons/google_icon_small.png');" id="google_button" class="hover"> </div></a>
                                 <button id='follow' type='button'>Follow</button>
                                </div>-->
                            
                            
<!--                            <li  class="list hover"> <img src="images/users_profile_images/billclinton.jpg"/>Pera  <a class="close">×</a></li>
                            <li  class="list hover"> <img src="images/users_profile_images/hau_profile.jpg"/>Nemca  <a class="close">×</a></li>
                            <li  class="list hover"> <img src="images/users_profile_images/picture-422339-1402100369.jpg"/>Nikola  <a class="close">×</a></li>-->

                        </ul>

                    </div>


 <!--ACTIVITIES LIST-->
     <div class="hidden activities">
                        <ul>
                            <!--add new activity-->
                           
                            <div  class="hover " id="add_new_slide_down">Add new...</div>
                             <div id="add_new_activity">
                            <textarea id="text_aktivnosti"  >activity text</textarea>
<!--                            <select id="select_topic">
                                <option disabled selected>select topic</option>
                                <option value="Matemtika 2">Matemtika 2</option>
                                <option value="Makijeva predavanja">Makijeva predavanja</option>
                                <option value="Programiranje">Programiranje</option>
                                <option value="add_topic" id="add_topic">add topic...</option>
                            </select>-->
                            <div id="basicExample" >                                
                            <select id="select_topic" name='topic'>
                                <option disabled selected value=''>select topic</option>
                                <?php
                                      require './php/db_connection.php';
                                      $sql="SELECT topic FROM topic WHERE user_id='$username'";
                                      $kveri=  mysql_query($sql);
                                      while($row=  mysql_fetch_assoc($kveri)){
                                          $res="<option value='".$row["topic"]."'>".$row["topic"]."</option>";
                                          echo $res;
                                      }
                                      
                                ?>
                                <option value="add_topic" id="add_topic">add topic...</option>
                            </select>
                                <input type="text" class="piker date start" value="date start"/>
                                <input type="text" class="piker time start" value="time start" /><span class="to">to</span>
                                <input type="text" class="piker time end" value="time end" />
                                <input type="text" class="piker date end" style="display: none;"/>
                            </div>
<!--                            <select id="select_topic">
                                <option disabled selected>select topic</option>
                                <option value="Matemtika 2">Matemtika 2</option>
                                <option value="Makijeva predavanja">Makijeva predavanja</option>
                                <option value="Programiranje">Programiranje</option>
                                <option value="add_topic" id="add_topic">add topic...</option>
                            </select>-->
                            <input type="text" id="new_topic" value="new topic" />

                            <div id="uokvireno"></div><br>
                            <input id="tagovi" type="text" name="tagovi" value="tags"/>
                            <div id="uokvirenofajl"></div><br/>
                            <input id="fajlovi_luka" type="text" name="fajlovi" value="url predavanja"/>
                              <div class="hover addnew">Add</div>
                            </div>
                            
                            
                            
                            <div id="lista_taskova_boki">
                            <!--lista-->
                            <div id="hovertext"></div>
                            
                            
                            <?php
                                function rgbcode($id){
                                    return '#'.substr(md5($id), 0, 6);
                                }
                                $sql="SELECT pocetni_datum, krajnji_datum, tekst, id ,topic_id 
                                        FROM aktivnost
                                        WHERE user_id='$username' AND ((krajnji_datum>NOW() AND flag = 0) OR(krajnji_datum<=NOW() AND flag=0))
                                        ORDER BY krajnji_datum;";
                                $kveri=  mysql_query($sql);
                                $datum="hhahaha";
                                while($row=  mysql_fetch_assoc($kveri)){
                                    $niz=explode(" ",$row["pocetni_datum"]);
                                    $datum_new=$niz[0];
                                    $datum1= new DateTime($row["pocetni_datum"]);
                                    $dstamp=$datum1->getTimestamp();
                                    if($datum!==$datum_new){
                                        $datum=$datum_new;
                                        $res="<li  class='date_of_activity'>";
                                        $res.= date("l d F Y", $dstamp);
                                        $res.="</li>";
                                        echo $res;
                                    }
                                    $res="<div class='hovertextlist' hovertext='";
                                    if($row["topic_id"]!==NULL){
                                        $sql7="SELECT topic FROM topic WHERE id=".$row["topic_id"];
                                        $kveri7=  mysql_query($sql7);
                                        if($row7=  mysql_fetch_assoc($kveri7)){
                                            $res.=$row7["topic"];
                                        }else{
                                            $res.="Default";
                                        }
                                    }else{
                                        $res.="Default";
                                    }
                                    $res.="'><li  class='list hover '  ><table id='luka_tabela'>";
                                    $res.="<tr><td id='boje' style='border-color: ".  rgbcode($row["topic_id"]).";'>";
                                    $res.=date("G:i", $dstamp)." - ";
                                    $datum2= new DateTime($row["krajnji_datum"]);
                                    $dstamp2=$datum2->getTimestamp();
                                    $res.=date("G:i", $dstamp2)."</td><td id='luka_td_aktivnost'>";
                                    $res.=$row["tekst"]."</td><td id='luka_td_check'><div style='display: none;'>Stevanovicu trebo div</div> <input class='wtfxd' id='luka_check' type='checkbox'/></td>";
                                    $res.="<td id='luka_td_x'><div id='sk_div' style='display: none;'>".$row["id"]."</div> <a id='luka_margina' class='closea'>×</a></td>";
                                    $res.="</tr></table></li></div>";
                                    echo $res;
                                    
                                }
                            
                            ?>
<!--                            <li  class='date_of_activity'>Petak 26 09 2014</li>
                            
                            
                            <div class='hovertextlist' hovertext='Makijeva predavanja'>
                            <li  class='list hover '  >
                                <table id='luka_tabela'>
                                    <tr>
                                        <td style='background-color: aquamarine;'>14:30 - 13:43</td>
                                        <td id='luka_td_aktivnost'>  Igram kosarku i volim da se druzim i cevapi. I pivo i rakija naravno domaca
                                        i sok i tako to</td>
                                        <td id='luka_td_check'><div style='display: none;'>Stevanovicu trebo div</div> <input id='luka_check' type='checkbox'/></td>
                                        <td id='luka_td_x'><div style='display: none;'>dsdsfsdfssdf</div> <a id='luka_margina' class='closea'>×</a></td>
                                    </tr>
                                </table>
                            </li>
                            </div>-->
                            
                      
                        
                        </ul>
                        </div>
     <!--kraj activities-->

                    <!--STATS LIST-->
                    <div id="topic_stats_button">Topic stats</div>
                    
                     <div class=" topic_stats hidden_topics">
                         <?php
                            $sql="SELECT t.topic,
                            ROUND(
                            SUM(CASE WHEN a.flag = 1 THEN a.krajnji_datum - pocetni_datum ELSE 0 END)/
                            SUM(a.krajnji_datum - pocetni_datum) * 100) AS posto
                           FROM
                            user u, topic t, aktivnost a
                           WHERE
                            u.username = '$username'
                            AND t.user_id = u.username
                            AND a.topic_id = t.id
                           GROUP BY 1
                           ORDER BY posto DESC
                           LIMIT 0,4";
                           $kveri=  mysql_query($sql);
                           $i=1;
                           while($row=  mysql_fetch_assoc($kveri)){
                               $brojx=ceil($row['posto']*100)/100;
                               $res="<div  class='list'>    <div id='bar1' class='progressbar1".$i.
                                        "' progress='".$row["posto"]."' name='".$row["topic"]." ".$brojx.
                                        "%'  color='";
                                switch ($i) {
                                    case 1: $res.="#161616";
                                        break;
                                    case 2: $res.="#161616";
                                            break;
                                    case 3: $res.="#161616";
                                            break;
                                    case 4: $res.="#161616";
                                            break;
                                    default: $res.="#161616";
                                        break;
                                }
                                $res.="'></div> </div>";
                                echo $res;
                                $i++;
                           }
                         ?>
<!--                        <div  class="list">    <div id="bar1" class="progressbar11" progress="50" name="Matematika 50%" color="red"></div> </div>
                        <div  class="list">    <div id="bar1" class="progressbar12" progress="20" name="Programiranje 20%" color="blue"></div> </div>
                        <div  class="list">    <div id="bar1" class="progressbar13" progress="20" name="Makijevi predmeti 20%" color="green"></div> </div>
                        <div  class="list">    <div id="bar1" class="progressbar14" progress="8" name="Mancev predavanja 8%" color="#800000"></div> </div>
                        <div  class="list">    <div id="bar1" class="progressbar15" progress="2" name="Ostalo 2%" color="black"></div> </div>-->
                    </div>
                    <div class="hidden stats">
                        <?php
                            $sql="SELECT tag, sum(UNIX_TIMESTAMP(krajnji_datum)-UNIX_TIMESTAMP(pocetni_datum)) as trajanje, round(
                            sum(UNIX_TIMESTAMP(krajnji_datum)-UNIX_TIMESTAMP(pocetni_datum))/(
                            SELECT SUM( (UNIX_TIMESTAMP( krajnji_datum ) - UNIX_TIMESTAMP( pocetni_datum ))  * ( 
                            SELECT COUNT( * ) 
                            FROM aktivnost_tag
                            WHERE aktivnost_id = id ) )
                            FROM aktivnost
                            WHERE user_id =  '$username'
                            )*100,2) as posto 
                            FROM aktivnost,tag,aktivnost_tag WHERE user_id='$username' AND aktivnost.id=aktivnost_id AND tag.id=tag_id
                            GROUP BY tag
                            ORDER BY trajanje DESC
                            LIMIT 0,4;";
                            $kveri=  mysql_query($sql);
                            $i=1;
                            $sum=0;
                            $sump=0;
                            while($row= mysql_fetch_assoc($kveri)){
                                $time=$row["trajanje"];
                                $sati=(int)($time / 3600);
                                $minuti= (int)($time / 60);
                                $minuti-=$sati*60;
                                $res="<div  class='list'>    <div id='bar' class='progressbar".$i.
                                        "' progress='".$row["posto"]."' name='".$row["tag"].
                                        " ".$sati."h ".$minuti."m"."' color='";
                                switch ($i) {
                                    case 1: $res.="#161616";
                                        break;
                                    case 2: $res.="#161616";
                                            break;
                                    case 3: $res.="#161616";
                                            break;
                                    case 4: $res.="#161616";
                                            break;
                                    default: $res.="#161616";
                                        break;
                                }
                                $res.="'></div> </div>";
                                echo $res;
                                $sump+=$row["posto"];
                                $sum+=$time;
                                $i++;
                            }
                            $sql="SELECT sum(UNIX_TIMESTAMP(krajnji_datum)-UNIX_TIMESTAMP(pocetni_datum)) AS ukupno
                                FROM aktivnost, aktivnost_tag, tag
                                WHERE user_id='$username' AND aktivnost_id=aktivnost.id AND tag_id=tag.id";
                            $kveri=  mysql_query($sql);
                            $ostalo=0;
                            if($row=  mysql_fetch_assoc($kveri)){
                                $ostalo=$row["ukupno"];
                            }
                            $ostalo-=$sum;
                            $osati=(int)($ostalo / 3600);
                            $ominuti= (int)($ostalo / 60);
                            $ominuti-=$osati*60;
                        
                        ?>
                        <div  class="list">    <div id="bar" class="progressbar5" progress="<?php echo 100-$sump; ?>" name="Ostalo <?php echo $osati."h ".$ominuti."m" ?>" color="black"></div> </div>
<!--                        <div  class="list">    <div id="bar" class="progressbar1" progress="50" name="Linearna 45h 34min" color="red"></div> </div>
                        <div  class="list">    <div id="bar" class="progressbar2" progress="20" name="DAA 30h 23min" color="blue"></div> </div>
                        <div  class="list">    <div id="bar" class="progressbar3" progress="20" name="OOP 15h" color="green"></div> </div>
                        <div  class="list">    <div id="bar" class="progressbar4" progress="8" name="Cevapi 5h" color="#800000"></div> </div>
                        <div  class="list">    <div id="bar" class="progressbar5" progress="2" name="Ostalo 3h" color="black"></div> </div>-->
                    </div>





                </article>
            </section>
        </div>
    </body>
</html>
