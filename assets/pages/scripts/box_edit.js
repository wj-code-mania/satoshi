var uploadForm = $('#uploadForm');
var FormValidation = function () {
	var check_rules = function(){
		if($("#is_show").attr('checked')!='checked'){
			$('.only_publish').removeClass('display-hide');
			uploadForm.validate().settings.rules = 
				{
					description: {
                        required: true
                    },
					msg_customers: {
                        required: true
                    },
                    box_title: {
                        required: true
                    },
					box_image: {
                        accept : true
                    }
                };
			}else{
				$('.only_publish').addClass('display-hide');
				uploadForm.validate().settings.rules = 
				{
                    description: {
                        required: true
                    },
					msg_customers: {
                        required: true
                    }
                };
			}
	}
    var uploadValidation1 = function() {
            var error1 = $('.alert-danger', uploadForm);
            var success1 = $('.alert-success', uploadForm);
			
            uploadForm.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    
                },
                rules: {
                    description: {
                        required: true
                    },
					msg_customers: {
                        required: true
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
					//success1.show();
					error1.hide();
					form.submit();
                }
            });
			check_rules();
    }
	var initEvents = function() {
		$("#is_show").live('change',function(){
			check_rules();
		});
	}
    return {
        //main function to initiate the module
        init: function () {
            uploadValidation1();
			initEvents();
        }
    };
}();

jQuery(document).ready(function() {
    FormValidation.init();
});