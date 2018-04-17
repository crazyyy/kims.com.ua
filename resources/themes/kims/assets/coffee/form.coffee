Form = {}

Form.getFormData = ($form) ->
  data = new Object()
  $.each $form.serializeArray(), (i, field) ->
    data[field.name] = field.value
  return data