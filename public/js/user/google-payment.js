function onGooglePayLoaded() {
    $(document).ready(function () {
        // Login user id
        const userId = $('body').data('user-id');

        // routes
        const orderCreateUrl = window.routes.orderCreateUrl;
        const googlePayUrl = window.routes.googlePayUrl;

        const paymentsClient = new google.payments.api.PaymentsClient({
            environment: 'TEST', // Use 'PRODUCTION' for the production environment
        });

        const totalPrice = sessionStorage.getItem('order-total-price');

        // Show total price
        $('#order-total-price').text('Total Cost - ' + totalPrice + ' MMK');

        const tokenizationSpecification = {
            type: 'PAYMENT_GATEWAY',
            parameters: {
                "gateway": "stripe",
                "stripe:version": "2018-10-31",
                "stripe:publishableKey": "pk_test_51N7MngLo4CmY8dpTLlk1c7NT4zCbDeGihUKCwMTByyvYud7WDgVxQNH2m2hkSigDQeltAxiwoXmFc4x0wWCi5VJp00Rw5fQb0G"
            },
        }

        const cardPaymentMethod = {
            type: 'CARD',
            parameters: {
                allowedAuthMethods: ['PAN_ONLY', 'CRYPTOGRAM_3DS'],
                allowedCardNetworks: ['MASTERCARD', 'VISA'],
            },
            tokenizationSpecification: tokenizationSpecification,
        }

        const googlePayConfig = {
            apiVersion: 2,
            apiVersionMinor: 0,
            allowedPaymentMethods: [cardPaymentMethod],
        }

        function createAndAddButton() {
            const googlePayButton = paymentsClient.createButton({
                onClick: onGooglePayButtonClicked,
            })

            $('#pay-button').append(googlePayButton);
        }

        function onGooglePayButtonClicked() {
            const paymentDataRequest = { ...googlePayConfig };
            paymentDataRequest.merchantInfo = {
                merchantId: 'BCR2DN4TWLNN5JQ5',
                merchantName: 'Cake Shop',
            };

            paymentDataRequest.transactionInfo = {
                totalPriceStatus: 'FINAL',
                totalPrice: totalPrice,
                currencyCode: 'MMK',
                countryCode: 'MM',
            };

            paymentsClient.loadPaymentData(paymentDataRequest)
                .then(paymentData => processPaymentData(paymentData))
                .catch(error => console.log('loadPaymentData error: ', error));
        }

        function loadOrderData() {
            const orderDataFromSession = sessionStorage.getItem('order-data');

            return JSON.parse(orderDataFromSession);
        }

        function processPaymentData(paymentData) {
            $data = {
                'paymentData': paymentData,
                'totalPrice': totalPrice,
            }

            var orderData = loadOrderData();

            // Show loading spin
            $('.gpay-card-info-container').prop('disabled', true);
            $('#spinner').removeClass('d-none');

            axios.post(googlePayUrl, $data)
                .then(function (res) {
                    if (res.status == 200) {
                        axios.post(orderCreateUrl, orderData)
                            .then(function (res) {
                                $('#spinner').addClass('d-none');
                                $('.gpay-card-info-container').prop('disabled', false);
                                sessionStorage.removeItem('order-data', 'order-total-price');
                                localStorage.removeItem('cart_' + userId);
                                Swal.fire({
                                    title: 'Success',
                                    text: res.data.message,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    timer: 2000,
                                }).then(res => {
                                    window.location.href = '/orders';
                                })
                            })
                            .catch(err => {
                                console.log(err);
                                if (err.response.status == 402) {
                                    window.location.href = '/payment/choose';
                                }
                            })
                    }
                })
                .catch(function (e) {
                    if (e.response.status == 400) {
                        $('.alert-danger p').text(e.response.data.message);
                        $('.alert-danger').show(500);
                    }
                })
        }

        paymentsClient.isReadyToPay(googlePayConfig)
            .then(function (response) {
                if (response.result) {
                    createAndAddButton();
                } else {
                    console.error('Google Pay is not ready to pay');
                    window.location.herf = "/payment/choose";
                }
            }).catch(function (e) {
                console.error('Error checking if Google Pay is ready to pay:', e);
            })
    })
}