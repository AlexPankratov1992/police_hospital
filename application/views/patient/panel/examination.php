<div class="tab-pane" id="examination">
  <script>
    $(document).ready(function() {
      //script of this section
      $('#examinationsave').click(function(e) {
        console.log(e.which);
        // if (e.which == 43) { // insert button
        $.post($('#examincationBox').attr('action'), $('#examincationBox').serialize(),
          function(data) {
            $('#examinationGroup').prepend(data);
            $('#ofc').val('');
            $('#weight').val('');
            $('#height').val('');

            $('#temperature').val('');
            $('#bp').val('');
            $('#oxygen_sat').val('');
            $('#xrayr').val('');
            $('#labr').val('');

          });
        return false;
        // }
      });
    });
  </script>
  <?php
  // OFC	Weight	Height

  if ($this->session->userdata('ba_user_id') == $doctor->user_id && $status_code > 1) {
    echo form_open('examinations/add/' . $doctor->patient_doctor_id, array('id' => 'examincationBox'));
    echo form_hidden('patient_doctor_id', $doctor->patient_doctor_id);
    echo form_input('ofc', '', 'class="form-control" id="ofc" style="margin-top:10px"  placeholder="OFC"');
    echo form_input('weight', '', 'class="form-control" id="weight" style="margin-top:10px"  placeholder="Weight"');
    echo form_input('height', '', 'class="form-control" id="height" style="margin-top:10px"  placeholder="Height" ');

    echo form_input('temperature', '', 'class="form-control" id="temperature" style="margin-top:10px"  placeholder="Temperature" ');
    echo form_input('bp', '', 'class="form-control" id="bp" style="margin-top:10px"  placeholder="BP"');
    echo form_input('oxygen_sat', '', 'class="form-control" id="oxygen_sat" style="margin-top:10px"  placeholder="Oxygen Saturation"');
    echo form_input('xrayr', '', 'class="form-control" id="xrayr" style="margin-top:10px"  placeholder="X-Ray Results"');
    echo form_input('labr', '', 'class="form-control" id="labr" style="margin-top:10px"  placeholder="Lab Test Results"');


    echo form_button('examinationsave', 'Save', 'class="form-control" style="margin-top:10px;background: #428bca;color: white; " id="examinationsave" placeholder="Save"');
    echo form_close();
    echo "<p></p>";
  }
  if (@$examination != 'unauthorized' && count($examination) > 0) {
    echo "<div id='examinationGroup'>";
    foreach ($examination as $exam) {
      echo "<div id='examination" . $exam->examination_id . "' class='well well-md'>";
      echo "<div class='commentBody'>OFC: " . $exam->ofc . '</div>';
      echo "<div class='commentBody'>Height: " . $exam->height . '</div>';
      echo "<div class='commentBody'>Weight: " . $exam->weight . '</div>';

      echo "<div class='commentBody'>temperature: " . $exam->temperature . '</div>';
      echo "<div class='commentBody'>BP: " . $exam->bp . '</div>';
      echo "<div class='commentBody'>oxygen_sat: " . $exam->oxygen_sat . '</div>';
      echo "<div class='commentBody'>xrayr: " . $exam->xrayr . '</div>';
      echo "<div class='commentBody'>labr: " . $exam->labr . '</div>';

      echo "<div class='pull-right'>Create Date: " . date('M d, Y', gmt_to_local($exam->create_date, 'UP45')) . "</div>"; //<span class='close'>&times;</span>
      echo "</div>";
    }
    echo "</div>";
  } else {
    echo "<div id='examinationGroup'>";
    echo "<!-- div class='alert alert-warning'>You are not authorized to view the examination.</div -->";
    echo "</div>";
  }
  ?>
</div>