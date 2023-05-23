function onGooglePayLoaded() {
    $(document).ready(function () {
        const paymentsClient = new google.payments.api.PaymentsClient({
            environment: 'TEST', // Use 'PRODUCTION' for the production environment
        });

        const totalPrice = '0.5';

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
                currencyCode: 'USD',
                countryCode: 'US',
            };

            paymentsClient.loadPaymentData(paymentDataRequest)
                .then(paymentData => processPaymentData(paymentData))
                .catch(error => console.log('loadPaymentData error: ', error));
        }

        function processPaymentData(paymentData) {
            $data = {
                'paymentData': paymentData,
                'totalPrice': totalPrice,
            }

            axios.post('/payment/google-pay', $data)
                .then(function (res) {
                    if (res.status == 200) {
                        $('.alert-success').find('p').html(res.data.message);
                        $('.alert-success').addClass('show');
                    }
                })
                .catch(function (e) {
                    console.log(e);
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