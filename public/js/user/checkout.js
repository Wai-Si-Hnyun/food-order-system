$(document).ready(function () {
    // Login user id
    const userId = $('body').data('user-id');

    // routes
    const orderCreateUrl = window.routes.orderCreateUrl;

    // Check guset item and add to cart
    if (localStorage.getItem('cart_guest')) {
        const guestCart = JSON.parse(localStorage.getItem('cart_guest'));
        localStorage.setItem('cart_' + userId, JSON.stringify(guestCart));
        localStorage.removeItem('cart_guest');
    }

    var cart = JSON.parse(localStorage.getItem('cart_' + userId));
    /**
     *Load billing details from session storage
    **/
    const loadBillingDetails = () => {
        const savedBillingDetails = sessionStorage.getItem('billing-details');

        if (savedBillingDetails) {
            const billingDetails = JSON.parse(savedBillingDetails);

            $('#name').val(billingDetails.name);
            $('#state').val(billingDetails.state);
            $('#city').val(billingDetails.city);
            $('#address').val(billingDetails.address);
            $('#phone').val(billingDetails.phone);
            $('#note').val(billingDetails.note);
        }
    }

    (function () {
        var totalPrice = 0;
        cart.forEach((item, index) => {
            $('.checkout__total__products').append(
                `<li><samp>${index + 1}. </samp>${item.name} <span>${item.price * item.quantity}</span></li>`
            );

            totalPrice += item.price * item.quantity;
        });

        $('#total-price').text(`${totalPrice} MMK`);

        $('#cart-total-price').text(`${totalPrice} MMK`);

        sessionStorage.setItem('order-total-price', totalPrice);
    })();

    // Remove build in select
    $('.nice-select').remove();

    // Get old data from session
    loadBillingDetails();

    // Get States from myanmar
    const getStates = () => {
        const states = MyanmarCities.getRegions();
        if (states.length === 0) {
            $('#state').append(`<option value="">No State</option>`);
        } else {
            states.forEach(state => {
                $('#state').append(`<option id="${state.id}" value="${state.name_en}">${state.name_en}</option>`);
            });
        }
    };
    getStates();

    // Get cities by state id
    const getCities = (stateId) => {
        const cities = MyanmarCities.getCities(stateId);
        if (cities.length === 0) {
            $('#city').append(`<option value="">No City</option>`);
        } else {
            $('#city').empty();
            $('#city').append(`<option value="" selected>Choose City</option>`);
            cities.forEach(city => {
                $('#city').append(`<option value="${city.name_en}">${city.name_en}</option>`).prop('disabled', false);
            });
        }
    }

    // Add scrollable select
    $('#state, #city').select2({
        dropdownCssClass: 'custom-dropdown-height',
    })

    // Listen for the change event on the state select box
    $('#state').on('change', function (e) {
        e.preventDefault();

        const stateId = $('option:selected', this).attr('id');

        // Clear and disable the state select box if no country is chosen
        if (stateId == 0) {
            $$('#city').empty().append('<option value="" selected>Choose City</option>').prop('disabled', true);
            return;
        }
        getCities(stateId);
    })

    // Save order information in session storage
    const saveOrderDetails = (data) => {
        sessionStorage.setItem('order-data', JSON.stringify(data));
    }

    $('#order-btn').click(async function (event) {
        event.preventDefault();

        // Find parent node for all
        $parentNode = $(this).parents('.checkout__form');

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
            user_id: userId,
            billingInfo: {
                name: $name,
                country: $country,
                state: $state,
                city: $city,
                address: $address,
                phone: $phone,
                note: $note,
                password: $password
            },
            items: cart
        }

        saveOrderDetails($data);

        await axios.post(orderCreateUrl, $data)
            .then(function (res) {
                console.log(res.data);
            })
            .catch(function (e) {
                if (e.response.status == 422) {
                    displayValidationErrors(e.response.data.errors);
                } else if (e.response.status == 402) {
                    window.location.href = '/payment/choose';
                }
            })
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
            // return error is like billingdetails.name
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
})