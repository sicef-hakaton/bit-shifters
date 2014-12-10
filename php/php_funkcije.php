<?php
    function digit_character_underscoreQ($s){
        if (!preg_match('/[^a-z_0-9]/i',$s)==1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function string_lengthQ($str,$minimum,$maksimum){
	if (strlen($str)>=$minimum && strlen($str)<=$maksimum)
		return TRUE;
        else
		return FALSE;
    }
    function emailQ($s){
        if(!filter_var($s, FILTER_VALIDATE_EMAIL)) {
            return FALSE;
	}else{
            return TRUE;
        }
    }
    function imageQ($fajl){
        $image = getimagesize($fajl) ? true : false;
        return $image;
    }
    function drzave( $drzava){
        require 'db_connection.php';
        $sql = "SELECT drzava "
        . "FROM drzava "
        . "ORDER BY drzava ASC";
        $kveri=mysql_query($sql);
        $res="";
	while($red=  mysql_fetch_assoc($kveri)){
            if($red["drzava"]==$drzava){
                $res.="<option selected='selected'>".$red["drzava"]."</option>";
            }else{
                $res.="<option>".$red["drzava"]."</option>";
            }
        }
        echo $res;
    }
    function gradovi($grad, $drzava='Srbija'){
        require 'db_connection.php';
        //$drzavaSQL=  mysql_escape_string($drzava);
        $sql = "SELECT grad "
        . "FROM grad,drzava "
        . "WHERE grad.drzava_id=drzava.id AND drzava.id='1' "
        . "ORDER BY grad ASC";
        $kveri=mysql_query($sql);
        $res="";
	while($red=  mysql_fetch_assoc($kveri)){
            if($red["grad"]==$grad){
                $res.="<option selected='selected'>".$red["grad"]."</option>";
            }else{
                $res.="<option>".$red["grad"]."</option>";
            }
        }
        echo $res;
    }
    function fakulteti($fakultet){
        require 'db_connection.php';
        $sql = "SELECT f.fakultet
                FROM fakultet f
               ORDER BY 1";
        $kveri=mysql_query($sql);
        $res="";
	while($red=  mysql_fetch_assoc($kveri)){
            if($red["fakultet"]==$fakultet){
                $res.="<option selected='selected'>".$red["fakultet"]."</option>";
            }else{
                $res.="<option>".$red["fakultet"]."</option>";
            }
        }
        echo $res;
    }
    
?>