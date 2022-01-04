
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
  $(window).on("scroll", function() {
    let height = 100;
    $('#header').toggleClass("active-header", $(this).scrollTop() > height);
  });

  var $close = $('#header .search .close');

  $('#header .search input').on('keyup', function(){
    var search = $(this).val();
    var result = $('#header .search .results');
    if ((search != '') && (search.length > 4)){
      $close.removeClass('dn');

        $.ajax({
            url: '/site/search-apartments',         /* Куда пойдет запрос */
            method: 'get',             /* Метод передачи (post или get) */
            data: {query: search},     /* Параметры передаваемые в запросе. */
            success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                data = JSON.parse(data);
                result.empty();
                $.each(data, function(url, name) {
                    result.append(' <a href="' + url + '">' + name + '</a>');
                });
            }
        });
      $('#header .search .results').slideDown(100);
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
    let { max, type, cost } = $(this).data();

    if($(this).attr('data-operation')==='add'){
      if(qty < max) {
        qty++;
      }
    } else {
        qty--;
    }

    //i don't want to go below 0
    if (qty < 0) {
        qty = 0;
    }

    if (type === 'orders') {
      let count = $(this).closest('.counter').find('.special').val()

      if( $(this).attr('data-operation') === 'add' ){
        if(count < max) {
          count++;
        }

        $('.total .price span').text( +$('.total .price span').text() + cost )
      } else {
          count--;
          $('.total .price span').text( +$('.total .price span').text() - cost )
      }

      if (count < 0) {
          count = 0;
          $('.total .price span').text(0)
      }

      $(this).closest('.counter').find('.special').val(count)

      let sum = 0
      $('.order .item .special').each((index, item) => {
        sum += +$(item).val()
      })

      // Change global quantity
      $('.quantity').text(sum)
    }

    if (qty > 0) {
    	$(this).closest('.interaction').find('button').removeClass('dn');
    } else {
    	$(this).closest('.interaction').find('button').addClass('dn');
    	$('#order_block').addClass('dn');
    }

    //put new value into input box id-'qty'
    //$(this).siblings('input').val(qty);
    $(this).siblings('input').val(qty);

  //  console.log($(this).siblings('input'));
    // console.log($(this).siblings('input').val());
});

$('#goods .item .interaction .button button').click(function() {
    $('#order_block').removeClass('dn');
    var elements = $('input');
    let count = $(this).closest('.interaction').find('input:first').val();
    let product_id = $(this).attr('data-id');

    $.ajax({
        url: '/api/cart/add-to-cart',         /* Куда пойдет запрос */
        method: 'post',             /* Метод передачи (post или get) */
        data: {count, product_id},     /* Параметры передаваемые в запросе. */
        success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
            data = JSON.parse(data);
            if (data) {
              $('#productCount').text(data)
            }
        }
    });
  });


$('#delivery label').click(function() {
    if ($("#newPost").is(":checked")){
	  $('#postNumber').slideDown(300);
	} else {
		$('#postNumber').slideUp(300);
	}
});

$('#order .item .delete').click(function() {
  // Change values before delete
  let count = $(this).closest('.item').find('.special').val()
  let { cost } = $(this).data()

  $('.total .price span').text( +$('.total .price span').text() - (cost * count) )
  $('.quantity').text( +$('.quantity').text() - count )

  // Delete from DOM
  $(this).closest('.item').remove()
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
