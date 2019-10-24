define([
    'underscore',
    'jquery',
    'mage/utils/wrapper'
], function (_, $, wrapper) {
    'use strict';
    return function (placeOrderAction) {
        return wrapper.wrap(
            placeOrderAction,
            function (
                originalAction,
                paymentData,
                messageContainer
            ) {
                alert();

                paymentData = _.extend(paymentData, {
                    additional_data: {
                        'printed-invoice': $('#printed-invoice').prop('checked')
                    }
                });

                return originalAction(paymentData, messageContainer);
            }
        );
    };
});