// Mark as read
$('#message #read').on('click', function() {
  $('#message .badge').empty();
  $('#message .card').removeClass('border-warning');

  const lastID = $('#message .card').first().data('id');

  $.ajax({
    url      : '/admin/core/message/read',
    method   : 'POST',
    dataType : 'json',
    data     : { last_id: lastID }
  });
});

// Notification
$('#message #notification').on('click', function() {
  $('.notification-container').children().toggleClass('d-none');
  $.ajax({
    url      : '/admin/core/message/notification',
    method   : 'PATCH',
    dataType : 'json',
    success: function(result) {
      $('#message #notification i').toggleClass('fa-bell fa-bell-slash text-secondary');
      $('.notification-container').children().toggleClass('d-none');
    }
  });
});

// Search message
$('#message input[type=search]').on('input', function() {
  const query = $(this).val();

  $('#message .card').each(function() {
    ($(this).data('search').search(new RegExp(query, 'i')) < 0) ? $(this).hide() : $(this).show();
  });
});

// Delete message
$('#message .delete').on('click', function() {
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
      const id = $(this).data('id');
      $('#message-' + id).fadeOut();
      $.ajax({
        url      : '/admin/core/message/destroy',
        method   : 'DELETE',
        dataType : 'json',
        data     : { id: id }
      });
    }
  });
});