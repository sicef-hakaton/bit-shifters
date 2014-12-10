/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    var nizTagova = [];
    var index = 0;

$(document).ready(function (){
    
    $('#user_name_search').focusin(function (){
        if($(this).val() === 'username')
            $(this).val('');
    });
    $('#user_name_search').blur(function (){
        if ($(this).val() === '')
            $(this).val('username');
    });
    
    

    
    $('#tagovi').focusin(function (){
        if($(this).val() === 'tags')
            $(this).val('');
    });
    $('#tagovi').blur(function (){
        if ($(this).val() === '')
            $(this).val('tags');
    });
    
//    animacije za dugmice begin

    $('#back').mouseover(function (){
        $(this).css('background-color', '#B8B8B8');
//        $(this).css('color', '#4B4B4B');
    });
    
    $('#back').mouseout(function (){
        $(this).css('background-color', '#FF944D');
//        $(this).css('color', 'dodgerblue');
    });
    
    $('#back').mousedown(function (){
        $(this).css('background-color', 'white');
//        $(this).css('color', 'white');
    });

    $('#back').mouseup(function (){
        $(this).css('background-color', '#FF944D');
//        $(this).css('color', 'dodgerblue');
    });

//    dodavanje efekta za sve dugmice isto id-a
//    $('[id^=follow]').mouseover(function (){
//        $(this).css('background-color', '#B8B8B8');
////        $(this).css('color', 'white');
//    });
//    
//    $('[id^=follow]').mouseout(function (){
//        $(this).css('background-color', '#FF944D');
//        $(this).css('color', 'white');
//    });
//    
//    $('[id^=follow]').mousedown(function (){
//        $(this).css('background-color', 'white');
//        $(this).css('color', 'black');
//    });
//    
//    $('[id^=follow]').mouseup(function (){
//        $(this).css('background-color', '#FF944D');
//        $(this).css('color', 'white');
//    });

//    $('[id^=follow]').click(function (){
//        $(this).parent().parent().hide();
//    });


//    animacije za dugmice end
    
//    dodavanje tagova u div
    $('#tagovi').keypress(function(event){
        if(event.which === 32 && $.trim($(this).val()) !== ''){
            var tag = $.trim($(this).val());
            $('#uokvireno').append("<span class='tag_add' id="+ index +">" + tag + "<a href='#' class='close'>×</a></span>" );
            $(this).val('');
            nizTagova.push(tag);
            console.log('ispis niza nakon dodavanja:');
            for ( var i = 0; i < nizTagova.length; i = i + 1 ) {
                console.log( nizTagova[ i ] );
            }
            index++;

        }
    });
    
//    funkcija koja vraca string sa tagovima    
    function get_string_tagovi(){
        tg = '';
        for ( var i = 0; i < nizTagova.length; i = i + 1 ) {
            tg += nizTagova[ i ] + ';';
        }
        return tg;
    }

    
//    submit forme
    $('#piple_form').submit(function (e){
        e.preventDefault();
//        get_string_tagovi();
        tgs = get_string_tagovi();
        console.log(tgs);
        var loc=window.location.href.replace('search_people.php','php/ajax_php.php');
        var values = $(this).serialize();
        values=values+"&upit=search_people&tags="+tgs;
        console.log(loc);
        console.log(values);
        $.ajax({
            url: loc,
            type: 'POST',
            data: values,
            success: function (data) {
                $('#search_results').html(data);
            }
        });
    });
    
});

//dodavanje click listenera na dinamicki dodati element za brisanje taga
$(document).on("click", ".close", function(){
    $(this).parent().hide();
    id = $(this).parent().text();
    id1 = id.substring(0,id.length - 1);
    console.log(id1);
    nizTagova.splice( $.inArray(id1, nizTagova), 1 );
    index--;
    console.log('ispis niza nakon brisanja:');
    for ( var i = 0; i < nizTagova.length; i = i + 1 ) {
        console.log( nizTagova[ i ] );
    }

});
$(document).on("mouseover", "#follow", function (){
    $(this).css('background-color', '#B8B8B8');
});
$(document).on("mouseout", "#follow", function (){
    $(this).css('background-color', '#FF944D');
    $(this).css('color', 'white');
});
$(document).on("mousedown", "#follow", function (){
    $(this).css('background-color', 'white');
    $(this).css('color', 'black');
});
$(document).on("mouseup", "#follow", function (){
    $(this).css('background-color', '#FF944D');
    $(this).css('color', 'white');
});

$(document).on("click", "#follow", function(){
    var t=this;
    //$(this).parent().parent().hide();
    
    var user=$(this).parent().parent().children('#podaci').children('#username_search').text();
    console.log(user);
    var loc=window.location.href.replace('search_people.php','php/ajax_php.php');
    var values="upit=dodaj_prijatelja&friend_id="+user;
    $.ajax({
            url: loc,
            type: 'POST',
            data: values,
            success: function (data) {
                if(data==='1'){
                    $(t).parent().parent().hide();
                }
            },
            
    });
});