$(document).ready(function () {
  $('form').submit(function (event) {
    $('.form-group').removeClass('is-invalid'); // remove the error class
    $('.error-block').remove(); // remove the error text
    $("#successMsg").remove(); // remove success message
    // get the data from self reporting form

    var formData = {
      username: $('input[name=username]').val(),
      title: $("select#title option").filter(":selected").val(),
      firstname: $('input[name=firstname]').val(),
      surname: $('input[name=surname]').val(),
      line1: $('input[name=line1]').val(),
      line2: $('input[name=line2]').val(),
      line3: $('input[name=line3]').val(),
      town: $('input[name=town]').val(),
      postcode: $('input[name=postcode]').val()
    };

    console.log(formData);

    // process the form
    $.ajax({
      type: 'POST',
      url: 'save-user.php',
      data: formData,
      dataType: 'json',
      encode: true,
    }).done(function (data) {
      if (!data.success) {
        // Errors for username ---------------
        if (data.errors.username) {
          $('#username').addClass('is-invalid'); // add the error class to show red input
          $('#username-group').append(
            '<div class="error-block"><strong>' +
            data.errors.username +
            '</strong></div>'
          );
        } else {
          // if no more error
          $('#username').removeClass('is-invalid');
          $('#username').addClass('is-valid'); // add success class
        }

        // Errors for title ---------------
        if (data.errors.title) {
          $('#title').addClass('is-invalid'); // add the error class to show red input
          $('#title-group').append(
            '<div class="error-block text-sm"><strong>' +
            data.errors.title +
            '</strong></div>'
          );
        } else {
          $('#title').removeClass('is-invalid'); // remove error class
          $('#title').addClass('is-valid'); // add success class
        }

        // Errors for firstname-----
        if (data.errors.firstname) {
          $('#firstname').addClass('is-invalid'); // add the error class to show red input
          $('#firstname-group').append(
            '<div class="error-block"><strong>' +
            data.errors.firstname +
            '</strong></div>'
          );
        } else {
          $('#firstname').removeClass('is-invalid'); // remove error class
          $('#firstname').addClass('is-valid'); // add success class
        }

        // Errors for surname ---------------
        if (data.errors.surname) {
          $('#surname').addClass('is-invalid'); // add the error class to show red input
          $('#surname-group').append(
            '<div class="error-block"><strong>' +
            data.errors.surname +
            '</strong></div>'
          );
        } else {
          $('#surname').removeClass('is-invalid'); // remove error class
          $('#surname').addClass('is-valid'); // add success class
        }

        // Errors for line1-----
        if (data.errors.line1) {
          $('#line1').addClass('is-invalid'); // add the error class to show red input
          $('#line1-group').append(
            '<div class="error-block"><strong>' +
            data.errors.line1 +
            '</strong></div>'
          );
        } else {
          $('#line1').removeClass('is-invalid'); // remove error class
          $('#line1').addClass('is-valid'); // add success class
        }

        // Errors for line2-----
        if (data.errors.line2) {
          $('#line2').addClass('is-invalid'); // add the error class to show red input
          $('#line2-group').append(
            '<div class="error-block"><strong>' +
            data.errors.line2 +
            '</strong></div>'
          );
        } else {
          $('#line2').removeClass('is-invalid'); // remove error class
          $('#line2').addClass('is-valid'); // add success class
        }

        // Errors for test result-----
        if (data.errors.line3) {
          $('#line3').addClass('is-invalid'); // add the error class to show red input
          $('#line3-group').append(
            '<div class="error-block"><strong>' +
            data.errors.line3 +
            '</strong></div>'
          );
        } else {
          $('#line3').removeClass('is-invalid'); // remove error class
          $('#line3').addClass('is-valid'); // add success class
        }

        // Errors for town-----
        if (data.errors.town) {
          $('#town').addClass('is-invalid'); // add the error class to show red input
          $('#town-group').append(
            '<div class="error-block"><strong>' +
            data.errors.town +
            '</strong></div>'
          );
        } else {
          $('#town').removeClass('is-invalid'); // remove error class
          $('#town').addClass('is-valid'); // add success class
        }

        // Errors for postcode-----
        if (data.errors.postcode) {
          $('#postcode').addClass('is-invalid'); // add the error class to show red input
          $('#postcode-group').append(
            '<div class="error-block"><strong>' +
            data.errors.postcode +
            '</strong></div>'
          );
        } else {
          $('#postcode').removeClass('is-invalid'); // remove error class
          $('#postcode').addClass('is-valid'); // add success class
        }

        if (data.errors.existingAddressUser) {
          $('#newUser').addClass('is-invalid'); // add the error class to show red input
          $('#newUser').append(
            '<div class="error-block"><strong> ERROR: </strong>' +
            data.errors.existingAddressUser +
            '</div>'
          );
        } else {
          $('#newUser').removeClass('is-invalid'); // remove error class
          $('#newUser').addClass('is-valid'); // add success class
        }
      } else {
        // Show success if form is submitted
        $('#success').addClass('is-invalid'); // add the error class to show red input
          $('#success').append(
            '<div class="alert alert-success" id="successMsg"><strong>' +
            data.message +
            '</strong></div>'
          );
          $('#newUserform').trigger("reset");
          $('.form-control').removeClass('is-invalid'); // remove the error class
          $('.form-control').removeClass('is-valid'); // remove the error class
      }
    });
    event.preventDefault();
  });
});
