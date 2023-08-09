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
        MakeCityTable();
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

    // CITY - START
    function MakeCityTable() {
        if ($("#city_table").length) {
            $("#city_table").DataTable({
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
                    "url": "{{route('city.all')}}",
                    "type": "POST",
                },
                'columns': [
                    {data: 'id'},
                    {data: 'city'},
                    {data: 'action', orderable: false},
                ],
            });
        }
    }

    function CheckForAdvanceDuplicateCity(id, value) {
        $.ajax({
            type: "post",
            url: "{{route('city.CheckForDuplicateCity')}}",
            data: { Id: id, Value: value},
            success: function (data) {
                if (data === 'Failed') {
                    $("#duplicateCityError").removeClass('d-none');
                    $("#city").focus();
                    $(".submitBtn").prop('disabled', true);
                } else {
                    $("#duplicateCityError").addClass('d-none');
                    $(".submitBtn").prop('disabled', false);
                }
            }
        });
    }

    function deleteCity(e){
        let id = e.split('||')[1];
        $("#deleteCityId").val(id);
        $("#deleteCityModal").modal('toggle');
    }
    // CITY - END

</script>
