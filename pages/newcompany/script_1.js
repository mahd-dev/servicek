page_script({
    init: function () {

        // handling geolocation picker

        if(!navigator.geolocation){
            var main = $("#find_my_position").parents(".input-group");
            main.before($("input",main));
            main.remove();
        }

        $('#geolocation').locationpicker({
            location: {latitude: 33.881967, longitude: 9.560764},
            radius: 0,
            zoom: 6,
            enableAutocomplete: true,
            inputBinding: {
                locationNameInput: $('#submit_form [name=address]'),
                latitudeInput: $('#submit_form [name=latitude]'),
                longitudeInput: $('#submit_form [name=longitude]'),
            }
        });
        $("#find_my_position").click(function (e) {
            e.preventDefault();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    $('#submit_form [name=latitude]').val(position.coords.latitude).change();
                    $('#submit_form [name=longitude]').val(position.coords.longitude).change();
                });
            }
        });


        // handling wizard
        var form = $('#submit_form');
        var error = $('.alert-danger', form);
        var success = $('.alert-success', form);

        form.validate({
            doNotHideMessage: true,
            /*errorElement: 'span',*/
            errorClass: 'help-block help-block-error',
            focusInvalid: true,
            rules: {
                
                name: {minlength: 3, maxlength: 255, required: true},
                description: {minlength: 50, maxlength: 4095, required: true},
                address: {required: true},
                longitude: {required: true},
                latitude: {required: true},
                tel: {required: true},
                email: {required: true},
                
                offer: {required: true},
                accept_contract: {required: true},
                
                credit_card_number: {required: true, creditcard: true},
                credit_card_password: {required: true}
                
            },

            invalidHandler: function (event, validator) { //display error alert on form submit   
                success.hide();
                error.show();
                app.scrollTo(error, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                
            },

            submitHandler: function (form) {
                success.show();
                error.hide();
                //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
            }

        });

        var displayConfirm = function() {
            $('#validation .form-control-static', form).each(function(){
                if($(this).attr("data-display")=="amount"){
                    $("strong", this).text($('[name="offer"]:checked', form).attr("data-amount"));
                    return;
                }

                var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                if (input.is(":radio")) {
                    input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                }
                if (input.is("select")) {
                    $("strong", this).text(input.find('option:selected').text());

                } else if (input.is(":radio") && input.is(":checked")) {
                    $("strong", this).text(input.attr("data-title"));

                }else{
                    $("strong", this).text(input.val());
                }
            });
        }

        var handleTitle = function(tab, navigation, index) {
            var total = navigation.find('li').length;
            var current = index + 1;
            // set wizard title
            $('.step-title', $('#page_wizard')).text('Step ' + (index + 1) + ' of ' + total);
            // set done steps
            jQuery('li', $('#page_wizard')).removeClass("done");
            var li_list = navigation.find('li');
            for (var i = 0; i < index; i++) {
                jQuery(li_list[i]).addClass("done");
            }

            if (current == 1) {
                $('#page_wizard').find('.button-previous').hide();
            } else {
                $('#page_wizard').find('.button-previous').show();
            }

            if (current >= total) {
                $('#page_wizard').find('.button-next').hide();
                $('#page_wizard').find('.button-submit').show();
                displayConfirm();
            } else {
                $('#page_wizard').find('.button-next').show();
                $('#page_wizard').find('.button-submit').hide();
            }
            app.scrollTo($('.page-title'));
        }

        $('#page_wizard').bootstrapWizard({
            'nextSelector': '.button-next',
            'previousSelector': '.button-previous',
            onTabClick: function (tab, navigation, index, clickedIndex) {
                return false;
            },
            onNext: function (tab, navigation, index) {
                success.hide();
                error.hide();

                if (form.valid() == false) {
                    return false;
                }

                handleTitle(tab, navigation, index);
            },
            onPrevious: function (tab, navigation, index) {
                success.hide();
                error.hide();

                handleTitle(tab, navigation, index);
            },
            onTabShow: function (tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                var $percent = (current / total) * 100;
                $('#page_wizard').find('.progress-bar').css({
                    width: $percent + '%'
                });
            }
        });

        $('#page_wizard').find('.button-previous').hide();
        $('#page_wizard .button-submit').hide();

        $('#submit_form').ajaxForm({
            success: function (rslt) {
                
            },
            error: function (rslt) {
                console.log(rslt);
            }
        });
    }
});
