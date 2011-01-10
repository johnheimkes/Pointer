$(function() {
  $('.controls a').click(function() {
    var dir = $(this).parent().next('form'),
      post = $(dir).serialize()
      self = this;
      
    post += '&type='+self.className;

    console.log(post);

    $.post('/' + $(dir).attr('action') + '?type=' + self.className, post, function(data) {
      if(data) {
        console.log(data);
      }
      console.log(data);
    })
    //
    return false;
  })
})
