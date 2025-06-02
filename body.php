<body>
    <?php include __DIR__ . '/gtm_body.php'; ?>
    <?php include $pageContent; ?>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'https://tentrade.com/restfulservice/v1/get-location.php/',
                method: 'GET',
                success: function (response) {
                    if (response.status) {
                        const location = response.data;

                        // Example: auto-fill a country input field
                        $('#country').val(location.countryCode || 'IT');
                        $('#city').val(location.city || 'IT');
                    } else {
                        console.warn('Failed to get location:', response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        });
    </script>
    <script>
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

                            Toastify({
                                text: "Registration successful",
                                duration: 3000,
                                close: true,
                                gravity: "bottom", // `top` or `bottom`
                                position: "left", // `left`, `center` or `right`
                                style: {
                                    background: "#1b5e20",
                                },
                            }).showToast();

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

                        Toastify({
                            text: finalMessage,
                            duration: 3000,
                            close: true,
                            gravity: "bottom", // `top` or `bottom`
                            position: "left", // `left`, `center` or `right`
                            style: {
                                background: "#1b5e20",
                            },
                        }).showToast();
                    }

                });
            });
        });
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>