$(function() {
    const currentRoute = window.location.pathname;
    if(!currentRoute.startsWith('/facility')) return

    const datatable = $("#facility-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `/facility`,
            type: 'GET',
            error: function(xhr, status, error) {

            }
        },
        "columns": [{
            "name": "number",
            "data": "number"
        },
            {
                "name": "name",
                "data": "name"
            },
            {
                "name": "detail",
                "data": "detail"
            },
            {
                "name": "status",
                "data": "status"
            },
            {
                "name": "price",
                "data": "price"
            },
            {
                "name": "id",
                "data": "id",
                "width": "100px",
                "render": function(facilityId) {
                    return `
                        <button class="btn btn-light btn-sm rounded shadow-sm border"
                            data-action="edit-facility" data-facility-id="${facilityId}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit facility">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form class="btn btn-sm delete-facility" method="POST"
                            id="delete-facility-form-${facilityId}"
                            action="/facility/${facilityId}">
                            <input type="hidden" name="_method" value="DELETE">
                            <a class="btn btn-light btn-sm rounded shadow-sm border delete"
                                href="#" facility-id="${facilityId}" type-role="type" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Delete facility">
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
        var facility_id = $(this).attr('facility-id');
        var facility_name = $(this).attr('facility-name');
        var facility_url = $(this).attr('facility-url');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Bạn có chắc chắn?',
            text: "Dịch vụ  sẽ bị xóa , Bạn không thể hoàn lại được!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Không, hủy bỏ! ',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#delete-facility-form-${facility_id}`).submit();
            }
        })
    }).on('click', '#add-button', async function() {
        modal.show()

        $('#main-modal .modal-body').html(`Fetching data`)

        const response = await $.get(`/facility/create`);
        if (!response) return

        $('#main-modal .modal-title').text('Thêm mới dịch vụ')
        $('#main-modal .modal-body').html(response.view)
        $('.select2').select2();
    }).on('click', '#btn-modal-save', function() {
        $('#form-save-facility').submit()
    }).on('submit', '#form-save-facility', async function(e) {

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
    }).on('click', '[data-action="edit-facility"]', async function() {
        modal.show()

        $('#main-modal .modal-body').html(`Fetching data`)

        const facilityId = $(this).data('facility-id')

        const response = await $.get(`/facility/${facilityId}/edit`);
        if (!response) return

        $('#main-modal .modal-title').text('Chỉnh sửa dịch vụ')
        $('#main-modal .modal-body').html(response.view)
        $('.select2').select2();
    }).on('submit', '.delete-facility', async function(e) {
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
