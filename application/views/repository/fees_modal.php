<style>
    .btn {
        margin-top: 13px !important
    }
</style>
<!-- Modal -->
<div class="modal fade" id="feesform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="width:300px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Checkup Charges</h5>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="updatedFees" style="text-align: center;    font-size: 35px;font-weight: bolder;" value="<?php echo $doctor->fee; ?>" />
                <div class="text-center">
                    <button onclick="updateFees(<?php echo $doctor->patient_doctor_id; ?>)" class="btn btn-success">Update</button>
                    <button onclick='feesform.style.display="none"' class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                <div class="alert alert-info" id="feemsgbox" style="display:none;font-size:12px;margin-top: 5px;" role="alert">
                    <span id="feemsg"></span>
                </div>
            </div>
        </div>
    </div>
</div>