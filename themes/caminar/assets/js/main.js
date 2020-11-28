(function($) {

	// Add comments via AJAX
  $("#commentForm").validate({
    rules: {
      email: {
        email: true
      }
    },

    submitHandler: function(form) {
      var form = $("#commentForm"),
      $fields = form.find('input[type="text"],input[type="email"],textarea'),
      url = form.attr('action'),
      data = form.serialize();
      $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function() {
          $('#comment_add_msg').text("Your comment will be published after approval")
          .slideDown(250).delay(2500).slideUp(250);
          $fields.val('');
        },
        error: function() {
          $('#comment_add_msg').removeClass('alert-success').addClass('alert-danger')
          .text("Sorry, we could not add your comment")
          .slideDown(250).delay(2500).slideUp(250);
        }
      });
    }
  });

})(jQuery);