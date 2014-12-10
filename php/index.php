<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//        $niz=explode("/",$str);
//        $res=$niz[2]."-".$niz[1]."-".$niz[0]." ";
//        $niz=explode(".",$t);
//        $h=(int) $niz[0];
//        if (strpos($t,'pm') !== false) {
//             echo $h+=12;
//        }
//        $m=substr($niz[1],0,2);
//        $res.=$h.":".$m.":00";
//        //return $res;
        $date = new DateTime('2014-04-04 16:00:00');
        echo $date->getTimestamp();
?>