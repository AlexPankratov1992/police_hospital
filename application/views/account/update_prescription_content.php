<?php
echo '<div class="col col-md-8 well well-sm well-md">';
echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'edit_prescription_form', 'role' => 'form'));
if (validation_errors()) {
  echo validation_errors();
}

echo "<fieldset><legend>- Update Prescription Content</legend>";

echo '<div><div class="form-group">
<div class="col col-md-12">' . form_input('col_1_row_1', set_value('col_1_row_1', $p_data->col_1_row_1), 'class="form-control" title="col_1_row_1" placeholder="Dr. Name" required') . '</div>
</div>';

echo '<div><div class="form-group">
<div class="col col-md-12">' . form_input('col_1_row_2', set_value('col_1_row_2', $p_data->col_1_row_2), 'class="form-control" title="col_1_row_2" placeholder="Dr. Speciality 1" required') . '</div>
</div>';

echo '<div><div class="form-group">
<div class="col col-md-12">' . form_input('col_1_row_3', set_value('col_1_row_3', $p_data->col_1_row_3), 'class="form-control" title="col_1_row_3" placeholder="Dr. Speciality 2" required') . '</div>
</div>';

echo '<div><div class="form-group">
<div class="col col-md-12">' . form_hidden('col_2_image', set_value('col_2_image', $p_data->col_2_image), 'class="form-control" title="col_2_image" placeholder="Clinic Image" required') . '</div>
</div>';

echo '<div><div class="form-group">
<div class="col col-md-12">' . form_input('col_3_row_1', set_value('col_3_row_1', $p_data->col_3_row_1), 'class="form-control" title="col_3_row_1" placeholder="Timing 1" required') . '</div>
</div>';

echo '<div><div class="form-group">
<div class="col col-md-12">' . form_input('col_3_row_2', set_value('col_3_row_2', $p_data->col_3_row_2), 'class="form-control" title="col_3_row_2" placeholder="Timing 2" required') . '</div>
</div>';

echo '<div><div class="form-group">
<div class="col col-md-12">' . form_input('col_3_row_3', set_value('col_3_row_3', $p_data->col_3_row_3), 'class="form-control" title="col_3_row_3" placeholder="Except Days" required') . '</div>
</div>';

echo '<div><div class="form-group">
<div class="col col-md-12">' . form_input('col_3_row_4', set_value('col_3_row_4', $p_data->col_3_row_4), 'class="form-control" title="col_3_row_4" placeholder="Mobile No." required') . '</div>
</div>';

echo '<div><div class="form-group">
<div class="col col-md-12">' . form_input('col_3_row_5', set_value('col_3_row_5', $p_data->col_3_row_5), 'class="form-control" title="col_3_row_5" placeholder="Address 1" required') . '</div>
</div>';

echo '<div><div class="form-group">
<div class="col col-md-12">' . form_input('col_3_row_6', set_value('col_3_row_6', $p_data->col_3_row_6), 'class="form-control" title="col_3_row_6" placeholder="Address 2" required') . '</div>
</div>';

echo '<div class="form-group"><div class="col-md-offset-3">
            <div class="col col-md-6"><input type="submit" name="submit" id="submit" value="Update" class="form-control btn btn-info" /></div> 
            <div class="col col-md-6">' . anchor('/', 'Cancel', array('class' => 'form-control btn btn-info')) . '</div>
          </div></div></div></fieldset>';
echo form_close();
echo "</div>";
