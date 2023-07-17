<?php
$total_paid = 0;
$total_unpaid = 0;
$status_code = $doctor->status;
switch ($status_code) {
    case 0:
        $status = 'Waiting';
        break;
    case 1:
        $status = 'Finished';
        break;
    case 2:
        $status = 'Treatment';
        break;
    default:
        $status = 'Unknown';
        break;
}
if (!empty($patient->patient_id)) {
?>
    <div class="text-center print-only">
        <h2 class="print-only">Patient Bill Details</h2>
    </div>
    <div class="panel-group" id="pInfo">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#pInfo" href="#pInfoBody">
                        <?php echo html_escape($patient->patient_id . ' - ' . $patient->first_name . ' ' . $patient->last_name) . ' (<span id="status">' . $status . '</span>)'; ?>
                    </a>
                    <div class="pull-right" id="statusFormContainer">
                        <button id='pb' data-toggle="modal" data-target="#fullpayment">Pay Bill</button>
                    </div>
                </h4>
            </div>
            <div id="pInfoBody" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div class='col col-xs-6'>
                        <label>Father Name: </label> <?php echo html_escape($patient->fname); ?><br />
                        <label>Gender: </label> <?php echo $patient->gender ? 'Male' : 'Female'; ?><br />
                        <label>Phone: </label> <?php echo html_escape($patient->phone); ?><br />
                        <label>Date of Birth: </label> <?php echo $patient->birth_date; ?><br />
                        <br />
                    </div>
                    <div class="col col-xs-6">
                        <label>Date: </label> <?php echo date('M d, Y', gmt_to_local($patient->create_date, 'UP45')); ?>
                        <br />
                        <label><?php echo $patient->id_type; ?>: </label> <?php echo html_escape($patient->social_id); ?>
                        <br />
                        <label>Doctor: </label> <?php echo html_escape(@$doc_info->first_name . ' ' . @$doc_info->last_name); ?>
                        <br />
                        <label>Email: </label> <?php echo html_escape($patient->email); ?><br />
                    </div>
                    <div class="col col-xs-12">
                        <?php if ($patient->address) echo '<label>Address: </label>' . html_escape($patient->address) . '<br/>';
                        if ($patient->memo) echo '<label>Memo: </label>' . html_escape($patient->memo) . '<br/>'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <?php
        if ($comments !== 'unauthorized') {
            echo "<div id='commentGroup'>";
            foreach ($comments as $comment) {
                echo "<div id='comment" . $comment->comment_id . "' class='well well-md'>";
                echo "<div class='commentBody'>" . $comment->comment . '</div>';
                echo "<div class='pull-right'>Create Date: " . date('M d, Y', gmt_to_local($comment->create_date, 'UP45')) . "</div>"; //<span class='close'>&times;</span>
                echo "</div>";
            }
            echo "</div>";
        }
        ?>
        <?php if (!empty($drugs)) { ?>
            <div id='drugGroup' class="responsive-table" style="margin-top: 10px;">
                <h3>Drugs</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>نام</th>
                            <th>Times</th>
                            <th>Slot</th>
                            <th>OFC</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Dosage (MG)</th>
                            <th>Dosage (ML)</th>
                            <th>Dosage</th>
                            <th>UPrice</th>
                            <th>QTY</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (@$drugs) {
                            $i = 0;
                            $paid = 0;
                            $unpaid = 0;
                            foreach ($drugs as $drug) {

                                //table item for each drug
                                $this->drugs->load($drug->drug_id);
                                echo '<tr id="dpi' . $drug->drug_patient_id . '"><td class="id">' . ++$i . '</td>' .
                                    '<td>' . $this->drugs->drug_name_en . '</td>' .
                                    '<td>' . $this->drugs->drug_name_fa . '</td>' .
                                    '<td>' . $drug->times . '</td>' .
                                    '<td>' . $drug->slot . '</td>' .
                                    // '<td>' . $drug->ofc . '</td>' .
                                    // '<td>' . $drug->weight . '</td>' .
                                    // '<td>' . $drug->height . '</td>' .
                                    '<td>' . $drug->drugs->dosage_mg . '</td>' .
                                    '<td>' . $drug->drugs->dosage_ml . '</td>' .
                                    '<td>' . $drug->drugs->dosage . '</td>' .
                                    '<td>' . $drug->drugs->price . '</td>' .
                                    '<td>' . $drug->no_of_item . '</td>' .
                                    '<td>' . $drug->total_cost . '</td>';
                                if (!($drug->user_id_discharge && $drug->discharge_date)) {
                                    $unpaid += $drug->total_cost;
                                    $total_unpaid += $drug->total_cost;
                                } else {
                                    $paid += $drug->total_cost;
                                    $total_paid += $drug->total_cost;
                                }
                                echo '</tr>';
                            }
                            echo '<tr class="paid text-success ' . ($paid ? '' : 'hidden') . '"><td></td><td></td><td></td><td><td></td></td><td></td><td></td><td>Paid:</td><td id="paid">' . $paid . '</td></tr>';
                            echo '<tr class="unpaid text-danger ' . ($unpaid ? '' : 'hidden') . '"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><!-- Unpaid: --></td><td id="unpaid">' . $unpaid . '</td></tr>';
                            echo '<tr class="tc text-info ' . ($paid && $unpaid ? '' : 'hidden') . '"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Total:</td><td id="tc">' . ($paid + $unpaid) . '</td></tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
        <?php if (!empty($xrays)) { ?>
            <div id='xrayGroup' class="responsive-table" style="margin-top: 10px;">
                <h3>X-Rays</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>نام</th>
                            <th>UPrice</th>
                            <th>QTY</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (@$xrays) {
                            $i = 0;
                            $paid = 0;
                            $unpaid = 0;
                            foreach ($xrays as $xray) {
                                //table item for each xray
                                $this->xrays->load($xray->xray_id);
                                echo '<tr id="dpi' . $xray->xray_patient_id . '"><td class="id">' . ++$i . '</td>' .
                                    '<td>' . $this->xrays->xray_name_en . '</td>' .
                                    '<td>' . $this->xrays->xray_name_fa . '</td>' .
                                    '<td>' . $this->xrays->price . '</td>' .
                                    '<td>' . $xray->no_of_item . '</td>' .
                                    '<td>' . $xray->total_cost . '</td>';
                                if (!($xray->user_id_discharge && $xray->discharge_date)) {
                                    $unpaid += $xray->total_cost;
                                    $total_unpaid += $xray->total_cost;
                                } else {
                                    $paid += $xray->total_cost;
                                    $total_paid += $xray->total_cost;
                                }
                                echo '</tr>';
                            }
                            echo '<tr class="xray_paid text-success ' . ($paid ? '' : 'hidden') . '"><td></td><td></td><td></td><td></td><td>Paid:</td><td id="xray_paid">' . $paid . '</td></tr>';
                            echo '<tr class="xray_unpaid text-danger ' . ($unpaid ? '' : 'hidden') . '"><td></td><td></td><td></td><td></td><td><!-- Unpaid: --></td><td id="xray_unpaid">' . $unpaid . '</td></tr>';
                            echo '<tr class="xray_tc text-info ' . ($paid && $unpaid ? '' : 'hidden') . '"><td></td><td></td><td></td><td></td><td>Total:</td><td id="xray_tc">' . ($paid + $unpaid) . '</td></tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
        <?php if (!empty($lab)) { ?>
            <div id='labGroup' class="responsive-table" style="margin-top:10px;">
                <h3>Laboratory Tests</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>نام</th>
                            <th>UPrice</th>
                            <th>QTY</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (@$lab) {
                            $i = 0;
                            $paid = 0;
                            $unpaid = 0;
                            foreach ($lab as $test) {
                                //table item for each drug
                                $this->lab->load($test->test_id);
                                echo '<tr id="dpi' . $test->lab_patient_id . '"><td class="id">' . ++$i . '</td>' .
                                    '<td>' . $this->lab->test_name_en . '</td>' .
                                    '<td>' . $this->lab->test_name_fa . '</td>' .
                                    '<td>' . $this->lab->price . '</td>' .
                                    '<td>' . $test->no_of_item . '</td>' .
                                    '<td>' . $test->total_cost . '</td>';
                                if (!($test->user_id_discharge && $test->discharge_date)) {
                                    $unpaid += $test->total_cost;
                                    $total_unpaid += $test->total_cost;
                                } else {
                                    $paid += $test->total_cost;
                                    $total_paid += $test->total_cost;
                                }
                                echo '</tr>';
                            }
                            echo '<tr class="test_paid text-success ' . ($paid ? '' : 'hidden') . '"><td></td><td></td><td></td><td></td><td>Paid:</td><td id="test_paid">' . $paid . '</td></tr>';
                            echo '<tr class="test_unpaid text-danger ' . ($unpaid ? '' : 'hidden') . '"><td></td><td></td><td></td><td></td><td><!-- Unpaid: --></td><td id="test_unpaid">' . $unpaid . '</td></tr>';
                            echo '<tr class="test_tc text-info ' . ($paid && $unpaid ? '' : 'hidden') . '"><td></td><td></td><td></td><td></td><td>Total:</td><td id="test_tc">' . ($paid + $unpaid) . '</td></tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
<?php
} else {
    echo '<div class="alert alert-danger text-center"><h1>Patient Not Found</h1></div><div class="pull-right" title="Go to Patients">' . anchor('patient', '<span class="glyphicon glyphicon-arrow-left"></span>') . '</div>';
}
?>

<div class="modal fade" id="fullpayment" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bill Payment</h4>
            </div>
            <div class="modal-body">
                <p><b>Total Paid: </b> <?php echo $total_paid; ?></p>
                <!-- p><b>Total Unpaid: </b> <?php echo $total_unpaid; ?></p -->
            </div>
            <?php if ($total_unpaid > 0) { ?>
                <div class="modal-footer">
                    <?php echo form_open('patient/bulk_payment/' . $patient->patient_id, array("role" => "form",)); ?>
                    <button class="btn btn-primary btn-block" type="submit">Pay</button>
                    <?php echo form_close(); ?>
                </div>
            <?php } ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function() {
        if (<?= $total_unpaid ?> > 0) {
            $('#pb').show();
        } else {
            $('#pb').hide();
        }
    });
</script>