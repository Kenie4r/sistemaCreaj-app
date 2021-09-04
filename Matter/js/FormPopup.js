$(".Click-here").on('click', function() {
    $(".custom-model-main").addClass('model-open');
  }); 
  $(".close-btn, .bg-overlay").click(function(){
    $(".custom-model-main").removeClass('model-open');
  });