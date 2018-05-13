$(function() {
  $('.phone-actions a').on('click', function (event) {
    $id = $(this).attr('href');
    $('.phone-actions').find('.active').removeClass('active');
    $(this).addClass('active');
    var listItems = $("div.card-body");
    listItems.each(function(idx, div) {
      if ($id.replace('#', '') === $(this).attr('id')) {
        $(this).removeClass('hidden')
      }
      else {
        $(this).addClass('hidden')
      }
    });
  })
});
