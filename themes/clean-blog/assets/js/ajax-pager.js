(function($) {

	var currentPage = 1;

	$('.pagination').hide();

	$(window).scroll(function() {
			if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
					loadMore();
			}
	});

	function loadMore() {
		$.ajax({
      url: baseUrl + '?page=' + currentPage,
      type: 'GET',
      beforeSend: function() {
        $('.loader').show();
      }
    })
    .done(function(data) {
      $('.loader').hide();
      if (currentPage >= 2) {
        var posts = $(data).find('#postsContainer').html();
      } 
      // If there are no more posts, show loader
      //  Otherwise, load more posts
      if (posts == 'undefined') {
        $('.loader').hide();
      } else {
        $('#postsContainer').append(posts);
        currentPage = currentPage + 1;
      }
    });
	}

})(jQuery);