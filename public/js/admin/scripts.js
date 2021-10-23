// Setup ajax header
$.ajaxSetup({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});



// Change height of textarea to fit content
$('#about-me textarea, #my-contact textarea').height($('textarea').prop('scrollHeight'));

$('textarea').on('input', function() {
  (this.scrollHeight > 120) && $(this).height(120).height(this.scrollHeight);
});

$('.modal').on('shown.bs.modal', function() {
  const textarea     = $(this).find('textarea');
  const scrollHeight = textarea.prop('scrollHeight');

  (scrollHeight !== 144) && textarea.height(scrollHeight);
});



// Initialize bootstrap tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});