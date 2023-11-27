$(function () {
    const currentRoute = window.location.pathname;
    if (!currentRoute.split("/").includes("room")) return;

    const datatable = $("#room-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `/room`,
            type: "GET",
            data: function (d) {
                d.status = $("#status").val();
                d.type = $("#type").val();
            },
            error: function (xhr, status, error) {},
            type: 'GET',
            error: function(xhr, status, error) {

            },
        },
        columns: [
            {
                name: "number",
                data: "number",
            },
            {
                name: "type",
                data: "type",
            },
            {
                name: "capacity",
                data: "capacity",
            },
            {
                name: "price",
                data: "price",
                render: function (price) {
                    return `<div>${new Intl.NumberFormat().format(
                        price
                    )}</div>`;
                },
            },
            {
                name: "status",
                data: "status",
            },
            {
                name: "location",
                data: "location",
            },
            {
                name: "id",
                data: "id",
                render: function (roomId) {
                    return `
                        <button class="btn btn-light btn-sm rounded shadow-sm border"
                            data-action="edit-room" data-room-id="${roomId}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit room">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form class="btn btn-sm delete-room" method="POST"
                            id="delete-room-form-${roomId}"
                            action="/room/${roomId}">
                            <input type="hidden" name="_method" value="DELETE">
                            <a class="btn btn-light btn-sm rounded shadow-sm border delete"
                                href="#" room-id="${roomId}" room-name =  room-role="room" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Delete room">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </form>
                        <a class="btn btn-light btn-sm rounded shadow-sm border"
                            href="/room/${roomId}"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Homestay detail">
                            <i class="fas fa-info-circle"></i>
                        </a>

                    `;
                },
            },
        ],
    });
    $(document).on('change','#filter-type', async function (){
        var selectedType = $(this).val();
        console.log(selectedType);
        // Gửi giá trị đã chọn lên server bằng AJAX
        const response = await $.ajax({
            url: '/room', // Điều này cần được thay thế bằng địa chỉ endpoint của bạn
            method: 'GET',
            data: { filter_type: selectedType },
            success: function(data) {
                // Xử lý dữ liệu trả về từ server và cập nhật bảng DataTables (nếu cần)
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi nếu cần
            }
        });
        console.log(response);
        datatable.ajax.reload()
    })








    const modal = new bootstrap.Modal($("#main-modal"), {
        backdrop: true,
        keyboard: true,
        focus: true,
    });

    $(document)
        .on("click", ".delete", function () {
            var room_id = $(this).attr("room-id");
            var room_name = $(this).attr("room-name");
            var room_url = $(this).attr("room-url");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });

            swalWithBootstrapButtons
                .fire({

                    title: 'Bạn có chắc chắn?',
                    text:  "Homestay sẽ bị xóa , Bạn không thể hoàn lại được!",
                    icon: 'warning',

                    showCancelButton: true,
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Không, hủy bỏ! ',
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $(`#delete-room-form-${room_id}`).submit();
                    }
                });
        })
        .on("click", "#add-button", async function () {
            modal.show();

            $("#main-modal .modal-body").html(`Fetching data`);

            const response = await $.get(`/room/create`);
            if (!response) return;

            $("#main-modal .modal-title").text("Create new homestay");
            $("#main-modal .modal-body").html(response.view);
            $(".select2").select2();
        })
        .on("click", "#btn-modal-save", function () {
            $("#form-save-room").submit();
        })
        .on("submit", "#form-save-room", async function (e) {
            e.preventDefault();
            CustomHelper.clearError();
            $("#btn-modal-save").attr("disabled", true);
            try {
                const response = await $.ajax({
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    method: $(this).attr("method"),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                if (!response) return;

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500,
                });

                modal.hide();
                datatable.ajax.reload();
            } catch (e) {
                if (e.status === 422) {
                    console.log(e);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: e.responseJSON.message,
                    });
                    CustomHelper.errorHandlerForm(e);
                }
            } finally {
                $("#btn-modal-save").attr("disabled", false);
            }
        })
        .on("click", '[data-action="edit-room"]', async function () {
            modal.show();

            $("#main-modal .modal-body").html(`Fetching data`);

            const roomId = $(this).data("room-id");

            const response = await $.get(`/room/${roomId}/edit`);
            if (!response) return;

            $("#main-modal .modal-title").text("Edit homestay");
            $("#main-modal .modal-body").html(response.view);
            $(".select2").select2();
        })
        .on("submit", ".delete-room", async function (e) {
            e.preventDefault();

            try {
                const response = await $.ajax({
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    method: $(this).attr("method"),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                if (!response) return;

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500,
                });

                datatable.ajax.reload();
            } catch (e) {}
        })
        .on("change", "#status", function () {
            datatable.ajax.reload();
        })
        .on("change", "#type", function () {
            datatable.ajax.reload();
        });
});
