jQuery(function ($) {
    $('#formsubmit').submit(function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Store original phone value and prepend dial code
        var originalPhone = $('#phone').val().trim();
        var dialCode = $('.selected-dial-code').text().trim();
        $('#phone').val(dialCode + originalPhone);

        $('#success-message').hide();

        // Show spinner loader
        $('#loading-spinner').show();

        // Serialize form data
        var formData = $(this).serialize();

        $.post({
            url: 'https://tentrade.com/restfulservice/v1/create-client.php',
            data: formData,
            success: function (response) {

                var status = response.status;

                if (status == 1) {

                    toastr.success('Registration successful');

                    dataLayer.push({
                        'event': 'generate_lead',
                        'userData': {
                            'sha256_email_address': response.data.sha256_email_address,
                            'sha256_phone_number': response.data.sha256_phone_number,
                        }
                    });

                }

            },
            error: function (xhr, status, error) {

                var arr = xhr.responseJSON.data.errors;
                var message = '';

                var errorMessages = $.map(arr, function (n) {
                    return n.message;
                });

                var finalMessage = errorMessages.length === 1
                    ? errorMessages[0]
                    : errorMessages.join(', ');

                toastr.error(finalMessage);

            }

        });
    });
});