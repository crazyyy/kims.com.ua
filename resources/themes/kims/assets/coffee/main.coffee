$(document).on "ready", ->
  $(document).on 'click', '[name="contact-submit"]', (e) ->
    e.preventDefault()

    $form = $(this).closest 'form'
    data =
      _token: $form.find('[name="_token"]').val()
      fio: $form.find('[name="contact-name"]').val()
      phone: $form.find('[name="contact-phone"]').val()
      email: $form.find('[name="contact-email"]').val()
      message: $form.find('[name="contact-comment"]').val()

    $.ajax
      url: $form.attr('action')
      type: $form.attr('method')
      data: data
      dataType: 'json'
      success: (response) =>
        if response.status is 'success'
          $form.closest('.contact-popup.main-popup').removeAttr('data-active');

  console.log "init"