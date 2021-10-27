(function($) {

  var currentPage = 2,
      maxPage = $('#postsContainer').data('max-page'),
      posts = null,
      pageUrl = $(location).attr('href'),
      [pageBaseUrl, searchStr] = pageUrl.split('?');

  $('.pagination').hide();

  $(window).scroll(function() {
      var toBottom = $(window).scrollTop() >= $(document).height() - $(window).height() - 25;

      if (toBottom && currentPage <= maxPage) {
          loadMore();
      }
  });

  function loadMore() {

      $.ajax({
              url: `${pageBaseUrl}?${typeof searchStr === 'string' ? searchStr : ''}&page=${currentPage}`,
              type: 'GET',
              beforeSend: function() {
                  if (typeof posts != 'undefined') {
                      $('.loader').show();
                  }
              }
          })
          .done(function(data) {
              $('.loader').hide();
              posts = $(data).find('#postsContainer').html();

              if (typeof posts != 'undefined') {

                $('#postsContainer').append(posts);
                currentPage = currentPage + 1;

                if (currentPage > maxPage) {
                  $('#postsContainer').append('<p class="text-center text-muted">No more posts to load</p>');
                }
              }
          });
  }

})(jQuery);