<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<div>
    <form id="payment-form" action="">
    <div class="font-bold mt-12">Payment Details</div>
    <div class="form-group mt-4">
        <label for="card-element">Credit or Debit Card</label>
        <div id="card-element" class="mt-2"></div>
        <div id="card-errors" role="alert"></div>
    </div>
</div>
</form>
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
<script>
    (function(){
        let stripe = Stripe('pk_test_51HJHhqGuBOVjlmw2MrKUNmpu7LgiirPB2Q45ZlDwxB4yO63iZ2xTw8yNbPvr1oE3faedpI7FAo2PxGBVuISdxolo00d0EUTNif');
        let elements = stripe.elements();
        let style = {
            base:{
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }

        };
        let card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });

        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            let displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        let form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            // Disable the submit button to prevent repeated clicks
            document.getElementById('complete-order').disabled = true;
            //var options = {
            //     name: document.getElementById('name_on_card').value,
            //     address_line1: document.getElementById('address').value,
            //    address_city: document.getElementById('city').value,
            //    address_state: document.getElementById('province').value,
            //     address_zip: document.getElementById('postalcode').value
            // }
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;

                    document.getElementById('complete-order').disabled = false;
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        });
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }

    })();
</script>
</body>
</html>




