(function($) {

	var currentPage = 1;
  var posts = null;

	$('.pagination').hide();

	$(window).scroll(function() {
			if ($(window).scrollTop() >= $(document).height() - $(window).height() - 25) {
					loadMore();
			}
	});

	function loadMore() {
		$.ajax({
      url: baseUrl + '?page=' + currentPage,
      type: 'GET',
      beforeSend: function() {
        if (typeof posts != 'undefined') {
          $('.loader').show();
        }
      }
    })
    .done(function(data) {
      $('.loader').hide();
      // Get post from page 2 onward
      if (currentPage >= 2) {
        posts = $(data).find('#postsContainer').html();
      } 
      // If there are no more posts, hide loader
      //  Otherwise, load more posts
      if (typeof posts == 'undefined') {
        $('.loader').hide();
      } else {
        $('#postsContainer').append(posts);
        currentPage = currentPage + 1;
      }
    });
	}

})(jQuery);