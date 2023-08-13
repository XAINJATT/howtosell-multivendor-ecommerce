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
        MakeColorTable();
        MakeSizeTable();
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
