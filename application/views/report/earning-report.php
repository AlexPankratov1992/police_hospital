<legend><?php echo "- ".@$title;?></legend>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 style="margin-top: 0px;">Dr. Ashfaq Memon Clinic</h3>
        </div>
        <div class="col-md-6">
            <table class="table tables text-right">
                <tr>
                    <td>Time: </td>
                    <td>
                        <?php echo date('h:i a'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Date: </td>
                    <td>
                        <?php echo date('d-m-Y'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Session: </td>
                    <td style="width: 50%">
                        <select class="form-control" name="" id="">
                            <option value="">Select Session</option>
                            <option value="morning">Morning (5 am to 11:59 pm)</option>
                            <option value="evening">Afternoon (12 pm to 4:59 pm)</option>
                            <option value="evening">Evening (5 pm to 8:59 pm)</option>
                            <option value="afternoon">Night (9 pm to 4:59 am)</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h4 style="margin-top: 0px;">Daily Report</h4>
        </div>
        <div class="col-md-6">
            <table class="table tables text-right">
                <tr>
                    <td>Total Patients: </td>
                    <td>
                        <?php echo $list->num_rows(); ?>
                    </td>
                </tr>
                <tr>
                    <td>Total Receipt Amount: </td>
                    <td>
                        <?php echo $total; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>MR Number</th>
                        <th>Receipt Number</th>
                        <th>Receipt Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($list->result_array())){
                            foreach ($list->result_array() as $l){
                            $total += $l['fees'];
                    ?>
                        <tr>
                            <td><?php echo $l['first_name'] . " " . $l['last_name']; ?></td>
                            <td><?php echo $l['visit_date'] ?></td>
                            <td><?php echo $l['patient_id']; ?></td>
                            <td><?php echo $l['receipt_num']; ?></td>
                            <td><?php echo $l['fees']; ?></td>
                        </tr>
                    <?php }}else{ ?>
                        <tr>
                            <td colspan="5">No Record Found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>