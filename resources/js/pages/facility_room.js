$(function() {
    const currentRoute = window.location.pathname;
    if(!currentRoute.startsWith('/facility_room')) return

    const datatable = $("#facilityRoom-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `/facility_room`,
            type: 'GET',
            error: function(xhr, status, error) {

            }
        },
        "columns": [{
            "name": "number",
            "data": "number"
        },
            {
                "name": "homestay",
                "data": "homestay"
            },
            {
                "name": "facility",
                "data": "facility"
            },
            {
                "name": "id",
                "data": "id",
                "width": "100px",
                "render": function(facilityRoomId) {
                    return `
                        <button class="btn btn-light btn-sm rounded shadow-sm border"
                            data-action="edit-facility-room" data-facility-room-id="${facilityRoomId}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Facility Room">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form class="btn btn-sm delete-facility_room" method="POST"
                            id="delete-facility-room-form-${facilityRoomId}"
                            action="/facility_room/${facilityRoomId}">
                            <input type="hidden" name="_method" value="DELETE">
                            <a class="btn btn-light btn-sm rounded shadow-sm border delete-facility-room"
                                href="#" facility_room_id="${facilityRoomId}" type-role="type" data-bs-toggle="tooltip"
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
    $(document).on('click', '.delete-facility-room', function() {
        var facility_room_id = $(this).attr('facility_room_id');
        console.log(facility_room_id);
        var facility_room_url = $(this).attr('facility_room-url');
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
                $(`#delete-facility-room-form-${facility_room_id}`).submit();
            }
        })
    }).on('click', '#add-facility-room', async function() {
        modal.show()
        $('#main-modal .modal-body').html(`Fetching data`)
        const response = await $.get(`/facility_room/create`);
        if (!response) return
        $('#main-modal .modal-title').text('Thêm mới dịch vụ cho homestay')
        $('#main-modal .modal-body').html(response.view)
        $('.select2').select2();
    }).on('click', '#btn-modal-save', function() {
        $('#form-save-facility-room').submit()
    }).on('submit', '#form-save-facility-room', async function(e) {
        modal.hide()
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
            datatable.ajax.reload()
            modal.hide()
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
    }).on('click', '[data-action="edit-facility-room"]', async function() {
        modal.show()
        $('#main-modal .modal-body').html(`Tải dữ liệu`)
        var facilityRoomID = $(this).data('facility-room-id')
        const response = await $.get(`/facility_room/${facilityRoomID}/edit`);
        if (!response) return
        $('#main-modal .modal-title').text('Sửa dịch vụ của homestay')
        $('#main-modal .modal-body').html(response.view)
        $('.select2').select2();
    }).on('submit', '.delete-facility_room', async function(e) {
        e.preventDefault()
        try {
            const response = await $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                method: $(this).attr('method'),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            })
            console.log(response);
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
