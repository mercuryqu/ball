$(function() {
    // show delete modal and get name and action of from needed
    $('#confirm-delete-modal').on('show.bs.modal', function (e) {
        $(this).find('.modal-name').text($(e.relatedTarget).data('name'));
        $(this).find('#deleteModalForm').attr('action', $(e.relatedTarget).data('href'));
    });

    // show change modal and get name and action of from needed
    $('#confirm-change-modal').on('show.bs.modal', function (e) {
        $(this).find('.modal-name').text($(e.relatedTarget).data('name'));
        $(this).find('#changeModalForm').attr('action', $(e.relatedTarget).data('href'));
    });

    // return back to pre page
    $('.btn-cancel').click(function () {
        history.back();
    });

    // add csrf token to ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // click to update sort
    $(".sort").click(function() {
        // ajax route config url
        var ajax_update_sort_url = 'common/sort';
        var module = get_module_name();
        var td = $(this);
        var td_value = td.text();
        var input = $("<input type='number' class='form-control col-sm-1' value='" + td_value + "'/>");
        td.html(input);
        input.click(function() { return false; });
        input.trigger("focus");
        input.blur(function() {
            var update_value = $(this).val();
            if (update_value != '' && update_value != td_value) {
                var td_obj = td.siblings()[0];
                var caid = $(td_obj).text();
                $.post(ajax_update_sort_url, {'id':caid, 'sort': update_value, 'module': module}, function(data) {
                    var code = data.code;
                    var message = data.message;
                    if (code == 80015 || code == 80005) {
                        alert(message);return;
                    } else if (code == 80004) {
                        td.html(update_value);
                    }
                });
            }
            td.html(update_value ? update_value : td_value);
        });
    });

    /**
     * Function Modules
     * All global function.
     */

    /**
     * Get Module Name
     * @returns {string} module name
     */
    function get_module_name()
    {
        var pathname = window.location.pathname;
        return pathname.replace('/admin/', '');
    }
});