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
					type: 'POST',
					beforeSend: function() {
						$('.loader').show();
					}
				})
				.done(function(data) {
					$('.loader').hide();
					$("#postsContainer").append(data);
					currentPage = currentPage + 1;
				});
	}

})(jQuery);