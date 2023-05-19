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
    const displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission
const form = document.getElementById('payment-form');
form.addEventListener('submit', function (event) {
    event.preventDefault();

    stripe.createToken(cardElement).then(function (result) {
        if (result.error) {
            // Inform the user if there was an error
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server
            const token = result.token.id;
            const stripeTokenInput = document.getElementById('stripeToken');
            stripeTokenInput.value = token;

            // Submit the form
            form.submit();
        }
    });
});