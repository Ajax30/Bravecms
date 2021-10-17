(function($) {

  var currentPage = 2,
      maxPage = $('#postsContainer').data('max-page'),
      posts = null,
      pageUrl = $(location).attr('href'),
      pageBaseUrl = pageUrl.split('?')[0],
      searchStr = pageUrl.split('?')[1];

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
                  console.log(this.url);
                  if (typeof posts != 'undefined') {
                      $('.loader').show();
                  }
              }
          })
          .done(function(data) {
              $('.loader').hide();
              posts = $(data).find('#postsContainer').html();

              if (typeof posts != 'undefined') {

                  $(posts).insertBefore('#lighthouse');
                  currentPage = currentPage + 1;

                  if (currentPage > maxPage) {
                      $('<p class="text-center text-muted">No more posts to load</p>').insertBefore('#lighthouse');
                  }
              }
          });
  }

})(jQuery);