$(function() {
    $(document).on('click', '.delete-user', function(){
        var user_id = $(this).attr('user-id');
        var user_name = $(this).attr('user-name');
        var user_role = $(this).attr('user-role');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Bạn có chắc chắn?',
            text: user_name +" sẽ bị xóa , Bạn không thể hoàn lại được!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Không, hủy bỏ! ',
            reverseButtons: true,
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                if (user_role == "Customer") {
                    var id = '#delete-post-form-customer-' + user_id;
                    $(id).submit();
                    console.log(user_id);
                } else {
                   var id = '#delete-post-form-' + user_id;
                    $(id).submit();
                }
            }
        })
    });
});
