var FormValidation = function () {
    var initEvents = function() {
        //init Your account menu item events
        $('#btn_yourboxes').live('click', function(){
            var url = base_url + "user/yourboxes";

            var params = null;

            $('.list-manage-box').addClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });
        $('#btn_withdrawal').live('click', function(){
            var url = base_url + "user/withdrawal";

            var params = null;

            $('.list-manage-box').addClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });
        $('#changepassword').live('click', function(){
            var url = base_url + "user/changepassword";

            var params = null;

            $('.list-manage-box').addClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });
        $('#changeemail').live('click', function(){
            var url = base_url + "user/changeemail";

            var params = null;

            $('.list-manage-box').addClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });

        //init Manage Box menu item events
        $('#share_embed').live('click', function(){
            var url = base_url + "user/share_embed";

            var params = null;

            $('.list-manage-box').removeClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });

        $('#box_details').live('click', function(){
            var url = base_url + "user/box_details";

            var params = null;

            $('.list-manage-box').removeClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });

        $('#redirect_box').live('click', function(){
            var url = base_url + "user/redirect_box";

            var params = null;

            $('.list-manage-box').removeClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });

        $('#sell_once_only').live('click', function(){
            var url = base_url + "user/sell_once_only";

            var params = null;

            $('.list-manage-box').removeClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });

        $('#delete_content').live('click', function(){
            var url = base_url + "user/delete_content";

            var params = null;

            $('.list-manage-box').removeClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });


        //init yourboxes edit button's event
        $('#btn_box_edit').live('click', function(){
            var url = base_url + "user/boxedit";

            var params = null;

            $('.list-manage-box').removeClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });


        //init yourboxes add button's event
        $('#box_add').live('click', function(){
            var url = base_url + "user/box_add";

            var params = null;

            $('.list-manage-box').addClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
        });

        //init send my coins in balance withdrawal
        $('#btn_send_coin').live('click', function(){
            var url = base_url + "user/send_coin";

            var params = null;

            $('.list-manage-box').addClass('display-none');

            $.post(url, params, function(response) {
                $('.panel-body-right').html(response);
            });
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