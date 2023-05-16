/**
 *Load billing details from session storage
 */
const loadBillingDetails = () => {
    const savedBillingDetails = sessionStorage.getItem('billing-details');

    if (savedBillingDetails) {
        const billingDetails = JSON.parse(savedBillingDetails);

        $('#name').val(billingDetails.name);
        $('#country').val(billingDetails.country);
        $('#state').val(billingDetails.state);
        $('#city').val(billingDetails.city);
        $('#address').val(billingDetails.address);
        $('#phone').val(billingDetails.phone);
        $('#note').val(billingDetails.note);
    }
}

$(document).ready(function () {
    // Remove build in select
    $('.nice-select').remove();

    // Get old data from session
    loadBillingDetails();

    // Add scrollable select
    $('#country, #state, #city').select2({
        dropdownCssClass: 'custom-dropdown-height',
    })

    // Listen for the change event on the country select box
    $('#country').on('change', function (e) {
        e.preventDefault();

        const country = $(this).val();
        const $stateSelect = $('#state');

        // Clear and disable the state select box if no country is chosen
        if (!country) {
            $stateSelect.empty().append('<option value="" selected>Choose State</option>').prop('disabled', true);
            return;
        }

        fetchStates(country, $stateSelect);
    })

    // Listen for the change event on the state select box
    $('#state').on('change', function (e) {
        e.preventDefault();

        const state = $(this).val();
        const $citySelect = $('#city');

        // Clear and disable the state select box if no country is chosen
        if (!state) {
            $citySelect.empty().append('<option value="" selected>Choose City</option>').prop('disabled', true);
            return;
        }

        fetchCities(state, $citySelect);
    })

    axios.get('/payment/status')
        .then(function (res) {
            const status = res.data.paymentComplete;
            $('#order-btn').data('payment-complete', status);
        })
        .catch(function (e) {
            console.log(e);
        })

    $('#order-btn').click(function (event) {
        event.preventDefault();

        // Find parent node for all
        $parentNode = $(this).parents('.checkout__form');

        // Get user id
        $user_id = $parentNode.find('#id').val();

        // Get data for billing details
        $name = $parentNode.find('#name').val();
        $country = $parentNode.find('#country').val();
        $state = $parentNode.find('#state').val();
        $city = $parentNode.find('#city').val();
        $address = $parentNode.find('#address').val();
        $phone = $parentNode.find('#phone').val();
        $note = $parentNode.find('#note').val();
        $password = $parentNode.find('#password').val();

        // Create data to pass
        $data = {
            'user_id': $user_id,
            'billingInfo': {
                'name': $name,
                'country': $country,
                'state': $state,
                'city': $city,
                'address': $address,
                'phone': $phone,
                'note': $note,
                'password': $password
            },
            'items': {}
        }

        saveBillingDetails($data);

        const paymentComplete = $(this).data('payment-complete')

        if (!paymentComplete) {
            Swal.fire({
                icon: 'error',
                title: 'Payment Incomplete',
                text: 'Please complete payment process first',
                confirmButtonText: 'Go to Payment',
            }).then((result) => {
                window.location.href = '/payment';
            })
        } else {
            axios.post('/order/create', $data)
                .then(function (res) {
                    sessionStorage.removeItem('billing-details');
                    sessionStorage.removeItem('payment-complete');
                })
                .catch(function (e) {
                    if (e.response.status === 422) {
                        displayValidationErrors(e.response.data.errors);
                    }
                })
        }
    })

    const displayValidationErrors = (errors) => {
        // Clear any existing errors
        const inputs = $('input, select');

        inputs.each(function () {
            $(this).removeClass('is-invalid');
            const nextElement = $(this).next();
            if (nextElement.hasClass('invalid-feedback')) {
                nextElement.remove();
            }
        })

        // Apply new errors
        for (const field in errors) {
            const errorMessage = errors[field][0];

            // Split the field string by the dot and use the last part
            const inputName = field.split('.').pop();

            // Find the input element by its id
            const inputElement = $(`#${inputName}`);

            if (inputElement.length) {
                inputElement.addClass('is-invalid');

                const errorContainer = $('<div></div>');
                errorContainer.addClass('invalid-feedback');
                errorContainer.text(errorMessage);

                if (inputElement.is('select')) {
                    inputElement.next().after(errorContainer);
                } else {
                    inputElement.after(errorContainer);
                }
            } else {
                console.warn('Input element not found');
            }
        }
    }

    /**
     * Save billing details to session storage
     * to get the old data when user go back 
     * checkout page
     * 
     * @param {*} data 
     */
    const saveBillingDetails = (data) => {
        const billingDetails = data.billingInfo;

        sessionStorage.setItem('billing-details', JSON.stringify(billingDetails));
    }

    const fetchStates = (country, $stateSelect) => {
        // Fetch state data
        axios.get(`/api/states/${country}`)
            .then(function (response) {
                const states = response.data;

                // Clear and enable the state select box
                $stateSelect.empty().append('<option value="" selected>Choose State</option>').prop('disabled', false);

                // Add states to the state select box
                states.forEach(function (state) {
                    $stateSelect.append(`<option value="${state}">${state}</option>`);
                });
            })
            .catch(function (error) {
                console.error('Error fetching states:', error);
            });
    }

    const fetchCities = (state, $citySelect) => {
        // Fetch state data
        axios.get(`/api/cities/${state}`)
            .then(function (response) {
                const cities = response.data;

                // Clear and enable the city select box
                $citySelect.empty().append('<option value="" selected>Choose City</option>').prop('disabled', false);

                // Add cities to the city select box
                cities.forEach(function (city) {
                    $citySelect.append(`<option value="${city}">${city}</option>`);
                });
            })
            .catch(function (error) {
                console.error('Error fetching states:', error);
            });
    }
})