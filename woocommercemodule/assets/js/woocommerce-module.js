(function($){
    var $paymentForm = $('#woocommerce_module_seamless').closest('form');
    var $paymentFormSubmitButton = $("#place_order");
    var $paymentFormTokenInput = $('#woocommerce_module_token');
    var $woocommerceModuleErrors = $('#woocommerce_module_errors');
    var integrationKey = window.integrationKey;
    var initialized = false;

    var init = function() {
        if (integrationKey && !initialized) {
            $paymentFormSubmitButton.prop("disabled", false);
            woocommerceModuleSeamless.init(
                integrationKey,
                function () {
                    $paymentFormSubmitButton.prop("disabled", true);
                },
                function () {
                    $paymentFormSubmitButton.prop("disabled", false);
                });
        }
    };

    $paymentFormSubmitButton.on('click', function (e) {
        woocommerceModuleSeamless.submit(
            function (token) {
                $paymentFormTokenInput.val(token);
                $paymentForm.submit();
            },
            function (errors) {
                errors.forEach(function (error) {
                    $woocommerceModuleErrors.html(error.message);
                    console.error(error);
                });
            });
        return false;
    });

    var woocommerceModuleSeamless = function () {
        var payment;
        var validDetails;
        var validNumber;
        var validCvv;
        var _invalidCallback;
        var _validCallback;
        var $seamlessForm = $('#woocommerce_module_seamless');
        var $seamlessCardHolderInput = $('#woocommerce_module_seamless_card_holder', $seamlessForm);
        var $seamlessEmailInput = $('#woocommerce_module_seamless_email', $seamlessForm);
        var $seamlessExpiryInput = $('#woocommerce_module_seamless_expiry', $seamlessForm);
        var $seamlessCardNumberInput = $('#woocommerce_module_seamless_card_number', $seamlessForm);
        var $seamlessCvvInput = $('#woocommerce_module_seamless_cvv', $seamlessForm);

        var init = function (integrationKey, invalidCallback, validCallback) {
            _invalidCallback = invalidCallback;
            _validCallback = validCallback;

            if($seamlessForm.length > 0) {
                initialized = true;
            } else {
                return;
            }
            
            $seamlessCardNumberInput.height($seamlessCardHolderInput.css('height'));
            $seamlessCvvInput.height($seamlessCardHolderInput.css('height'));

            $seamlessForm.show();
            var style = {
                'border': $seamlessCardHolderInput.css('border'),
                'border-radius': $seamlessCardHolderInput.css('border-radius'),
                'height': $seamlessCardHolderInput.css('height'),
                'padding': $seamlessCardHolderInput.css('padding'),
                'font-size': $seamlessCardHolderInput.css('font-size'),
                'font-weight': $seamlessCardHolderInput.css('font-weight'),
                'font-family': $seamlessCardHolderInput.css('font-family'),
                'letter-spacing': '0.1px',
                'word-spacing': '1.7px',
                'color': $seamlessCardHolderInput.css('color'),
                'background': $seamlessCardHolderInput.css('background'),
            };
            payment = new PaymentJs("1.2");
            payment.init(integrationKey, $seamlessCardNumberInput.prop('id'), $seamlessCvvInput.prop('id'), function (payment) {
                payment.setNumberStyle(style);
                payment.setCvvStyle(style);
                payment.numberOn('input', function (data) {
                    validNumber = data.validNumber;
                    validate();
                });
                payment.cvvOn('input', function (data) {
                    validCvv = data.validCvv;
                    validate();
                });
            });
            $('input, select', $seamlessForm).on('input', validate);
        };

        var validate = function () {
            $woocommerceModuleErrors.html('');
            //$('.form-row', $seamlessForm).removeClass('woocommerce-invalid');
            //$seamlessCardNumberInput.closest('.form-row').toggleClass('woocommerce-invalid', !validNumber);
            //$seamlessCvvInput.closest('.form-row').toggleClass('woocommerce-invalid', !validCvv);
            validDetails = true;
            if (!$seamlessCardHolderInput.val().length) {
                //$seamlessCardHolderInput.closest('.form-row').addClass('woocommerce-invalid');
                validDetails = false;
            }
            if (!$seamlessExpiryInput.val().length) {
                //$seamlessExpiryInput.closest('.form-row').addClass('woocommerce-invalid');
                validDetails = false;
            }
            if (validNumber && validCvv && validDetails) {
                _validCallback.call();
                return;
            }
            // _invalidCallback.call();
        };

        var reset = function () {
            $seamlessForm.hide();
        };

        var submit = function (success, error) {
            var expiryData = $seamlessExpiryInput.val().split('/');
            payment.tokenize(
                {
                    card_holder: $seamlessCardHolderInput.val(),
                    month: expiryData[0],
                    year: '20' + expiryData[1],
                    email: $seamlessEmailInput.val()
                },
                function (token, cardData) {
                    success.call(this, token);
                },
                function (errors) {
                    error.call(this, errors);
                }
            );
        };

        return {
            init: init,
            reset: reset,
            submit: submit,
        };
    }();

    init();
})(jQuery);
