<?php
include 'view_config.php';
?>

<div id="tmpDiv"></div>
</div>
<footer class="footer">
    <!--<div class='alert alert-success hidden-xs hidden-sm hidden-print navbar-fixed-bottom'><div class='text-right'>Clinic Management System | &copy; 2014 Baratali Ghadamalizadeh. All Right Reserved.</div></div>-->
    <div class='alert alert-success hidden-md hidden-lg hidden-print'>
        <div class='text-right'>Dr Mushtaq Memon Child Care Clinic | &copy; 2022. All Right Reserved.</div>
    </div>
</footer>
</div>
<script src="<?php echo base_url() ?>content/js/main.js"></script>
<?php if (isset($script)) echo $script; ?>
<script>
    $.fn.enterKey = function(fnc) {
        return this.each(function() {
            $(this).keypress(function(ev) {
                var keycode = (ev.keyCode ? ev.keyCode : ev.which);
                if (keycode == '13') {
                    fnc.call(this, ev);
                }
            })
        })
    }
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    $(document).ready(function() {
        $("#goToPatient").on("keyup", function() {
            var patientName = $(this).val();
            // console.log(patientName);
            if (patientName != "") {
                $.ajax({
                    url: '<?php echo site_url("patient/patientsListByCardNo") ?>',
                    type: "POST",
                    data: {
                        cardNo: patientName,
                        [csrfName]: csrfHash
                    },
                    success: function(data) {
                        $("#patientList2").html(data);
                        $("#patientList2").fadeIn();
                    }
                });
            } else {
                $("#patientList2").html("");
                $("#patientList2").fadeOut();
            }
        });

        $("#patientName").on("keyup", function() {
            var patientName = $(this).val();
            // console.log(patientName);
            if (patientName != "") {
                $.ajax({
                    url: '<?php echo site_url("patient/patientList") ?>',
                    type: "POST",
                    data: {
                        patient: patientName,
                        [csrfName]: csrfHash
                    },
                    success: function(data) {
                        $("#patientList").html(data);
                        $("#patientList").fadeIn();
                    }
                });
            } else {
                $("#patientList").html("");
                $("#patientList").fadeOut();
            }
        });

        // click one particular city name it's fill in textbox
        $(document).on("click", ".listing2", function() {
            //var process = ($(this).text());
            // $('#goToPatient').val(process);

            var process = ($(this).text()).split(":");
            debugger;
            var id = ($(this)[0].id).split("-")[1];
            $('#goToPatient').val(process[0].trim() + ":" + id);

            // console.log($(this).text());
            $('#patientList2').fadeOut("fast");
        });

        // click one particular city name it's fill in textbox
        $(document).on("click", ".listing", function() {
            $('#patientName').val($(this).text());
            // console.log($(this).text());
            $('#patientList').fadeOut("fast");
        });

        $("#patientName").enterKey(function() {
            var id = parseInt($(this).val());
            if (id != '') {
                window.location.href = "<?php echo site_url("patient/panel") ?>" + '/' + id;
            }
        })
        $("#mrn").enterKey(function() {
            var id = parseInt($(this).val());
            if (id != '') {
                window.location.href = "<?php echo site_url("patient/print_prescription_pad") ?>" + '/' + id;
            }
        })
    });
    $('#myModal').on('hidden.bs.modal', function() {
        $("#mrn").val("");
    })

    function session(id) {
        $.ajax({
            url: '<?php echo site_url("home/session_management") ?>',
            type: "POST",
            data: {
                id,
                [csrfName]: csrfHash
            },
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                $('#msgbox').fadeIn();
                $("#msg").html(obj.message);
                $('#msgbox').fadeOut(5000);
            }
        });
    }

    function updateFees(patient_doctor_id) {

        let updatedFees = $("#updatedFees").val();

        $.ajax({
            url: '<?php echo site_url("home/fees_management") ?>',
            type: "POST",
            data: {
                patient_doctor_id,
                updatedFees,
                [csrfName]: csrfHash
            },
            success: function(data) {
                $('#currentFees').text(updatedFees);

                var obj = jQuery.parseJSON(data);
                $('#feemsgbox').fadeIn();
                $("#feemsg").html(obj.message);
                $('#feemsgbox').fadeOut(2500);

            }
        });
    }
</script>
<?php
include 'repository/session_modal.php';
include 'repository/fees_modal.php';

?>
</body>

</html>