<style>
  h3 {
    color: rgba(10, 120, 180, 50) !important;
  }
</style>
<?php
if ($this->input->post('submit') === 'Search') {
  echo '<h3 id="searchFilter">- Advance Search</h3><div id="searchList">';
} else {
  echo '<h3 id="searchFilter">+ Advance Search</h3><div style="display: none;" id="searchList">';
}
?>

<div class="row">
  <div class="col col-md-8 well well-sm">
    <?php echo form_open('patient', array("id" => "newPatientSearchForm", "role" => "form",)); ?>
    <fieldset>
      <div>
        <?php echo (!empty($error) ? $error : ''); ?>
        <div class="form-group">

          <div class="col-md-4"><input type="text" name='card_no' id="card_no" value="<?php echo $this->input->post('card_no'); ?>" class='form-control' placeholder='Card No' title='Card No' autofocus /></div>
          <div class="col-md-4"><input type="text" name='name' id="name" value="<?php echo $this->input->post('name'); ?>" class='form-control' placeholder='Name' title='Name' /></div>
          <div class="col-md-4"><input type="text" name='father_name' id="father_name" value="<?php echo $this->input->post('father_name'); ?>" class='form-control' placeholder='Father Name' title='Father Name' /></div>
          <div class="col-md-4"><input type="text" name='mobile_no' id="mobile_no" value="<?php echo $this->input->post('mobile_no'); ?>" class='form-control' placeholder='Mobile Number' title='Mobile Number' /></div>
          <div class="col-md-4"><input type="text" name='address' id="address" value="<?php echo $this->input->post('address'); ?>" class='form-control' placeholder='Address' title='Address' /></div>
          <div class="col-md-4"><input type="text" name='date_of_birth' id="date_of_birth" value="<?php echo $this->input->post('date_of_birth'); ?>" class='form-control' placeholder='Date of Birth' title='Date of Birth' data-toggle='datepicker' /></div>
          <div class="col-md-4">
            <select name="gender" class="form-control">
              <option value="" selected>Select Gender</option>
              <option value="1" <?php if ($this->input->post('gender') === "1") {
                                  echo "selected";
                                } ?>>Male</option>
              <option value="0" <?php if ($this->input->post('gender') === "0") {
                                  echo "selected";
                                } ?>>Female</option>
            </select>
          </div>
          <div class="col-md-4">
            <select name="sort_by" class="form-control">
              <option value="" selected>Sort By</option>
              <option value="card_no" <?php if ($this->input->post('sort_by') === "card_no") {
                                        echo "selected";
                                      } ?>>Card No</option>
              <option value="name" <?php if ($this->input->post('sort_by') === "name") {
                                      echo "selected";
                                    } ?>>Name</option>
              <option value="fname" <?php if ($this->input->post('sort_by') === "fname") {
                                      echo "selected";
                                    } ?>>Father</option>
              <option value="phone" <?php if ($this->input->post('sort_by') === "phone") {
                                      echo "selected";
                                    } ?>>Mobile</option>
              <option value="birth_date" <?php if ($this->input->post('sort_by') === "birth_date") {
                                            echo "selected";
                                          } ?>>Date of Birth</option>
              <option value="gender" <?php if ($this->input->post('sort_by') === "gender") {
                                        echo "selected";
                                      } ?>>Gender</option>

              <option value="create_date" <?php if ($this->input->post('sort_by') === "create_date") {
                                            echo "selected";
                                          } ?>>Created Date</option>
            </select>

          </div>
          <div class="col-md-4">
            <select name="sort_type" class="form-control">
              <option value="" selected>Sort Type</option>
              <option value="ASC" <?php if ($this->input->post('sort_type') === "ASC") {
                                    echo "selected";
                                  } ?>>Ascending</option>
              <option value="DESC" <?php if ($this->input->post('sort_type') === "DESC") {
                                      echo "selected";
                                    } ?>>Descending</option>
            </select>
          </div>

        </div>
        <div class="clearfix"></div>
    </fieldset>
    <div class="form-group">
      <div class="col-md-4"><input type="submit" name='submit' id='submit' value='Search' class="form-control btn btn-info" /></div>
      <div class="col-md-4"><?php echo anchor('patient', 'Clear', array('class' => 'form-control btn btn-info')); ?></div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
</div>

<h3 id="patientListTitle"><?php echo "- " . @$title; ?></h3>

<?php //pagination should be added if have time.

if (!empty($patients)) {

  echo "<div id='patientlist'>" . $pagination . "<div class='table-responsive'><table class='table table-bordered table-striped'><thead><tr>

           <th>Sr.</th>

           <th>Card No</th>
           <th>Name</th>

           <th>Father Name</th>

           <th>Phone</th>

           <th>Date of Birth</th>

           <th>G</th>
           <th>Address</th>
           <th>Created Date</th>

           <th>Actions</th>

       </tr></thead><tbody>";

  $start = ($page - 1) * $per_page;

  $i = 0;
  $row = 1;
  foreach ($patients as $_patient) {

    if ($i >= (int)$start && $i < (int)$start + (int)$per_page) {

      $actions = anchor('patient/panel/' . $_patient->patient_id, '<span class="glyphicon glyphicon-cog"></span>', array('title' => 'Patient Control Panel'));

      if ($this->bitauth->has_role('receptionist')) {

        $actions .= anchor('patient/edit_patient/' . $_patient->patient_id, '<span class="glyphicon glyphicon-edit"></span>', array('title' => 'Edit Patient'));
      }

      $actions .= anchor('patient/print_prescription_pad/' . $_patient->patient_id, '<span class="glyphicon glyphicon-print"></span>', array('title' => 'Print Prescription'));
      $actions .= anchor('patient/delete_patient/' . $_patient->patient_id, '<span class="glyphicon glyphicon-remove"></span>', array('title' => 'Delete Patient'));

      echo '<tr id="' . $_patient->patient_id . '" title="' . $_patient->memo . '">' .

        '<td>' . $row . '</td>' .
        '<td>' . html_escape($_patient->card_no) . '</td>' .

        '<td>' . html_escape($_patient->first_name . ' ' . $_patient->last_name) . '</td>' .

        '<td>' . html_escape($_patient->fname) . '</td>' .

        '<td>' . html_escape($_patient->phone) . '</td><td>';

      if (isset($_patient->birth_date)) echo $_patient->birth_date;
      else echo '';
      echo '</td><td>';

      if ($_patient->gender) echo 'M';
      else echo 'F';
      echo '</td>' .

        '<td>' . $_patient->address . '</td><td>' . date("Y-m-d H:i:s", substr($_patient->create_date, 0, 10)) . '</td><td class="hidden-print">' . $actions . '</td>' .

        '</tr>';
    }

    $i++;
    $row++;
  }

  echo "</tbody></table></div>" . $pagination . "</div>";
}

echo '<div class="hidden-print">' . anchor('patient/register', 'Register Patient', array('class' => 'hidden-print')) . '</div>';

?>

<script>
  $(document).ready(function() {
    //formfield toggle script
    $('#patientListTitle').on('click', function() {
      $(this).parent().find('#patientlist').toggle();

      var fL = $(this).text().substr(0, 1);
      var text = $(this).text().substr(1);
      if (fL == '-')
        $(this).text('+' + text);
      else if (fL == '+')
        $(this).text('-' + text);
    });

    // =============
    $('#searchFilter').on('click', function() {
      $(this).parent().find('#searchList').toggle();

      var fL = $(this).text().substr(0, 1);
      var text = $(this).text().substr(1);
      if (fL == '-')
        $(this).text('+' + text);
      else if (fL == '+')
        $(this).text('-' + text);
    });

  });


  // ==================
  $("#date_of_birth").datepicker({
    dateFormat: 'yy-mm-dd',
    onSelect: function(dateText) {
      // alert("Selected date: " + dateText + "; input's current value: " + this.value);
      var date = $(this).val();
      console.log(date, 'change')
      var val = $(this).val();
      // window.location = $(this).attr('href') + '/' + val;
    }
  });
</script>