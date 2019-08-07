var FormValidation = function () {
    var initEvents = function() {
    	$('#btn_clipboard').live('click', function(){
            //clipboardData.getData('Text', $('#text_pay_url').val());
        });
    }
    return {
        //main function to initiate the module
        init: function () {
            initEvents();
        }
    };
}();

jQuery(document).ready(function() {
    FormValidation.init();
});