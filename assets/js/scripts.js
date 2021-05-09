$(function() {
  function setPortfolioImgHeight() {
    const portfolioImg = $('.lightbox-img');
    portfolioImg.height(portfolioImg.width());
    $('.last-img').height(portfolioImg.width());
  }

  $.ajax({
    url: 'assets/json/portfolio.json',
    method: 'GET',
    dataType: 'JSON',
    success: function(result) {
      let content = '';
      result.forEach(function(item) {
        content += `
          <div class="col-4 p-0">
            <a class="lightbox" data-lightbox-gallery="portfolio" href="assets/img/portfolio/${ item.source }" title="${ item.caption }">
              <div class="lightbox-img w-100" style="background-image: url(assets/img/portfolio/${ item.source })"></div>
            </a>
          </div>
        `;
      });

      $('#portfolio-container').html(content);
      $('.lightbox').topbox({ skin: 'zest' });
      setPortfolioImgHeight();
    }
  });

  // Resize portfolio images
  $(window).on('resize', function() {
    setPortfolioImgHeight();
  });

  // Navbar transparent background effect
  $(window).on('scroll', function() {
    if ($('.navbar').offset().top > 100) {
      $('.navbar').addClass('bg-dark navbar-shadow').removeClass('py-3');
    } else {
      $('.navbar').removeClass('bg-dark navbar-shadow').addClass('py-3');
    }
  });

  // Progress bars animation
  $(window).on('load scroll', function() {
    const bottomOfWindow = $(window).scrollTop() + $(window).height();

    const bottomOfObject = $('#about img').offset().top;
    (bottomOfWindow > bottomOfObject)  &&  $('#about img').css('opacity', 1);

    $('.progress-bar').each(function() {
      const bottomOfObject = $(this).offset().top;
      const percentage = $(this).attr('aria-valuenow');
      
      (bottomOfWindow > bottomOfObject)  &&  $(this).css('width', percentage + '%');
    });
  });
});