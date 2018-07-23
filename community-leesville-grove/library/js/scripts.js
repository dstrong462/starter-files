//=require "vendor/lazysizes.js"


$(document).ready(function () {

    // Track the Click to Call Event inside Analytics
    if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
        $('[href*="tel:"]').on('click', function () {
            console.log('Mobile Clicked');
            ga('send', 'event', 'Click-To-Call', 'Mobile Call', '');
            goog_report_conversion($(this).prop('href'));
            return false;
        });
    } else {
        $('[href*="tel:"]').on('click', function () {
            console.log('Desktop Clicked');
            return false;
        });
    }


    // CONTACT FORM CONTROLS
    // ===================================================

    var contact_forms = {

        settings: {
            required: $('form'),
            form_inputs: $('form .input-txt')
        },

        init: function() {
            if (this.settings.required.length) {
                contact_forms.bindUIActions();
                contact_forms.initializeLabels();
            }
        },

        bindUIActions: function() {
            // Activate rows on click
            this.settings.form_inputs.on('focus', contact_forms.toggleLabels);
            this.settings.form_inputs.on('blur', contact_forms.toggleLabels);
        },

        // On page load activate labels that have a value in them
        initializeLabels: function() {
            this.settings.form_inputs.each(function () {
                if ($(this).val().length) {
                    $(this).closest('.form-row').addClass('active');
                }
            });
        },

        toggleLabels: function(e) {
            // Check for empty inputs and deactivate labels on blur
            if (e.type == 'blur') {
                // If it's empty
                if (!$(this).val().length) {
                    $(this).closest('.form-row').removeClass('active');
                }
            } else {
                $(this).closest('.form-row').addClass('active');
            }
        }

    }
    contact_forms.init();

});