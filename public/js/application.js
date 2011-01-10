$(function() {
  $('.controls a').click(function() {
    remove_div('.err');

    var dir = $(this).parent().next('form'),
      post = $(dir).serialize()
      self = this;
      
    post += '&type='+self.className;

    if(parseFloat($(dir).children('#val').val())) {
      $.post('/' + $(dir).attr('action') + '?type=' + self.className, post, function(data) {
        if(data) {
          if(parseFloat(data)) {
            $(self).parents('.holder').find('.person p').text(data);
          } else {
            create_err(data, $(self).parents('.holder'));
          }
        }
      })
    } else {
      create_err('The value must be a number.', $(self).parents('.holder'));
    }

    return false;
  })

  $('input').focus(function() {
    $(this).val('');
  })

  function remove_div(div) {
    $(div).remove();
  }

  function create_err(msg, loc) {
    $(loc).prepend('<div class="err"><p>' + msg + '</p></div>');
  }
})
