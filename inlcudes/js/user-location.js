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