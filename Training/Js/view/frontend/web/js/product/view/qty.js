define([
    'uiComponent',
    'mage/storage',
    'underscore'
], function (Component, storage, _) {
    'use strict';

    return Component.extend({
        initialize: function (config) {
            this._super();
            this.observe([
                'isDisabledButton',
                'currentQty'
            ]);

            this.currentQty(null);
            this.isDisabledButton(false);

            this.actionPath = config.actionPath;

            return this;
        },

        showAvailableQty: _.debounce(function (component, event) {
            var self = this;

            self.isDisabledButton(true);

            self._getQty(
                self.getCurrentProductId()
            ).done(function (response) {
                self.currentQty(response.qty);
            }).fail(function (response) {
                self.currentQty(null);
            }).always(function () {
                self.isDisabledButton(false);
            });
        }, 1000, true),

        getCurrentProductId: function () {
            return document.getElementsByName('product')[0].value;
        },

        _getQty: function (productId) {
            return storage.get(this.actionPath + '/productId/' + productId);
        }
    });
});