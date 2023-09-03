<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // INITIALIZE SELECT 2
        $(".select2").select2();

        // User Change Password
        $("form#changePasswordForm").submit(function (e) {
            // Check for Password Match
            let NewPassword = $("#newPassword").val();
            let ConfirmPassword = $("#confirmPassword").val();
            if (NewPassword === ConfirmPassword) {
                $("#changePasswordError").hide();
            } else {
                $("#changePasswordError").show();
                e.preventDefault(e);
            }
        });

        // Hide Alerts
        setInterval(function(){ $(".alert-success").hide(); }, 5000);
        setInterval(function(){ $(".alert-danger").hide(); }, 5000);

        // TABLES
        MakeCategoryTable();
        MakeProductTable();
        MakeStockTable();
        MakeCouponTable();
        MakeRoleTable();
        MakePermissionTable();
        MakeOrderTable();
        MakeColorTable();
        MakeSizeTable();
        MakeCompanyTable();
        MakeLanguageTable();
        MakeWebLangDetailTable();
    });

    function SetDatePicker(Id, Today = '', Start = '', End = '') {
        let Object = $('#' + Id);
        let Options = {
            format: "dd-mm-yyyy",
            todayHighlight: true,
            autoclose: true,
        };
        if(Start !== '') {
            Options['startDate'] = Start;
        }
        if(End !== '') {
            Options['endDate'] = End;
        }
        Object.datepicker(Options);
        if(Today !== '') {
            Object.datepicker('setDate', Today);
        }
    }

    function ReadUrl(input, Preview, Browse) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#" + Preview).show().attr('src', e.target.result).fadeIn('slow');
                $("#" + Browse).hide();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // CATEGORY - START
    function MakeCategoryTable() {
        if ($("#category_table").length) {
            $("#category_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('category.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'image', orderable: false},
                    {data: 'name'},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function CheckForAdvanceDuplicateCategory(id, value) {
        $.ajax({
            type: "post",
            url: "{{route('category.CheckForDuplicateCategory')}}",
            data: { Id: id, Value: value},
            success: function (data) {
                if (data === 'Failed') {
                    $("#duplicateCategoryError").removeClass('d-none');
                    $("#category").focus();
                    $(".submitBtn").prop('disabled', true);
                } else {
                    $("#duplicateCategoryError").addClass('d-none');
                    $(".submitBtn").prop('disabled', false);
                }
            }
        });
    }

    function deleteCategory(e){
        let id = e.split('||')[1];
        $("#deleteCategoryId").val(id);
        $("#deleteCategoryModal").modal('toggle');
    }
    // CATEGORY - END

    // COMPANY - START
    function MakeCompanyTable() {
        if ($("#company_table").length) {
            $("#company_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('company.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'image', orderable: false},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function deleteCompany(e){
        let id = e.split('||')[1];
        $("#deleteCompanyId").val(id);
        $("#deleteCompanyModal").modal('toggle');
    }
    // COMPANY - END

    // PRODUCT - START
    function MakeProductTable() {
        if ($("#product_table").length) {
            $("#product_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('product.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'image'},
                    {data: 'name'},
                    {data: 'price'},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function deleteProduct(e){
        let id = e.split('||')[1];
        $("#deleteProductId").val(id);
        $("#deleteProductModal").modal('toggle');
    }
    // PRODUCT - END

    // STOCK - START
    function MakeStockTable() {
        if ($("#stock_table").length) {
            $("#stock_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('stock.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'image', orderable: false },
                    {data: 'name'},
                    {data: 'price'},
                    {data: 'discounted_price'},
                    {data: 'short_description'},
                    {data: 'soh'},
                    { data: 'input', orderable: false },
                ],
            });
        }
    }
    // STOCK - END

    // ORDER - START
    function MakeOrderTable() {
        if ($("#order_table").length) {
            $("#order_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('order.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'order_status' },
                    {data: 'subtotal'},
                    {data: 'shipping_amount'},
                    {data: 'total'},
                    {data: 'order_description'},
                    {data: 'payment_status'},
                    { data: 'delivery_note' },
                ],
            });
        }
    }
    // ORDER - END

    // Permission - START
    function MakePermissionTable() {
        if ($("#permission_table").length) {
            $("#permission_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('permission.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'guard_name'},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function deletePermission(e){
        let id = e.split('||')[1];
        $("#deletePermissionId").val(id);
        $("#deletePermissionModal").modal('toggle');
    }
    // Permission - END

    // ROLE - START
    function MakeRoleTable() {
        if ($("#role_table").length) {
            $("#role_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('role.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function deleteRole(e){
        let id = e.split('||')[1];
        $("#deleteRoleId").val(id);
        $("#deleteRoleModal").modal('toggle');
    }
    // ROLE - END

    // COUPON - START
    function MakeCouponTable() {
        if ($("#coupon_table").length) {
            $("#coupon_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('coupon.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'coupon_code'},
                    {data: 'discount_amount'},
                    {data: 'start_date'},
                    {data: 'end_date'},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function deleteCoupon(e){
        let id = e.split('||')[1];
        $("#deleteCouponId").val(id);
        $("#deleteCouponModal").modal('toggle');
    }
    // COUPON - END

    // LANGUAGE - START
    function MakeLanguageTable() {
        if ($("#language_table").length) {
            $("#language_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('language.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function deleteLanguage(e){
        let id = e.split('||')[1];
        $("#deleteLanguageId").val(id);
        $("#deleteLanguageModal").modal('toggle');
    }
    // LANGUAGE - END

        // LANGUAGE - START
        function MakeWebLangDetailTable() {
        if ($("#WebLangDetail_table").length) {
            $("#WebLangDetail_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('website_extra_localization.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'detail'},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function deleteWebLangDetail(e){
        let id = e.split('||')[1];
        $("#deleteWebLangDetailId").val(id);
        $("#deleteWebLangDetailModal").modal('toggle');
    }
    // LANGUAGE - END

    // COLOR - START
    function MakeColorTable() {
        if ($("#color_table").length) {
            $("#color_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('color.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function deleteColor(e){
        let id = e.split('||')[1];
        $("#deleteColorId").val(id);
        $("#deleteColorModal").modal('toggle');
    }
    // COLOR - END

    // SIZE - START
    function MakeSizeTable() {
        if ($("#size_table").length) {
            $("#size_table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": true,
                "bPaginate": true,
                "ordering": true,
                "pageLength": 50,
                "lengthMenu": [
                    [50, 100, 200, 400],
                    ['50', '100', '200', '400']
                ],
                "ajax": {
                    "url": "{{route('size.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function deleteSize(e){
        let id = e.split('||')[1];
        $("#deleteSizeId").val(id);
        $("#deleteSizeModal").modal('toggle');
    }
    // SIZE - END

</script>
