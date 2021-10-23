$(function() {
  const lazyLoadInstance = new LazyLoad();
  $('.lightbox').topbox({ skin: 'zest' });
  
  // Set portfolio img layout
  (function() {
    let grid = '';
    if ($(window).width() >= 1200) {
      grid = 'col-2';
    } else if ($(window).width() >= 768) {
      grid = 'col-3';
    }
    $('#portfolio .photo').removeClass(grid !== '' && 'col-4').addClass(grid);
  })();
  
  // Set portfolio img height
  function setPortfolioImgHeight() {
    const img = $('.lightbox-img');
    img.height(img.width());
  }
  setPortfolioImgHeight();
  
  
  
  // Setup ajax header
  $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
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

  // Img position at about section
  (function() {
    const bio = $('#about #bio');
    const skills = $('#about #skills-container').children();

    if (bio.is(':empty')  &&  skills.length === 0) {
      $('#about h1.text-uppercase, #about .col-md-8').toggleClass('d-md-none');
    }
  })();
  
  // Padding at contact section
  (function() {
    let listGroup = $('#contact .list-group');
    let dFlex = $('#contact .d-flex');
  
    if (listGroup.children('li').length > 0) {
      listGroup.addClass('p-3');
    }
    if (dFlex.children('a').length > 0) {
      dFlex.addClass('p-3');
    }
    if (listGroup.children('li').length > 0  &&  dFlex.children('a').length > 0) {
      listGroup.addClass('pb-0');
    }
  })();

  // Change height of textarea to fit content and show characters limit
  $('textarea').on('input', function() {
    (this.scrollHeight > 120) && $(this).height(120).height(this.scrollHeight);

    const maxLength     = $(this).prop('maxlength');
    const currentLength = $(this).val().length;

    const limitWrapper = $('#contact .limit');
    limitWrapper.html(maxLength - currentLength);
    (currentLength === maxLength) ? limitWrapper.addClass('text-danger fw-bold').removeClass('text-muted') : limitWrapper.addClass('text-muted').removeClass('text-danger fw-bold');
  });
  
  // Send message
  $('#contact form').on('submit', function(event) {
    event.preventDefault();
    $('#contact form .btn-dark').toggleClass('d-none');
    $('.form-control').removeClass('is-invalid');
    $('.form-text').empty();
    
    $.ajax({
      url      : '/send-message',
      method   : 'POST',
      dataType : 'json',
      data: {
        name    : $('#contact #name').val(),
        email   : $('#contact #email').val(),
        message : $('#contact #message').val()
      },
      success: function(result) {
        $('#contact .alert').removeClass('d-none').html(result.message);
  
        $('#contact .d-grid').removeClass('mt-5');
        $('#contact .alert button').on('click', () => $('#contact .d-grid').addClass('mt-5'));
  
        $('#contact form').get(0).reset();
        $('#contact textarea').height(120).siblings('span').html(1000).addClass('text-muted').removeClass('text-danger fw-bold');
        
        $('#contact form .btn-dark').toggleClass('d-none');
        
        // Notify admin
        if (result.notify.status) {
          $.ajax({
            url      : '/notify-admin',
            method   : 'POST',
            dataType : 'json',
            data     : result.notify.data
          });
        }
      },
      error: function(error) {
        $.each(error.responseJSON.errors, function(name, value) {
          $('#' + name).addClass('is-invalid').siblings('div').html(value);
        });

        $('#contact form .btn-dark').toggleClass('d-none');
      }
    });
  });
});