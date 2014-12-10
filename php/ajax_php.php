<?php



function search_people(){
        require './db_connection.php';
        session_start();
        $username=mysql_real_escape_string($_SESSION['username']);
        if(isset($_POST["user_name"]) && isset($_POST["drzava"]) && isset($_POST["grad"])
                && isset($_POST["fakultet"]) && isset($_POST["tags"]) && isset($_SESSION["username"])){
            $username=  mysql_real_escape_string($_SESSION["username"]);
            $s_username= mysql_real_escape_string($_POST["user_name"]);
            $s_drzava= mysql_real_escape_string($_POST["drzava"]);
            $s_grad= mysql_real_escape_string($_POST["grad"]);
            $s_tags= mysql_real_escape_string($_POST["tags"]);
            $s_fakultet=  mysql_real_escape_string($_POST["fakultet"]);
            $tagovi= explode(";", $s_tags);
            $sql="SELECT username , slika_url, grad, drzava, fakultet, count(tag) AS dobar
                FROM user,grad,drzava,fakultet,tag,aktivnost_tag,aktivnost
                WHERE  grad_id=grad.id AND grad.drzava_id=drzava.id AND user.fakultet_id=fakultet.id AND aktivnost.
                user_id=username AND aktivnost_id=aktivnost.id AND tag.id=tag_id ";
            $tmp_sql="SELECT id FROM grad WHERE grad='$s_grad'";
            $tmp_kveri=  mysql_query($tmp_sql);
            if($row=  mysql_fetch_assoc($tmp_kveri)){
                $sql.=" AND grad_id=".$row["id"]." ";
            }
            $tmp_sql="SELECT id FROM drzava WHERE drzava='$s_drzava'";
            $tmp_kveri=  mysql_query($tmp_sql);
            if($row=  mysql_fetch_assoc($tmp_kveri)){
                $sql.=" AND drzava.id=".$row["id"]." ";
            }
            
          
            
            $tmp_sql="SELECT id FROM fakultet WHERE fakultet='$s_fakultet'";
            $tmp_kveri=  mysql_query($tmp_sql);
            if($row=  mysql_fetch_assoc($tmp_kveri)){
                $sql.=" AND fakultet.id=".$row["id"]." ";
            }
            
     
            
            if($s_username!=='' && $s_username!=='username'){
                $sql.=" AND username LIKE '%".$s_username."%' ";
            }
            if(count($tagovi)!==0){
               $sql2="SELECT id FROM tag WHERE ";
               $i=0;
               foreach ($tagovi as $tagp) {
                   $tag=  mysql_real_escape_string($tagp);
                   if($tag!==''){
                    if($i===0){
                        $sql2.="tag='".$tag."'";
                    }else{
                        $sql2.=" OR tag='".$tag."'";
                    }
                    $i++;
                   }
               }
               if($i!==0){
                    //echo $sql2."<br>";
                    $kveri2=  mysql_query($sql2);
                    $num=0;
                    while ($row=  mysql_fetch_assoc($kveri2)){
                        if($num===0){
                            $sql.="AND (";
                            $sql.=" tag.id=".$row["id"]." ";
                        }else{

                            $sql.=" OR tag.id= ".$row["id"]." ";
                        }

                        $num++;
                    }
                    if($num!==0) $sql.=") ";
               
               }
            }
            $sql.=" AND username NOT in (select user_id_2 FROM prati WHERE user_id_1='$username') AND username !='$username'
                GROUP BY username
                ORDER BY dobar DESC
                LIMIT 0,10;";
            //echo $sql;
            $kveri=  mysql_query($sql);
            while($row=  mysql_fetch_assoc($kveri)){
                
               $out=" <div id='people'>
                    <div id='user_data_search'>

                        <img id='user_img_search' src='".$row["slika_url"]."' alt='slika'/>
                        <div id='podaci'>
                            <h2 id='username_search'>".$row["username"]."</h2>
                            <p id='place1'>Drzava: ".$row["drzava"]."</p>
                            <p id='place2'>Grad: ".$row["grad"]."</p>
                            <p id='place3'>Fakultet: ".$row["fakultet"]."</p>
                        </div>
                        <div id='razni_podaci'>";
                 $sql3="SELECT tag, count(tag.id)  as uk
                        FROM user, aktivnost, aktivnost_tag, tag
                        WHERE username='".$row["username"]."' AND username=aktivnost.user_id AND aktivnost.id=aktivnost_id AND tag.id=tag_id
                        GROUP BY tag
                        ORDER BY uk DESC
                        LIMIT 0,4;"; 
                 $kveri3=  mysql_query($sql3);
                 while ($row2=  mysql_fetch_assoc($kveri3)){
                     $out.="<span id='tag_sp_search'>".$row2["tag"]."</span>";
                 }
                 $out.=  "<button id='follow' type='button'>Follow</button>

                 </div>
                    </div>
                </div>";
                 echo $out; 
            }
        }
    }

    function dodaj_prijatelja(){
        session_start();
        if(isset($_SESSION['username']) && isset($_POST['friend_id'])){
            require './db_connection.php';
            $un=  mysql_real_escape_string($_SESSION['username']);
            $fr= mysql_real_escape_string($_POST['friend_id']);
            $sql="SELECT COUNT(*) AS broj FROM prati WHERE user_id_1='$un' AND user_id_2='$fr'";
            $kveri= mysql_query($sql);
            if($row=  mysql_fetch_assoc($kveri)){
                if ($row["broj"]==='0'){
                    $sql2="INSERT INTO prati VALUES ('$un','$fr')";
                    $kveri2=  mysql_query($sql2);
                    echo "1";
                }
            }
           
        }else{
            echo "0";
        }
    }
    function remove_friend(){
        session_start();
        if(isset($_SESSION['username']) && isset($_POST['friend_id'])){
            require './db_connection.php';
            $un=  mysql_real_escape_string($_SESSION['username']);
            $fr= mysql_real_escape_string($_POST['friend_id']);
            $sql="DELETE FROM prati WHERE user_id_1='$un' AND user_id_2='$fr'";
            $kveri=  mysql_query($sql);   
        }
    }
    function mysql_date($d,$t){
        $niz=explode("/",$d);
        $res=$niz[2]."-".$niz[0]."-".$niz[1]." ";
        $niz=explode(":",$t);
        $h=(int) $niz[0];
        if (strpos($t,'pm') !== false) {
             echo $h+=12;
        }
        $m=substr($niz[1],0,2);
        $res.=$h.":".$m.":00";
        return $res;
    }
    function add_activity(){
        session_start();
        require './db_connection.php';
        
        if(isset($_SESSION['username']) && isset($_POST['activity_text']) && isset($_POST["topic"])
                && isset($_POST["date"]) && isset($_POST["time_start"]) && isset($_POST["time_end"])
                && isset($_POST["tags"]) && isset($_POST["urls"]) ){
           
            require './db_connection.php';
            $un=  mysql_real_escape_string($_SESSION['username']);
            $aktiviti_test= mysql_real_escape_string($_POST['activity_text']);
            $topic= mysql_real_escape_string($_POST["topic"]);
            $date= mysql_real_escape_string($_POST["date"]);
            $time_start= mysql_real_escape_string($_POST["time_start"]);
            $time_end= mysql_real_escape_string($_POST["time_end"]);
            $tags= mysql_real_escape_string($_POST["tags"]);
            $urls= mysql_real_escape_string($_POST["urls"]);
            if($aktiviti_test==='activity text' && $topic==='' || $date==='date start' || $time_start==='time start' || $time_end==='time end'){
                echo '0';exit();
            }
            if(strtotime(mysql_date($date, $time_start)) >= strtotime(mysql_date($date, $time_end))){
                //echo '0';exit();
            }
           $sql="SELECT (count(topic)) as broj FROM topic WHERE topic='$topic'";
           $kveri=  mysql_query($sql);
           if($row=  mysql_fetch_assoc($kveri)){
               if($row["broj"]==0){
                   $sql2="INSERT INTO topic(topic) VALUES ('$topic')";
               }
           }
           $topic_id="";
           $sql="SELECT id FROM topic WHERE topic='$topic'";
           $kveri=  mysql_query($sql);
           if($row=  mysql_fetch_assoc($kveri)){
               $topic_id=$row["id"];
           }
           $next_id="1";
           $sql="SHOW TABLE STATUS WHERE name = 'aktivnost'";
           $kveri= mysql_query($sql);
           if($row=  mysql_fetch_assoc($kveri)){
               $next_id=$row["Auto_increment"];
           }
           $pd= mysql_date($date, $time_start);
           $kd= mysql_date($date, $time_end);
           //echo $pd;
           $sql="INSERT INTO aktivnost(user_id,datum_objave,pocetni_datum,krajnji_datum,tekst,topic_id,flag) VALUES ";
           $sql.="('$un','".date("Y-m-d H:i:s")."','$pd','$kd','$aktiviti_test','$topic_id','0')";
           echo '1';
           //echo $sql;
           $kveri=  mysql_query($sql);
          // echo mysql_date($date, $time_start);
           $niz_tagova=explode(";",$tags);
           foreach ($niz_tagova as $tag) {
               $sql="SELECT count(*) AS broj FROM tag WHERE tag='$tag'";
               $kveri=  mysql_query($sql);
               if($row=  mysql_fetch_assoc($kveri)){
                   if($row["broj"]==0 && $tag!==''){
                       $sql2="INSERT INTO tag(tag) VALUES ('$tag')";
                       //echo $sql2;
                       $kveri2=  mysql_query($sql2);
                   }
               }
               $sql7="SELECT id FROM tag WHERE tag='$tag'";
               //echo $sql7;
               $kveri1= mysql_query($sql7);
               if($row4= mysql_fetch_assoc($kveri1)){
                   if($tag!==''){
                       // echo "ha".$row4["id"]."ha";
                        $sql3="INSERT INTO aktivnost_tag VALUES ('$next_id','".$row4["id"]."')";
                       // echo $sql3;
                        $kveri3=  mysql_query($sql3);
                   }
               }
           }
           
           $niz_url=explode(";",$urls);
           foreach ($niz_url as $fajl) {
               $sql="SELECT count(*) AS broj FROM fajl WHERE fajl='$fajl'";
               $kveri=  mysql_query($sql);
               if($row=  mysql_fetch_assoc($kveri)){
                   if($row["broj"]==0 && $fajl!==''){
                       $sql2="INSERT INTO fajl(fajl) VALUES ('$fajl')";
                       $kveri2=  mysql_query($sql2);
                   }
               }
               $sql="SELECT id FROM fajl WHERE fajl='$fajl'";
               $kveri=  mysql_query($sql);
               if($row=  mysql_fetch_assoc($kveri)){
                   if ($fajl!==''){
                        $sql3="INSERT INTO aktivnost_fajl VALUES ('$next_id','".$row["id"]."')";
                        $kveri3=  mysql_query($sql3);
                   }
               }
           }
           
        }
    }
    function add_topic(){
        session_start();
        require './db_connection.php';
        
        if(isset($_SESSION['username']) && isset($_POST['topic'])){
            $user=  mysql_real_escape_string($_SESSION['username']);
            $topic= mysql_real_escape_string($_POST['topic']);
            echo "1";
            if($topic!==''){
                echo "2";
                $sql="SELECT count(*) as broj FROM topic WHERE topic='$topic'";
                $kveri=  mysql_query($sql);
                if($row=  mysql_fetch_assoc($kveri)){
                    echo "3";
                    if($row['broj']==0){
                        echo "4";
                        $sql2="INSERT INTO topic(topic,user_id) VALUES('$topic','$user')";
                        $kveri2=  mysql_query($sql2);
                    }
                }
            }
        }
    }
    function remove_activity(){
        session_start();
        require './db_connection.php';
        
        if(isset($_SESSION['username']) && isset($_POST['id'])){
            $user=  mysql_real_escape_string($_SESSION['username']);
            $id= mysql_real_escape_string($_POST['id']);
            $sql="UPDATE aktivnost SET flag=-1 WHERE id='$id' AND krajnji_datum<NOW()";
            mysql_query($sql);
            $sql="DELETE FROM aktivnost WHERE id='$id' AND krajnji_datum>NOW()";
            mysql_query($sql);
        }
    }
    function finish_activity(){
        session_start();
        require './db_connection.php';
        if(isset($_SESSION['username']) && isset($_POST['id'])){
            $user=  mysql_real_escape_string($_SESSION['username']);
            $id= mysql_real_escape_string($_POST['id']);
            $sql="UPDATE aktivnost SET flag=1 WHERE id='$id'";
            mysql_query($sql);
        }
    }
    if (isset($_POST['upit']) && !empty($_POST['upit'])) {
        $action = $_POST['upit'];
        switch ($action) {
            case 'dodaj_prijatelja' : dodaj_prijatelja();
                break;
            case 'search_people' : search_people();
                break;
            case 'remove_friend' : remove_friend();
                break;
            case 'add_activity' : add_activity();
                break;
            case 'add_topic': add_topic();
                break;
            case 'remove_activity':remove_activity();
                break;
            case 'finish_activity':finish_activity();
                break;
        
        }
    }


?>