/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
        $('#sbm').mouseover(function (){
        $(this).css('background-color', '#B8B8B8');
//        $(this).css('color', '#4B4B4B');
    });
    
    $('#sbm').mouseout(function (){
        $(this).css('background-color', '#FF944D');
//        $(this).css('color', 'dodgerblue');
    });
    
    $('#sbm').mousedown(function (){
        $(this).css('background-color', 'white');
        $(this).css('color', 'black');
    });

    $('#sbm').mouseup(function (){
        $(this).css('background-color', '#FF944D');
//        $(this).css('color', 'dodgerblue');
    });
    
    $('#sbm_down').mouseover(function (){
        $(this).css('background-color', '#B8B8B8');
//        $(this).css('color', '#4B4B4B');
    });
    
    $('#sbm_down').mouseout(function (){
        $(this).css('background-color', '#FF944D');
//        $(this).css('color', 'dodgerblue');
    });
    
    $('#sbm_down').mousedown(function (){
        $(this).css('background-color', 'white');
        $(this).css('color', 'black');
    });

    $('#sbm_down').mouseup(function (){
        $(this).css('background-color', '#FF944D');
//        $(this).css('color', 'dodgerblue');
    });

    $('#user_name').focusin(function (){
        if($(this).val() === 'username')
            $(this).val('');
    });
    $('#user_name').blur(function (){
        if ($(this).val() === '')
            $(this).val('username');
    });
    
    $('#pass').focusin(function (){
        if($(this).val() === 'password')
            $(this).val('');
    });
    $('#pass').blur(function (){
        if ($(this).val() === '')
            $(this).val('password');
    });
    
    $('#user_name_down').focusin(function (){
        if($(this).val() === 'username')
            $(this).val('');
    });
    $('#user_name_down').blur(function (){
        if ($(this).val() === '')
            $(this).val('username');
    });    

    $('#pass_down').focusin(function (){
        if($(this).val() === 'password')
            $(this).val('');
    });
    $('#pass_down').blur(function (){
        if ($(this).val() === '')
            $(this).val('password');
    });
    
    $('#email_down').focusin(function (){
        if($(this).val() === 'email')
            $(this).val('');
    });
    $('#email_down').blur(function (){
        if ($(this).val() === '')
            $(this).val('email');
    });
    
    $('#skype_down').focusin(function (){
        if($(this).val() === 'skype')
            $(this).val('');
    });
    $('#skype_down').blur(function (){
        if ($(this).val() === '')
            $(this).val('skype');
    });
    
    $('#facebook').focusin(function (){
        if($(this).val() === 'facebook')
            $(this).val('');
    });
    $('#facebook').blur(function (){
        if ($(this).val() === '')
            $(this).val('facebook');
    });
    
    $('#g_plus').focusin(function (){
        if($(this).val() === 'google plus')
            $(this).val('');
    });
    $('#g_plus').blur(function (){
        if ($(this).val() === '')
            $(this).val('google plus');
    });
    
    
    $('#create_acc').click(function (){
        $('#registration').css('height', $('#registration').css('height'));
        $('#registration').slideDown(2000);
//        $('#registration').show();
        $('#index_wrapper').slideDown(2000);
    });
    
    $(window).resize(function(){
//        alert($(window).height());

        $('#registration').css('height', $('#index_wrapper').height());
//        $('#registration').slideDown();
    });
    
    $('#close').click(function(){
        $('#registration').slideUp();
        $('#index_wrapper').show();
    });
    
//    submit regisracione forme
//    $('#reg_form').submit(function(e){
//        e.preventDefault();
//        var username = 0;
//        var pass = 0;
//        var drzava = 0;
//        var grad = 0;
//        var fax = 0;
//        $('#user_name_down_check').text('');
//        $('#pass_down_check').text('');
//        $('#drzava_check').text('');            
//        $('#grad_check').text('');
//        $('#fax_down_check').text('');
//
//        if($('#fax').val() === ''){
//            $('#fax_down_check').text('Please select your faculty.');
//            fax = 1;
//        }
//
//        if($('#user_name_down').val().length === 0 || $('#user_name_down').val() === 'username'){
//            $('#user_name_down_check').text('Please enter username.');
//            username = 1;
//        }
//        if($('#pass_down').val().length === 0 || $('#pass_down').val() === 'password'){
//            pass = 1;
//            $('#pass_down_check').text('Please enter password.');
//        }
//        if($('#drzava').val() === ''){
//            drzava = 1;
//            $('#drzava_check').text('Please choose state');
//        }
//        if($('#grad').val() === ''){
//            grad = 1;
//            $('#grad_check').text('Please choose city');
//        }
//        if(username === 0 && pass === 0 && drzava === 0 && grad === 0 && fax === 0){
//            $.ajax({
//
//            });        
//        }
//    });
    
//    $('#log_form').submit(function(e){
//        e.preventDefault();
//        var username = 0;
//        var pass = 0;
//        $('#user_name_check').text('');
//        $('#pass_check').text('');
//
//        if($('#user_name').val().length === 0 || $('#user_name').val() === 'username'){
//            $('#user_name_check').text('Please enter username.');
//            username = 1;
//        }
//        if($('#pass').val().length === 0 || $('#pass').val() === 'password'){
//            pass = 1;
//            $('#pass_check').text('Please enter password.');
//        }
//        if(username === 0 && pass === 0){
//            $.ajax({
//
//            });        
//        }
//    });

});

function open_registration(){
        $('#registration').css('height', $('#registration').css('height'));
        $('#registration').show();
        $('#index_wrapper').hide();
}

