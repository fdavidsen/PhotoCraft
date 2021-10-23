// Upload new photo
$('#newPhotoModal form').on('submit', function(event) {
  event.preventDefault();
  $('#newPhotoModal .btn-primary').toggleClass('d-none');
  $('.form-control').removeClass('is-invalid');
  $('.form-text').empty();

  $.ajax({
    url         : '/admin/photo/store',
    method      : 'POST',
    data        : new FormData(this),
    dataType    : 'json',
    cache       : false,
    processData : false,
    contentType : false,
    success: function(result) {
      $('.modal').modal('hide');
      location.reload();
    },
    error: function(error) {
      $.each(error.responseJSON.errors, function(name, value) {
        $('[id|=new-' + name + ']').addClass('is-invalid').siblings('div').html(value);
      });
    },
    complete: function() {
      $('#newPhotoModal .btn-primary').toggleClass('d-none');
    }
  });
});

// Edit photo
$('.edit.modal form').on('submit', function(event) {
  event.preventDefault();
  $('.edit.modal .btn-primary').toggleClass('d-none');
  $('.form-control').removeClass('is-invalid');
  $('.form-text').empty();

  $.ajax({
    url         : '/admin/photo/update',
    method      : 'POST',
    data        : new FormData(this),
    dataType    : 'json',
    cache       : false,
    processData : false,
    contentType : false,
    success: function(result) {
      $('.modal').modal('hide');
      location.reload();
    },
    error: function(error) {
      $.each(error.responseJSON.errors, function(name, value) {
        $('[id|=edit-' + name + ']').addClass('is-invalid').siblings('div').html(value);
      });
    },
    complete: function() {
      $('.edit.modal .btn-primary').toggleClass('d-none');
    }
  });
});

// Delete photo
$('#photo-list .delete').on('click', function() {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      const photo = $(this);
      $.ajax({
        url      : '/admin/photo/destroy',
        method   : 'DELETE',
        dataType : 'json',
        data: {
          id       : photo.data('id'),
          filename : photo.data('filename')
        },
        success: function(result) {
          location.reload();
        }
      });
    }
  });
});