var FormValidation = function () {
	var handleValidation1 = function() {
        // for more info visit the official plugin documentation: 
        // http://docs.jquery.com/Plugins/Validation

        var form1 = $('#changeonceonly-form');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);
		
        if (jQuery('#is_changed').val() == 1) {
        	success1.show();
        }

		form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                redirect_url: {
                    required: true
                }
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.parent(".input-group").size() > 0) {
                    error.insertAfter(element.parent(".input-group"));
                }else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success1.hide();
                error1.show();
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                success1.show();
                error1.hide();

                var url = "../save_sell_once_only_state";

	            if ($('#check_sell_once').attr('checked')!='checked'){
	            	var params = {
	            		check_state : 0,
	            		box_id : $('#check_sell_once').attr('box_id')
	            	};
	            }else{
	            	var params = {
	            		check_state : 1,
	            		box_id : $('#check_sell_once').attr('box_id')
	            	};
	            }
	            $.post(url, params, function(response) {

	            });

                return false;
            }
        });
    }

    var initEvents = function() {
    }
    return {
        //main function to initiate the module
        init: function () {
        	handleValidation1();
            initEvents();
        }
    };
}();

jQuery(document).ready(function() {
    FormValidation.init();
});