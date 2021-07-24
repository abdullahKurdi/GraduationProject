$(function () {
    'use strict';
//****************************************************************************** */
// dashboard toggle
    $('.toggle-info').click(function(){
        $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(600);
        if($(this).hasClass('selected')){
            $(this).html('<i class="fa fa-minus fa-lg"></i>');
        }else{
            $(this).html('<i class="fa fa-plus fa-lg"></i>');
        }
    });
  

    // trigger select box
    // Calls the selectBoxIt method on your HTML select box

//****************************************************************************** */
// Hide Placeholder On Form Focus

    $('[placeholder]').focus(function () {

        $(this).attr('data-text', $(this).attr('placeholder'));

        $(this).attr('placeholder', '');

    }).blur(function () {

        $(this).attr('placeholder', $(this).attr('data-text'));

    });
//****************************************************************************** */
// input required
 /*   $('input').each(function () {
        if($(this).attr('required') === 'required'){
            $(this).after('<span class="asterick">*</span>');
        }
    });*/
//****************************************************************************** */
//confarimation massage
    $('.confirm').click(function () {
        return confirm('Are you sure?');
    });

// message error contact form
var userError= true,
    emailError= true,
    phoneError= true,
    msgError= true;
// function checkError(){
//     if (userError === true || phoneError === true || emailError === true || msgError === true){
//         console.log('There\'s Error In From');
//     }else{
//         console.log('Valid Form');
//     }
// }

$('.contact_form .contact .username').blur(function () {
    if($(this).val().length < 3){
        $(this).css('border','2px solid #f00');
        $(this).parent().find('.alert').fadeIn("slow");
        userError= true;
    }else{
        $(this).parent().find('.alert').fadeOut(300);
        $(this).css('border','2px solid green');
        userError= false;
    }
    // checkError();
});
$('.contact_form .contact .email').blur(function () {
    if($(this).val().length < 1){
        $(this).css('border','2px solid #f00');
        $(this).parent().find('.alert').fadeIn("slow");
        emailError= true;
    }else{
        $(this).parent().find('.alert').fadeOut(300);
        $(this).css('border','2px solid green');
        emailError= false;
    }
    // checkError();
});
$('.contact_form .contact .phone').blur(function () {
    if($(this).val().length != 10){
        $(this).css('border','2px solid #f00');
        $(this).parent().find('.alert').fadeIn("slow");
        phoneError= true;
    }else{
        $(this).parent().find('.alert').fadeOut(300);
        $(this).css('border','2px solid green');
        phoneError= false;
    }
    // checkError();
});
$('.contact_form .contact .message').blur(function () {
    if($(this).val().length < 10){
        $(this).css('border','2px solid #f00');
        $(this).parent().find('.alert').fadeIn("slow");
        msgError= true;
    }else{
        $(this).parent().find('.alert').fadeOut(300);
        $(this).css('border','2px solid green');
        msgError= false;
    }
    // checkError();
});
$('.contact_form .contact').submit(function(e){
    if (userError === true || phoneError === true || emailError === true || msgError === true){
        e.preventDefault();
        $('.contact_form .contact .username,.contact_form .contact .email,.contact_form .contact .phone,.contact_form .contact .message').blur();
    }else{
        
    }
}) 
//****************************************************************************** */
//realtime add item
/*    $('.livename').keyup(function () {
       $('.liveprev .card h5').text($(this).val()); 
    });
    $('.livedes').keyup(function () {
        $('.liveprev .card p').text($(this).val()); 
     });
     $('.liveselling').keyup(function () {
        $('.liveprev .card .price-tag').text('$'+ $(this).val()); 
     });
*/
$('.live').keyup(function () {
    $($(this).data('class')).text($(this).val()); 
 });
 //****************************************************************************** */     
var ourCountdown =setInterval(function(){
      var counter=parseInt($('.s0').html())
      var counter2=parseInt($('.m0').html())
      var counter3=parseInt($('.H0').html())
      var counter4=parseInt($('.d0').html())
      var counter5=parseInt($('.w0').html())
    if (counter != 0){
        $('.s0').html(counter - 1);
    }else if(counter == 0){
        if (counter2 !== 0){
            $('.m0').html(counter2 - 1);
            $('.s0').html(counter + 59);
        }else if(counter2 == 0){
            if (counter3 !== 0){
                $('.H0').html(counter3 - 1);
                $('.m0').html(counter2 + 59);
                $('.s0').html(counter + 59);
            }else if(counter3 == 0){
                if (counter4 !== 0){
                    $('.d0').html(counter4 - 1);
                    $('.H0').html(counter3 + 23);
                    $('.m0').html(counter2 + 59);
                    $('.s0').html(counter + 59);
                }else if(counter4 == 0){
                    if (counter5 !== 0){
                        $('.d0').html(counter4 + 6);
                        $('.H0').html(counter3 + 23);
                        $('.m0').html(counter2 + 59);
                        $('.s0').html(counter + 59);
                    }else if(counter4 == 0 && counter3 == 0 && counter2 == 0 && counter1 == 0 && counter == 0) {
                        $('.d0').html('Thank');
                        $('.H0').html('you');
                        $('.s0').html('Thank');
                        $('.m0').html('you');
                    }
                }
            }
        }
    }
},1000);
var ourCountdown =setInterval(function(){
    var counter=parseInt($('.s1').html())
    var counter2=parseInt($('.m1').html())
    var counter3=parseInt($('.H1').html())
    var counter4=parseInt($('.d1').html())
    var counter5=parseInt($('.w1').html())
  if (counter != 0){
      $('.s1').html(counter - 1);
  }else if(counter == 0){
      if (counter2 !== 0){
          $('.m1').html(counter2 - 1);
          $('.s1').html(counter + 59);
      }else if(counter2 == 0){
          if (counter3 !== 0){
              $('.H1').html(counter3 - 1);
              $('.m1').html(counter2 + 59);
              $('.s1').html(counter + 59);
          }else if(counter3 == 0){
              if (counter4 !== 0){
                  $('.d1').html(counter4 - 1);
                  $('.H1').html(counter3 + 23);
                  $('.m1').html(counter2 + 59);
                  $('.s1').html(counter + 59);
              }else if(counter4 == 0){
                  if (counter5 !== 0){
                      $('.d1').html(counter4 + 6);
                      $('.H1').html(counter3 + 23);
                      $('.m1').html(counter2 + 59);
                      $('.s1').html(counter + 59);
                  }else if(counter4 == 0 && counter3 == 0 && counter2 == 0 && counter1 == 0 && counter == 0){
                      $('.d1').html('Thank');
                      $('.H1').html('you');
                      $('.s2').html('Thank');
                      $('.m2').html('you');
                  }
              }
          }
      }
  }
},1000);
var ourCountdown =setInterval(function(){
    var counter=parseInt($('.s2').html())
    var counter2=parseInt($('.m2').html())
    var counter3=parseInt($('.H2').html())
    var counter4=parseInt($('.d2').html())
    var counter5=parseInt($('.w2').html())
  if (counter != 0){
      $('.s2').html(counter - 1);
  }else if(counter == 0){
      if (counter2 !== 0){
          $('.m2').html(counter2 - 1);
          $('.s2').html(counter + 59);
      }else if(counter2 == 0){
          if (counter3 !== 0){
              $('.H2').html(counter3 - 1);
              $('.m2').html(counter2 + 59);
              $('.s2').html(counter + 59);
          }else if(counter3 == 0){
              if (counter4 !== 0){
                  $('.d2').html(counter4 - 1);
                  $('.H2').html(counter3 + 23);
                  $('.m2').html(counter2 + 59);
                  $('.s2').html(counter + 59);
              }else if(counter4 == 0){
                  if (counter5 !== 0){
                      $('.d2').html(counter4 + 6);
                      $('.H2').html(counter3 + 23);
                      $('.m2').html(counter2 + 59);
                      $('.s2').html(counter + 59);
                  }else if(counter4 == 0 && counter3 == 0 && counter2 == 0 && counter1 == 0 && counter == 0){
                      $('.d2').html('Thank');
                      $('.H2').html('you');
                      $('.s2').html('Thank');
                      $('.m2').html('you');
                  }
              }
          }
      }
  }
},1000);
var ourCountdown =setInterval(function(){
    var counter=parseInt($('.s3').html())
    var counter2=parseInt($('.m3').html())
    var counter3=parseInt($('.H3').html())
    var counter4=parseInt($('.d3').html())
    var counter5=parseInt($('.w3').html())
  if (counter != 0){
      $('.s3').html(counter - 1);
  }else if(counter == 0){
      if (counter2 !== 0){
          $('.m3').html(counter2 - 1);
          $('.s3').html(counter + 59);
      }else if(counter2 == 0){
          if (counter3 !== 0){
              $('.H3').html(counter3 - 1);
              $('.m3').html(counter2 + 59);
              $('.s3').html(counter + 59);
          }else if(counter3 == 0){
              if (counter4 !== 0){
                  $('.d3').html(counter4 - 1);
                  $('.H3').html(counter3 + 23);
                  $('.m3').html(counter2 + 59);
                  $('.s3').html(counter + 59);
              }else if(counter4 == 0){
                  if (counter5 !== 0){
                      $('.d3').html(counter4 + 6);
                      $('.H3').html(counter3 + 23);
                      $('.m3').html(counter2 + 59);
                      $('.s3').html(counter + 59);
                  }else if(counter4 == 0 && counter3 == 0 && counter2 == 0 && counter1 == 0 && counter == 0){
                      $('.d3').html('Thank');
                      $('.H3').html('you');
                      $('.s3').html('Thank');
                      $('.m3').html('you');
                  }
              }
          }
      }
  }
},1000);
var ourCountdown =setInterval(function(){
    var counter=parseInt($('.s4').html())
    var counter2=parseInt($('.m4').html())
    var counter3=parseInt($('.H4').html())
    var counter4=parseInt($('.d4').html())
    var counter5=parseInt($('.w4').html())
  if (counter != 0){
      $('.s4').html(counter - 1);
  }else if(counter == 0){
      if (counter2 !== 0){
          $('.m4').html(counter2 - 1);
          $('.s4').html(counter + 59);
      }else if(counter2 == 0){
          if (counter3 !== 0){
              $('.H4').html(counter3 - 1);
              $('.m4').html(counter2 + 59);
              $('.s4').html(counter + 59);
          }else if(counter3 == 0){
              if (counter4 !== 0){
                  $('.d4').html(counter4 - 1);
                  $('.H4').html(counter3 + 23);
                  $('.m4').html(counter2 + 59);
                  $('.s4').html(counter + 59);
              }else if(counter4 == 0){
                  if (counter5 !== 0){
                      $('.d4').html(counter4 + 6);
                      $('.H4').html(counter3 + 23);
                      $('.m4').html(counter2 + 59);
                      $('.s4').html(counter + 59);
                  }else if(counter4 == 0 && counter3 == 0 && counter2 == 0 && counter1 == 0 && counter == 0){
                      $('.d4').html('Thank');
                      $('.H4').html('you');
                      $('.s4').html('Thank');
                      $('.m4').html('you');
                  }
              }
          }
      }
  }
},1000);
var ourCountdown =setInterval(function(){
    var counter=parseInt($('.s5').html())
    var counter2=parseInt($('.m5').html())
    var counter3=parseInt($('.H5').html())
    var counter4=parseInt($('.d5').html())
    var counter5=parseInt($('.w5').html())
  if (counter != 0){
      $('.s5').html(counter - 1);
  }else if(counter == 0){
      if (counter2 !== 0){
          $('.m5').html(counter2 - 1);
          $('.s5').html(counter + 59);
      }else if(counter2 == 0){
          if (counter3 !== 0){
              $('.H5').html(counter3 - 1);
              $('.m5').html(counter2 + 59);
              $('.s5').html(counter + 59);
          }else if(counter3 == 0){
              if (counter4 !== 0){
                  $('.d5').html(counter4 - 1);
                  $('.H5').html(counter3 + 23);
                  $('.m5').html(counter2 + 59);
                  $('.s5').html(counter + 59);
              }else if(counter4 == 0){
                  if (counter5 !== 0){
                      $('.d5').html(counter4 + 6);
                      $('.H5').html(counter3 + 23);
                      $('.m5').html(counter2 + 59);
                      $('.s5').html(counter + 59);
                  }else if(counter4 == 0 && counter3 == 0 && counter2 == 0 && counter1 == 0 && counter == 0){
                      $('.d5').html('Thank');
                      $('.H5').html('you');
                      $('.s5').html('Thank');
                      $('.m5').html('you');
                  }
              }
          }
      }
  }
},1000);
});

function selectCity(){
        var x =document.getElementById('inputContrychang').value;
        console.log(x);
        if(x==='Jordan'){
            var array=['Choose...','Irbid','Ajloun','Jerash','Mafraq','Balqa','Amman','Zarqa','Madaba','Karak','Tafilah','Maan','Aqaba'];
        }else if(x==='Egypt'){
            var array=['Choose...','Cairo','Alexandria','Giza','Shubra El-Kheima','Port Said','Suez','El-Mahalla El-Kubra','Luxor','Mansoura','Tanta'];
        }else if(x==='الأردن'){
            var array=['اختر...','اربد','عجلون','جرش','المفرق','البلقا','عمان','الزرقاء','مادبا','الكرك','طفيلة','معان','العقبه'];
        }else if(x==='مصر'){
            console.log(x)
            var array=['اختر...','القاهرة','الإسكندرية','الجيزه','شبرا الخيمة','بورسعيد','السويس','المحلة الكبرى','الاقصر','المنصورة','الكثير'];
        }else if(x==='Saudi'){
            var array=['Choose...','Riyadh','Jeddah','Mecca','Medina','Al-Ahsa','Taif','Dammam','Buraidah','Khobar','Tabuk'];
        }else if(x==='السعوديه'){
            var array=['اختر...','الرياض','جدة','مكة','المدينه المنوره','الأحسا','الطائف','الدمام','بريدة','الخبر','تبوك'];
        }else if(x==='Libya'){
            var array=['Choose...','Tripoli','Misurata','Sirte', 'Al-Batnan', 'Benghazi', 'Al-Jabal Al-Akhdar', 'Al-Jabal Al-Gharbi', 'Al-Jufra'];
        }else if(x==='ليبيا'){
            var array=['اختر...','طرابلس','قياس','سرت', 'البطنان', 'بنغازي', 'الجبل الأخضر', 'الجبل الغربي', 'الجفرة'];
        }else if(x==='Morocco'){
            var array=['Choose...','Casablanca', 'Rabat', 'Fez', 'Marrakesh', 'Tangier', 'Sefrou','Benjrir', 'Tan-Tan', 'Ouezzane', 'Guercif', 'Ouarzazate', 'Al Hoceima'];
        }else if(x==='المغرب'){
            var array=['اختر...','الدار البيضاء', 'الرباط', 'فاس', 'مراكش', 'طنجه', 'سيفرو','بنجر', 'طنطن', 'أوزاني', 'غيرسيف', 'ورزازات', 'الحكمة'];
        }else if(x==='Algeria'){
            var array=['Choose...','Adrar', 'Chlef', 'Laghouat', 'Oum El Bouaghi', 'Batna', 'Bejaia', 'Biskra'];
        }else if(x==='الجزائر'){
            var array=['اختر...','درار', 'كليف', 'لاغوات', 'أم البواغي', 'باتنا', 'بجاية', 'بسكرة'];
        }else{
            var array=['Choose...'];
        }
        var str='';
        for(i=0 ; i<array.length ; i++){
            str+='<option value="'+array[i]+'">'+array[i] +'</option>'
        }
        document.getElementById('inputCityoption').innerHTML=str;
 }
 
//  function selectSub(){
//     var x =document.getElementById('inputCategory').value;
//     console.log(x);
//     var str='';
//     if (x !== 0 ){
//         str='<option value="Choose...">Choose...</option><?php foreach ($cSub as $c2){if ($c2[\'Parent\']=='+x+'){echo "<option value =\'" . $c2[\'CatID\'] . "\'>" . $c2[\'CatName\'] ."</option>";}}?>'
//         console.log(str)
//             // echo "<option value ='" . $c['CatID'] . "'>" . $c['CatName'] . "</option>";}?>'+array[i]+'">'+array[i] +'</option>'
//     }else{
//         str='<option value="Choose...">Choose...</option>'
//     }
//     document.getElementById('subCat').innerHTML=str;
// }
//  function addNewLine(){
//      text = document.getElementById('Comment2').value;
//      text = text.replace(/ /g,"[sp][sp]");
//      text = text.replace(/\n/g,"[nl]");
//      document.getElementById('Comment').value = text;
//      return false;
//  }
