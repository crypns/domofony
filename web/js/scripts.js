
var header = $('#header'),
  scrollPrev = 0;

  $(window).scroll(function() {
    var scrolled = $(window).scrollTop();
   
    if ( scrolled > 0 && scrolled > scrollPrev ) {
      header.addClass('active');
    } else {
      header.removeClass('active');
    }
    scrollPrev = scrolled;
  });

 
//   if ($(window).width() < 400) {
//     $('#header .logo img').attr('src','img/header/logo-small.svg');
//   } else {
//   	$('#header .logo img').attr('src','img/header/logo.svg');
//   }
//
//
// $(window).resize(function () {
//     if ($(window).width() < 400) {
//       $('#header .logo img').attr('src','img/header/logo-small.svg');
//     } else {
//     	$('#header .logo img').attr('src','img/header/logo.svg');
//     }
// });

$(document).ready(function() {  
  var $close = $('#header .search .close');
  
  $('#header .search input').on('keyup', function(){
    var search = $(this).val();
    var result = $('#header .search .results a');
    if ((search != '') && (search.length > 4)){
      $close.removeClass('dn');
      result.text(search);
      $('#header .search .results').slideDown(300);
     } else {
      $close.addClass('dn');
     }
  });
  $close.click(function() {
    $('#header .search input').val('');
    $(this).addClass('dn');
    $('#header .search .results').slideUp(300);
  });
});

$(document).mouseup(function (e) {
    var container = $("#header .search .results");
    if (container.has(e.target).length === 0){
    	  $('#header .search input').val('');
    	  $('#header .search .close').addClass('dn');
        container.slideUp(300);
    }
});

if ($(window).width() < 700) {
  $('#header .tels .nums').addClass('transY0');
  $('#header .search input').attr('placeholder','Введіть назву або адресу ЖК (від 5 символів)');
} else {
	$('#header .tels .nums').removeClass('transY0');
	$('#header .search input').attr('placeholder','Введіть назву або адресу житлового комплексу (від 5 символів)');
}

$(window).resize(function () {
    if ($(window).width() < 700) {
      $('#header .tels .nums').addClass('transY0');
      $('#header .search input').attr('placeholder','Введіть назву або адресу ЖК (від 5 символів)');
    } else {
    	$('#header .tels .nums').removeClass('transY0');
    	$('#header .search input').attr('placeholder','Введіть назву або адресу житлового комплексу (від 5 символів)');
    }
}); 

$('#header .tels .handset').click(function() {
    if ($(window).width() < 700) {
      $('#header .tels .nums').toggleClass('transY0');
    }
});

$(document).mouseup(function (e) {
    if ($('#header .tels').has(e.target).length === 0 && ($(window).width() < 700)){
    	  $('#header .tels .nums').addClass('transY0');
    }
});

$('#banner .slider').slick({
    dots: true,
    arrows: false
});

$('#popular .slider').slick({
    dots: true,
    arrows: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
    {
      breakpoint: 960,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 600,
      settings: {
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
 
$('#video .slider').slick({
		centerMode: true,
    adaptiveHeight: true,
    dots: false,
    arrows: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    appendArrows: $('#video .arrows'),
    responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1.65,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 430,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('.counter .action').click(function(){
    //get the value of input field id-'qty'
    var qty = $(this).siblings('input').val();        
    
    if($(this).attr('data-operation')==='add'){
        qty++;
    } else {
        qty--;
    }
    //i don't want to go below 0
    if (qty < 0) {
        qty = 0;
    }

    if (qty > 0) {
    	$(this).closest('.interaction').find('button').removeClass('dn');
    } else {
    	$(this).closest('.interaction').find('button').addClass('dn');
    	$('#order_block').addClass('dn');
    }

    //put new value into input box id-'qty'
    $(this).siblings('input').val(qty);

});

$('#goods .item .interaction .button button').click(function() {
    $('#order_block').removeClass('dn');
  });



$('#delivery label').click(function() {
    if ($("#newPost").is(":checked")){
	  $('#postNumber').slideDown(300);
	} else {
		$('#postNumber').slideUp(300);
	}
});

$('#order .item .delete').click(function() {
    $(this).closest('.item').css('display','none');
  });


$(document).keydown(function(event) { 
  if (event.keyCode == 27) { 
    $('#header .search input').val('');
    $('#header .search .results').slideUp(300);
    $('#header .search .close').addClass('dn');
    if (($(window).width() < 700)){
    	  $('#header .tels .nums').addClass('transY0');
    }     
  }
});