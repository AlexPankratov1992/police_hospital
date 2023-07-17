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
                    <td>Month: </td>
                    <td style="width: 50%">
                        <?php echo form_open('home/monthly_report',array("id"=>"filter", "role"=>"form",)); ?>
                        <select class="form-control" name="month" id="month">
                            <option value="current">Current Month</option>
                            <?php
                                $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
                                foreach ($months as $key => $month)
                                {
                                    $key += 1;
                                    if(isset($month_post)){
                                        if($month_post == $key){
                                            echo "<option value=\"" . $key . "\" selected>" . $month . "</option>";
                                        }else{
                                            echo "<option value=\"" . $key . "\">" . $month . "</option>";
                                        }

                                    }else{
                                        echo "<option value=\"" . $key . "\">" . $month . "</option>";
                                    }

                                }
                            ?>
                        </select>
                        <?php echo form_close(); ?>
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

<script>
    $(document).ready(function(){
       $('#month').on('change', function(){
           $('#filter').submit();
       });
    });
</script>