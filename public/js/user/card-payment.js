$(document).ready(function () {
    // Login user id
    const userId = $('body').data('user-id');

    // Routes
    const orderCreateUrl = window.routes.orderCreateUrl;
    const stripeUrl = window.routes.stripeUrl;

    // Get total price of order
    const totalPrice = sessionStorage.getItem('order-total-price');

    // Initialize Stripe with your publishable key
    const stripe = Stripe(window.STRIPE_PUBLIC_KEY);
    const elements = stripe.elements();

    // Create the card element
    // Create a custom card element without the postal code field
    const cardElement = elements.create('card', {
        hidePostalCode: true,
    });

    // Mount the card element to the container
    cardElement.mount('#card-element');

    // Display card errors
    cardElement.on('change', function (event) {
        const displayError = $('#card-errors');
        if (event.error) {
            displayError.text(event.error.message);
        } else {
            displayError.text('');
        }
    });

    // Add price to show
    $('#submit-btn').text('Pay - ' + totalPrice + ' MMK');

    function getOrderData() {
        const orderDataFromSession = sessionStorage.getItem('order-data');

        return JSON.parse(orderDataFromSession);
    }

    $('#submit-btn').on('click', function (e) {
        e.preventDefault();

        stripe.createToken(cardElement).then(async function (result) {
            if (result.error) {
                // Inform the user if there was an error
                const errorElement = $('#card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server
                const token = result.token.id;
                const stripeTokenInput = $('#stripeToken');
                stripeTokenInput.value = token;

                const orderData = getOrderData();
                const data = {
                    price: totalPrice,
                    stripeToken: token,
                }

                await axios.post(stripeUrl, data)
                    .then(async (res) => {
                        await axios.post(orderCreateUrl, orderData)
                            .then(function (res) {
                                sessionStorage.removeItem('order-data', 'order-total-price');
                                localStorage.removeItem('cart_' + userId);
                                Swal.fire({ 
                                    title: 'Success',
                                    text: res.data.message,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    timer: 2000,
                                }).then(function () {
                                    window.location.href = '/orders';
                                })
                            })
                            .catch(function (e) {
                                console.log(e);
                            })
                    })
                    .catch((e) => {
                        if (e.response.status == 400) {
                            $('.alert-danger p').text(e.response.data.message);
                            $('.alert-danger').show(500);
                        }
                    })
            }
        });
    })
})