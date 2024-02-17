$(document).on('click', 'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"]', function () {
    var data = {};
    var title1 = $(this).data("title");
    var title2 = $(this).data("bs-original-title");
    var title = (title1 != undefined) ? title1 : title2;
    var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');
    var url = $(this).data('url');
    let color = $(this).data("color");

    $("#colortype").val(color);
    $("#commonModal .modal-title").html(title);
    $("#commonModal .modal-dialog").addClass('modal-' + size);

    if ($('#vc_name_hidden').length > 0) {
        data['vc_name'] = $('#vc_name_hidden').val();
    }
    if ($('#warehouse_name_hidden').length > 0) {
        data['warehouse_name'] = $('#warehouse_name_hidden').val();
    }

    $.ajax({
        url: url,
        data: data,
        success: function (data) {
            $('#commonModal .modal-body').html(data['html_page']);
            $("#commonModal").modal('show');
        },
        error: function (data) {
            data = data.responseJSON;

            toastr.error("Something Went Wrong");
        }
    });
});

$(document).on('change', '.select_all', function (e) {
    var checkboxes = $(this).closest('table').find(':checkbox');
    checkboxes.prop('checked', $(this).is(':checked'));
    if ($(this).is(':checked')) {
        $("#delete_all").show();
    }
    else{
        $("#delete_all").hide();
    }
});

toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "newestOnTop": false,
}


// toastr.success("{{ session('success') }}");
// toastr.error("{{ session('error') }}");