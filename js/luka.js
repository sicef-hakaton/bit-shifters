/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var URL = 'http://localhost/PhpProject1/';
var nizTagova = [];
var nizFajlova = [];
var index = 0;
var indexf = 0;




//funkcija za skrivanje teksta 

var sakrijTekst = function (param, name) {
    $(param).focusin(function () {
        if ($(this).val() === name)
            $(this).val('');
    });
    $(param).blur(function () {
        if ($(this).val() === '')
            $(this).val(name);
    });
};




//DOCUMENT READY
$(document).ready(function () {
    //datepicker
    $('#basicExample .time').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
    });

    $('#basicExample .date').datepicker({
        'format': 'm/d/yyyy',
        'autoclose': true
    });

    var basicExampleEl = document.getElementById('basicExample');
    var datepair = new Datepair(basicExampleEl);




    //sakriva divove
    $('.hidden').css('display', 'none');
    $('.activities').css('display', '');
    $('#new_topic').css('display', 'none');
//    $('#add_new_activity').css('display', 'none');

    sakrijTekst('#tagovi', 'tags');
    sakrijTekst('#fajlovi_luka', 'url predavanja');
    sakrijTekst('#text_aktivnosti', 'activity text');
    sakrijTekst('.date, .start', 'date start');
    sakrijTekst('.time, .start', 'time start');
    sakrijTekst('.time, .end', 'time end');
    sakrijTekst('#new_topic', 'new topic');




//    dodavanje TAGOVA u div
    $('#tagovi').keypress(function (event) {
        if (event.which === 32 && $.trim($(this).val()) !== '') {
            var tag = $.trim($(this).val());
            $('#uokvireno').append("<span class='tag_add' id=" + index + ">" + tag + "<a href='#' class='closetag'>×</a></span>");
            $(this).val('');
            nizTagova.push(tag);
            console.log('ispis niza nakon dodavanja:');
            for (var i = 0; i < nizTagova.length; i = i + 1) {
                console.log(nizTagova[ i ]);
            }
            index++;

        }
    });

//    funkcija koja vraca string sa tagovima    
    function get_string_tagovi() {
        tg = '';
        for (var i = 0; i < nizTagova.length; i = i + 1) {
            tg += nizTagova[ i ] + ';';
        }
        return tg;
    }


//    submit forme
    $('#piple_form').submit(function (e) {
        e.preventDefault();
//        get_string_tagovi();
        tgs = get_string_tagovi();
        console.log(tgs);
    });

//kraj dodavanja TAGOVA

//    dodavanje FAJLOVA u div
    $('#fajlovi_luka').keypress(function (event) {
        if (event.which === 32 && $.trim($(this).val()) !== '') {
            var url = $(this).val();
            var pom = url.split("/");
            var pom2 = pom[pom.length - 1];
            pom = pom2.split('.');
            var tag = pom[0];
            var type = pom[pom.length - 1];
            $('#uokvirenofajl').append("<a href=" + url + "><span class='fil_add hover' id=" + indexf + ">" + tag + "<span id='type'>." + type + "</span></span></a>");
            $(this).val('');
            nizFajlova.push(url);
            console.log('ispis niza nakon dodavanja:');
            for (var i = 0; i < nizFajlova.length; i = i + 1) {
                console.log(nizFajlova[ i ]);
            }
            indexf++;

        }
    });

//    funkcija koja vraca string sa tagovima    
    function get_string_fajlovi() {
        tg = '';
        for (var i = 0; i < nizFajlova.length; i = i + 1) {
            tg += nizFajlova[ i ] + ';';
        }
        return tg;
    }


//    submit forme
    $('#piple_form').submit(function (e) {
        e.preventDefault();
//        get_string_tagovi();
        tgs = get_string_fajlovi();
        console.log(tgs);
    });
//kraj dodavanja FAJLOVA

    //funkcija za pregres barr

    var ProgBar = function (param) {
        $(param).goalProgress({
            goalAmount: 100,
            currentAmount: $(param).attr('progress'),
            textBefore: $(param).attr('name') + ' ',
            color: $(param).attr('color'),
            textAfter: ''
        });
    };


    // meni on clic handleri

//stats list
    $('#menu_stats').click(function () {

        if (!$('.activities').is(':hidden')) {
            $('.activities').slideUp(function () {
                $('.stats').slideDown();
                $('#topic_stats_button').show();
            });
        } else if (!$('.friends').is(':hidden')) {
            $('.friends').slideUp(function () {
                $('.stats').slideDown();
                $('#topic_stats_button').show();
            });
        }  else if (!$('.menu_recomende').is(':hidden')) {
            $('.menu_recomende').slideUp(function () {
                $('.stats').slideDown();
                $('#topic_stats_button').show();
            });
        } else if (!$('.stats').is(':hidden')) {
            $('.stats').slideUp(function () {
                $('#topic_stats_button').hide();
            });
        } else if ($('.stats').is(':hidden')) {

            if ($('.topic_stats').is(':hidden')) {
                $('.stats').slideDown();
                $('#topic_stats_button').show();
            } else {
                $('.topic_stats').slideUp(function () {
                    $('#topic_stats_button').text('Topic stats');
                    $('#topic_stats_button').hide();
                });
            }
        }
        //progress bar

        if (!$('#bar').hasClass('done')) {
            ProgBar('.progressbar1');
            ProgBar('.progressbar2');
            ProgBar('.progressbar3');
            ProgBar('.progressbar4');
            ProgBar('.progressbar5');
            $('#bar').addClass('done');
        }
    });

// find friends
    $('#memu_findf').click(function () {
        window.location.href = "search_people.php";
    });

//activities click
    $('#menu_activities').click(function () {
        if (!$('.stats').is(':hidden')) {
            $('.stats').slideUp(function () {
                $('#topic_stats_button').hide();
                $('.activities').slideDown();
            });
        } else if (!$('.friends').is(':hidden')) {
            $('.friends').slideUp(function () {
                $('.activities').slideDown();
            });
        } else if (!$('.menu_recomende').is(':hidden')) {
            $('.menu_recomende').slideUp(function () {
                $('.activities').slideDown();
            });
        }else if (!$('.topic_stats').is(':hidden')) {
            $('.topic_stats').slideUp(function () {
                $('#topic_stats_button').hide();
                $('.activities').slideDown();
            });
        } else if (!$('.activities').is(':hidden')) {
            $('.activities').slideUp();
        } else if ($('.activities').is(':hidden')) {
            $('.activities').slideDown();
        }
    });

//friend list
    $('#menu_friends').click(function () {
        if (!$('.stats').is(':hidden')) {

            $('.stats').slideUp(function () {
                $('#topic_stats_button').hide();
                $('.friends').slideDown();
            });
        } else if (!$('.activities').is(':hidden')) {
            $('.activities').slideUp(function () {
                $('.friends').slideDown();
            });
        } else if (!$('.menu_recomende').is(':hidden')) {
            $('.menu_recomende').slideUp(function () {
                $('.friends').slideDown();
            });
        }  else if (!$('.topic_stats').is(':hidden')) {
            $('.topic_stats').slideUp(function () {
                $('#topic_stats_button').hide();
                $('.friends').slideDown();
            });
        } else if (!$('.friends').is(':hidden')) {
            $('.friends').slideUp();
        } else if ($('.friends').is(':hidden')) {
            $('.friends').slideDown();
        }
    });
    
    //recomendations
     $('#menu_recomende').click(function () {
        if (!$('.stats').is(':hidden')) {

            $('.stats').slideUp(function () {
                $('#topic_stats_button').hide();
                $('.menu_recomende').slideDown();
            });
        } else if (!$('.activities').is(':hidden')) {
            $('.activities').slideUp(function () {
                $('.menu_recomende').slideDown();
            });
        }else if (!$('.friends').is(':hidden')) {
            $('.friends').slideUp(function () {
                $('.menu_recomende').slideDown();
            });
        } else if (!$('.topic_stats').is(':hidden')) {
            $('.topic_stats').slideUp(function () {
                $('#topic_stats_button').hide();
                $('.menu_recomende').slideDown();
            });
        } else if (!$('.menu_recomende').is(':hidden')) {
            $('.menu_recomende').slideUp();
        } else if ($('.menu_recomende').is(':hidden')) {
            $('.menu_recomende').slideDown();
        }
    });



    //za x dugme (kod friends)

    $('.close').click(function (t) {
        $('.confirm').show();
        $('.confirm').css('top', t.pageY).css('left', t.pageX+5);
        var t = this;
        var prijatelj=$(this).parent().find('#ime_prijatelja').text();
        console.log(prijatelj);
        var values='upit=remove_friend&friend_id='+prijatelj;
        var loc=window.location.href.replace('prva_strana.php','php/ajax_php.php');
        $('#yes').click(function () {
            $(this).parent().hide();
            
          $.ajax({
                url: loc,
                type: 'POST',
                data: values,
                success: function (data) {
                        $(t).parent('.list').slideUp(function(){
                            location.reload();
                        });
                },
                error: function(){
                    console.log('greska');
                }
            });
        });

        $('#no').click(function () {
            $(this).parent().hide();
        });
    });

    $('.wtfxd').change(function(){
        console.log('radi');
        var id=$(this).parent().parent().find("#luka_td_x").find('div').text();
        console.log(id);
        var values="upit=finish_activity&id="+id;
        var loc=window.location.href.replace('prva_strana.php','php/ajax_php.php');
        console.log(loc);
        console.log(values);
        $(this).parent().parent().parent().parent().parent().slideUp();
        $.ajax({
            url: loc,
            type: 'POST',
            data: values,
            success: function (data) {
                
            },
            error: function(){
                console.log('greska');
            }
        });
        
    });

    //x dugme za activity
    $('.closea').click(function (t) {
        $('.confirm').show();
        $('.confirm').css('top', t.pageY).css('left', t.pageX+5);
        var t = this;
        $('#yes').click(function () {
            $(this).parent().hide();
            $(t).parent().parent().parent().parent().parent().slideUp();
            var id= $(t).parent().find("#sk_div").text();
            console.log(id);
            
            var values="upit=remove_activity&id="+id;
            var loc=window.location.href.replace('prva_strana.php','php/ajax_php.php');
            console.log(loc);
            console.log(values);
            $.ajax({
                url: loc,
                type: 'POST',
                data: values,
                success: function (data) {
                    
                },
                error: function(){
                    console.log('greska');
                }
            });
            
            
            
        });

        $('#no').click(function () {
            $(this).parent().hide();
        });
    });



    //logout dugme click
    $('#logout').click(function (t) {
        $('.confirmloguot').show();
        $('.confirmloguot').css('top', t.pageY).css('left', t.pageX+5);

        $('#yes1').click(function () {
            $(this).parent().hide();
            window.location.replace('php/get_upiti_php.php?upit=logout');
        });

        $('#no1').click(function () {
            $(this).parent().hide();
        });
    });

    //add new activity
    $('.addnew').click(function () {
        var startDate = $('.start.date').val();
        var startTime = $('.start.time').val();
        var endTime = $('.end.time').val();
        var acctivityText = $('#text_aktivnosti').val();
        var TagoviNiz = get_string_tagovi();
        var FajloviNiz = get_string_fajlovi();
        var Topic = $('#select_topic option:selected').text();
        var values="upit=add_activity&activity_text="+acctivityText+"&topic="+Topic;
        values+="&date="+startDate+"&time_start="+startTime+"&time_end="+endTime;
        values+="&tags="+TagoviNiz+"&urls="+FajloviNiz;
        var loc=window.location.href.replace('prva_strana.php','php/ajax_php.php');
        console.log(loc);
        console.log(values);
        $.ajax({
            url: loc,
            type: 'POST',
            data: values,
            success: function (data) {
                location.reload();
                console.log(data);
                if(data==='1'){
                        $('#text_aktivnosti').val('activity text');
                        $('#select_topic').val('select topic');
                        $('.date.start').val('date start');
                        $('.time.start').val('time start');
                        $('.time.end').val('time end');
                        nizTagova = [];
                        nizFajlova = [];
                        index = 0;
                        indexf = 0;
                        $('.tag_add').remove();
                        $('.fil_add').parent().remove();
                }
            },
            error: function(){
                console.log('greska');
            }
        });


    });


//add topic iz select menija
    $('#select_topic').change(function () {
        if ($('#select_topic option:selected').val() === 'add_topic') {

            $('#new_topic').slideDown();
        } else {
            $('#new_topic').slideUp();
        }
    });

//dodavanje novog topica u listu
    $('#new_topic').keypress(function (event) {
        if (event.which === 13 && $.trim($(this).val()) !== '') {
            var topic = $(this).val();
            $('#add_topic').before(" <option value='" + topic + "'>" + topic + "</option>");
            $('#select_topic').val(topic);
            $('#new_topic').val('');
            $('#new_topic').slideUp();
            console.log(topic);
        values="upit=add_topic&topic="+topic;
        var loc=window.location.href.replace('prva_strana.php','php/ajax_php.php');
        
        $.ajax({
            url: loc,
            type: 'POST',
            data: values,
            success: function (data) {
                console.log(data);
            },
            error: function(){
                console.log('greska');
            }
        });
//////////////////////////////////////
        }
    });


    $('#add_new_slide_down').click(function () {
        $('#add_new_activity').slideToggle();
    });

    $('.hovertextlist').mouseover(function (e) {
        var hovertext = $(this).attr('hovertext');
        $('#hovertext').text(hovertext).show();
        $('#hovertext').css('top', $(this).position().top).css('left', $(this).position().left - $('#hovertext').width() - 10);
    }).mouseout(function () {
        $('#hovertext').hide();
    });

    $('#topic_stats_button').click(function () {
        if (!$('.stats').is(':hidden')) {
            $('.stats').slideUp(function () {
                $('.topic_stats').slideDown();
                $('#topic_stats_button').text('Tag stats');
            });
        } else if ($('.stats').is(':hidden')) {
            $('.topic_stats').slideUp(function () {
                $('.stats').slideDown();
                $('#topic_stats_button').text('Topic stats');

            });
        }

        //progress bar

        if (!$('#bar1').hasClass('done')) {

            ProgBar('.progressbar11');
            ProgBar('.progressbar12');
            ProgBar('.progressbar13');
            ProgBar('.progressbar14');
            ProgBar('.progressbar15');


            $('#bar1').addClass('done');

        }
    });

    //    dodavanje efekta za sve dugmice isto id-a
    $('[id^=follow]').mouseover(function (){
        $(this).css('background-color', '#B8B8B8');
//        $(this).css('color', 'white');
    });
    
    $('[id^=follow]').mouseout(function (){
        $(this).css('background-color', '#FF944D');
        $(this).css('color', 'white');
    });
    
    $('[id^=follow]').mousedown(function (){
        $(this).css('background-color', 'white');
        $(this).css('color', 'black');
    });
    
    $('[id^=follow]').mouseup(function (){
        $(this).css('background-color', '#FF944D');
        $(this).css('color', 'white');
    });

});
//IZVAN DOCUMENT READY

//dodavanje click listenera na dinamicki dodati element za brisanje taga
$(document).on("click", ".closetag", function () {
    $(this).parent().hide();
    id = $(this).parent().text();
    id1 = id.substring(0, id.length - 1);
    console.log(id1);
    nizTagova.splice($.inArray(id1, nizTagova), 1);
    index--;
    console.log('ispis niza nakon brisanja:');
    for (var i = 0; i < nizTagova.length; i = i + 1) {
        console.log(nizTagova[ i ]);
    }

});

// goalProgres funkcija
!function ($) {
    $.fn.extend({
        goalProgress: function (options) {
            var defaults = {
                goalAmount: 100,
                currentAmount: 50,
                speed: 1000,
                textBefore: '',
                textAfter: '',
                milestoneNumber: 70,
                milestoneClass: 'almost-full',
                color: 'black',
                callback: function () {
                }
            }

            var options = $.extend(defaults, options);
            return this.each(function () {
                var obj = $(this);

                // Collect and sanitize user input
                var goalAmountParsed = parseInt(defaults.goalAmount);
                var currentAmountParsed = parseInt(defaults.currentAmount);

                // Calculate size of the progress bar
                var percentage = (currentAmountParsed / goalAmountParsed) * 100;

                var milestoneNumberClass = (percentage > defaults.milestoneNumber) ? ' ' + defaults.milestoneClass : ''

                var color = defaults.color;
                // Generate the HTML
                var progressBar = '<div class="progressBar"  style="background:' + color + ';"></div>';

                var progressBarWrapped = '<div class="goalProgress' + milestoneNumberClass + '">' + defaults.textBefore + defaults.textAfter + progressBar + '</div>';

                // Append to the target
                obj.append(progressBarWrapped);

                // Ready
                var rendered = obj.find('div.progressBar');

                // Remove Spaces
                rendered.each(function () {
                    $(this).html($(this).text().replace(/\s/g, '&nbsp;'));
                });

                // Animate!
                rendered.animate({width: percentage + '%'}, defaults.speed, defaults.callback);

                if (typeof callback == 'function') {
                    callback.call(this);
                }
            });
        }
    });
}(window.jQuery);

$(document).on("click", "#follow", function(){
    var t=this;
    //$(this).parent().parent().hide();
    
    var user=$(this).parent().find('#ime_prijatelja').text();
    console.log(user);
    var loc=window.location.href.replace('prva_strana.php','php/ajax_php.php');
    var values="upit=dodaj_prijatelja&friend_id="+user;
    $.ajax({
            url: loc,
            type: 'POST',
            data: values,
            success: function (data) {
                $(t).parent().parent().slideUp(function (){
                    location.reload();
                });
            },
            
    });
});