(function($) {

		// Post via AJAX
  $("#ajaxForm").validate({
    rules: {
      email: {
        email: true
      }
    },

    submitHandler: function(form) {
      var form = $("#ajaxForm"),
      $fields = form.find('input[type="text"],input[type="email"],textarea'),
      $succesMsg = form.data('successmsg'),
      $failMsg = form.data('failmsg'),
      url = form.attr('action'),
      data = form.serialize();
      $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function() {
          $('#msgContainer').text($succesMsg).slideDown(250).delay(2500).slideUp(250);
          $fields.val('');
        },
        error: function() {
          $('#msgContainer').removeClass('alert-success').addClass('alert-danger')
                            .text($failMsg).slideDown(250).delay(2500).slideUp(250);
        }
      });
    }
  });

})(jQuery);