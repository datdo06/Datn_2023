$(function() {
    const currentRoute = window.location.pathname;
    if(!currentRoute.startsWith('/coupon')) return

    const datatable = $("#coupon-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `/coupon`,
            type: 'GET',
            error: function(xhr, status, error) {

            }
        },
        "columns": [{
            "name": "number",
            "data": "number"
        },
            {
                "name": "coupon_name",
                "data": "coupon_name"
            },
            {
                "name": "coupon_time",
                "data": "coupon_time"
            },
            {
                "name": "coupon_code",
                "data": "coupon_code"
            },
            {
                "name": "coupon_number",
                "data": "coupon_number"
            },
            {
                "name": "coupon_condition",
                "data": "coupon_condition"
            },
            {
                "name": "start_time",
                "data": "start_time"
            },
            {
                "name": "end_time",
                "data": "end_time"
            },
            {
                "name": "id",
                "data": "id",
                "width": "100px",
                "render": function(couponId) {
                    return `
                        <button class="btn btn-light btn-sm rounded shadow-sm border"
                            data-action="edit-coupon" data-coupon-id="${couponId}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit coupon">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form class="btn btn-sm delete-coupon" method="POST"
                            id="delete-coupon-form-${couponId}"
                            action="/coupon/${couponId}">
                            <input type="hidden" name="_method" value="DELETE">
                            <a class="btn btn-light btn-sm rounded shadow-sm border delete"
                                href="#" coupon-id="${couponId}" type-role="type" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Delete coupon">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </form>

                    `
                }
            }
        ]
    });

    const modal = new bootstrap.Modal($("#main-modal"), {
        backdrop: true,
        keyboard: true,
        focus: true
    })

    $(document).on('click', '.delete', function() {
        var coupon_id = $(this).attr('coupon-id');
        var coupon_name = $(this).attr('coupon-name');
        var coupon_time = $(this).attr('coupon_time');
        var coupon_code = $(this).attr('coupon_code');
        var coupon_code = $(this).attr('coupon_number');
        var coupon_condition = $(this).attr('coupon_condition');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "District will be deleted, You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel! ',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#delete-coupon-form-${coupon_id}`).submit();
            }
        })
    }).on('click', '#add-button', async function() {
        modal.show()

        $('#main-modal .modal-body').html(`Fetching data`)

        const response = await $.get(`/coupon/create`);
        if (!response) return

        $('#main-modal .modal-title').text('Create new coupon')
        $('#main-modal .modal-body').html(response.view)
        $('.select2').select2();
    }).on('click', '#btn-modal-save', function() {
        $('#form-save-coupon').submit()
    }).on('submit', '#form-save-coupon', async function(e) {
        e.preventDefault();
        CustomHelper.clearError()
        $('#btn-modal-save').attr('disabled', true)
        try {
            const response = await $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                method: $(this).attr('method'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })

            if (!response) return

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
            })

            modal.hide()
            datatable.ajax.reload()
        } catch (e) {
            if (e.status === 422) {
                console.log(e)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: e.responseJSON.message,
                })
                CustomHelper.errorHandlerForm(e)
            }
        } finally {
            $('#btn-modal-save').attr('disabled', false)
        }
    }).on('click', '[data-action="edit-coupon"]', async function() {
        modal.show()
        $('#main-modal .modal-body').html(`Fetching data`)
        const couponId = $(this).data('coupon-id')
        const response = await $.get(`/coupon/${couponId}/edit`);
        if (!response) return

        $('#main-modal .modal-title').text('Edit coupon')
        $('#main-modal .modal-body').html(response.view)
        $('.select2').select2();
    }).on('submit', '.delete-coupon', async function(e) {
        e.preventDefault()

        try {
            const response = await $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                method: $(this).attr('method'),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            })

            if (!response) return

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
            })

            datatable.ajax.reload()
        } catch (e) {
            if(e && e.responseJSON && e.responseJSON.message) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: e.responseJSON.message,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    })
});
