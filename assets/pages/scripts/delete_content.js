var FormValidation = function () {
    var initEvents = function() {

        $('#btn_confirm').live('click', function(){
            $('#del_box_from_box_id').submit();
        });
        $('#a_delete_content').live('click', function(){
            jQuery('#modal-1').modal('show', {backdrop: 'fade'});
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