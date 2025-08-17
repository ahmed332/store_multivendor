(function ($) {
    $('.item-quantity').on('change', function (e) {
        $.ajax({
            url: '/cart/' + $(this).data('id'),//data-id
            method: 'PUT',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
            },
            success: function (response) {
                console.log("Updated successfully ✅", response);
                // ممكن تحدث السعر/المجموع هنا
            },
            error: function (xhr) {
                console.error("Error ❌", xhr.responseText);
            }
        });

    });
    $('.remove-item').on('click', function (e) {
        let id = $(this).data('id');
        $.ajax({
            url: '/cart/' + id ,//data-id
            method: 'DELETE',
            data: {
                _token: csrf_token
            },
            success: function (response) {
                $(`#${id}`).remove();
                // ممكن تحدث السعر/المجموع هنا
            },
            error: function (xhr) {
                console.error("Error ❌", xhr.responseText);
            }
        });
        
    });
})(jQuery);
