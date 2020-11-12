define([
    'Magento_Ui/js/form/element/abstract',
    'jquery'
], function (
    Abstract,
    $
) {
    'use strict';

    return Abstract.extend({
        defaults: {
            visible: true,
            dataType: 'text',
            required: false,
            code: 'location_information',
            globalScope: true,
            elementTmpl: 'Jajuma_VendorTableRate/components/exportcsv',
            labelVisible: false
        },

        selfAfterRender: function () {
            return true;
        }
    });
});
