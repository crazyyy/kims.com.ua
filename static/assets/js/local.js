'use strict';

var Form;

Form = {};

Form.getFormData = function($form) {
  var data;
  data = new Object();
  $.each($form.serializeArray(), function(i, field) {
    return data[field.name] = field.value;
  });
  return data;
};

$(document).on("ready", function() {
  $(document).on('click', '[name="contact-submit"]', function(e) {
    var $form, data;
    e.preventDefault();
    $form = $(this).closest('form');
    data = {
      _token: $form.find('[name="_token"]').val(),
      fio: $form.find('[name="contact-name"]').val(),
      phone: $form.find('[name="contact-phone"]').val(),
      email: $form.find('[name="contact-email"]').val(),
      city: $form.find('[name="contact-сity"]').val(),
      message: $form.find('[name="contact-comment"]').val()
    };
    return $.ajax({
      url: $form.attr('action'),
      type: $form.attr('method'),
      data: data,
      dataType: 'json',
      success: function(_this) {
        return function(response) {
          if (response.status === 'success') {
            return $form.closest('.contact-popup.main-popup').removeAttr('data-active');
          }
        };
      }(this)
    });
  });
  return console.log("init");
});
