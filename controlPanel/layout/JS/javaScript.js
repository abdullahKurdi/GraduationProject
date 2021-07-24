$(function () {
    
    'use strict';
// dashboard toggle
    $('.toggle-info').click(function(){
        $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(600);
        if($(this).hasClass('selected')){
            $(this).html('<i class="fa fa-plus fa-lg"></i>');
        }else{
            $(this).html('<i class="fa fa-minus fa-lg"></i>');
        }
    });

    // trigger select box
    // Calls the selectBoxIt method on your HTML select box
    $("select").selectBoxIt({
        autoWidth: false,
        // Uses the jQuery 'fadeIn' effect when opening the drop down
        showEffect: "fadeIn",

        // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
        showEffectSpeed: 400,

        // Uses the jQuery 'fadeOut' effect when closing the drop down
        hideEffect: "fadeOut",

        // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
        hideEffectSpeed: 400

  });

// Hide Placeholder On Form Focus

    $('[placeholder]').focus(function () {

        $(this).attr('data-text', $(this).attr('placeholder'));

        $(this).attr('placeholder', '');

    }).blur(function () {

        $(this).attr('placeholder', $(this).attr('data-text'));

    });
// input required
    $('input').each(function () {
        if($(this).attr('required') === 'required'){
            $(this).after('<span class="asterick">*</span>');
        }
    });
// convert password to show password field
    var passfield = $('.password');
    $('.show-pass').hover(function () {
        passfield.attr('type','text');
    }, function () {
        passfield.attr('type','password');
    });
//confarimation massage
    $('.confirm').click(function () {
        return confirm('Are you sure ?');
    });
//category view option
    $('.cat h3').click(function () {
        $(this).next('.full-view').fadeToggle(700);
    });

    $('.ordering span').click(function () {
        $(this).addClass('active').siblings('span').removeClass('active');
        if($(this).data('view')==='Full'){
            $('.cat .full-view').fadeToggle(700);
        }else{
            $('.cat .full-view').fadeOut(700);
        }
    });
});
   