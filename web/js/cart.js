$('body').on('click', '.price-modify', function(event) {
  event.preventDefault()

  let { operation, cost } = $(this).data()
  let count = $(this).closest('.global-product-item').find('.input-for-product').val()

  if (operation === 'add') {
    count++
  }

  if (operation === 'substract') {
    count = --count < 0 ? 0 : count
  }

  $(this).closest('.global-product-item').find('.input-for-product').val(count)

  productsInfoUpdate()
})

$('body').on('click', '.remove-product-button', function(event) {
  $(this).closest('.global-product-item').remove();
  productsInfoUpdate();
})


function productsInfoUpdate() {
  let sum = count = 0

  $('.input-for-product').each(function(index, item) {
    count += +$(item).val()
    sum += +$(item).data('cost') * +$(item).val()
  })

  $('.total-products-price').text(sum)

  if ($('.total-products-count')[0]) {
    $('.total-products-count').text(count)
  }

  if (!sum && !count && !$('.input-for-product')[0]) {
    // Delete order form
    $('.payment').remove()
  }
}
