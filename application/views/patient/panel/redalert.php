<script>
  $(document).ready(function() {
    $('#clear').click(function(e) {
      $("#redalertTextArea").val('');
    })

    $('.alerts').click(function(e) {
      console.log("button alert called is working...");
      if (document.querySelector("#redalertTextArea").textLength === 0) {
        $("#redalertTextArea").val($(this).val());

      } else {
        $("#redalertTextArea").val($("#redalertTextArea").val() + "\n" + $(this).val());
      }

    })

  });
</script>

<div class="tab-pane active" id="redalerts">
  <style>
    #redalertTextArea {
      height: 89px !important;
    }

    .alerts {
      border: 0;
      margin-top: 13px;
      margin-bottom: 13px;
    }

    .alerts:hover {
      transform: scale(1.3);
      /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
  </style>

  <style>
    ul.timeline {
      list-style-type: none;
      position: relative;
    }

    ul.timeline:before {
      content: ' ';
      background: #d4d9df;
      display: inline-block;
      position: absolute;
      left: 29px;
      width: 2px;
      height: 100%;
      z-index: 400;
    }

    ul.timeline>li {
      margin: 20px 0;
      padding-left: 20px;
    }

    ul.timeline>li:before {
      content: ' ';
      background: white;
      display: inline-block;
      position: absolute;
      border-radius: 50%;
      border: 3px solid #ab22e8;
      left: 20px;
      width: 20px;
      height: 20px;
      z-index: 400;
    }
  </style>
  <ul class="timeline" id="timelineitems">
    <?php
    if (@$redalerts != 'unauthorized') {
      foreach ($redalerts as $redalert) {
        echo "<li id='timelineitem" . $redalert->redalert_id . "'>";
        echo '<a target="_blank" href="#">Red Alert</a>';
        echo '<a href="#" class="float-right"> | ' . date('M d, Y', gmt_to_local($redalert->create_date, 'UP45')) . '</a>';
        echo "<a href='#redalertGroup' id='delete-redalert' onclick='deleteRedAlert(" . $redalert->redalert_id . ")'>| <span class='glyphicon glyphicon-remove-circle'></span></a>";
        echo '<p style="color:red;    font-size: larger;">' . $redalert->redalert . '</p>';
        echo "</li>";
      }
    }
    ?>
  </ul>

  <input type="button" value="Assign Sugar-Free Drugs Only" class="alerts">
  <input type="button" value="Don't prescribe pills" class="alerts">
  <br>

  <?php
  if ($this->session->userdata('ba_user_id') == $doctor->user_id && $status_code > 1) {
    echo form_open('redalert/add/' . $doctor->patient_doctor_id, array('id' => 'redalertBox'));
    echo form_hidden('patient_doctor_id', $doctor->patient_doctor_id);
    echo form_textarea('redalert', '', 'class="form-control" id="redalertTextArea" placeholder="Write your RED ALERTS about this patient..." required');
    echo form_button('redalertsave', '+ Add Red Alerts', 'class="btn btn-info btn-group" style="margin-top:0px; margin-right:10px;  background: #428bca;color: white;" id="redalertsave" placeholder="Save" required');
    echo form_button('redalertsave', 'Clear', 'class="btn btn-danger btn-group" style="background:red"  id="clear" placeholder="Save" required');
    echo form_close();
    echo "<p></p>";
  }
  if (@$redalerts != 'unauthorized') {
    /*
    echo "<div id='redalertGroup'>";
    foreach ($redalerts as $redalert) {
      echo "<div id='redalertmsg" . $redalert->redalert_id . "' class='well well-md'>";
      echo "<div class='redalertBody' style='color:red;    font-size: larger;'>" . $redalert->redalert . '</div>';
      echo "<div style='float:right; margin-left:5px;'>| <a href='#redalertGroup' id='delete-redalert' onclick='deleteRedAlert(" . $redalert->redalert_id . ")'>Delete</a></div>"; //<span class='close'>&times;</span>
      echo "<div class='pull-right'>Create Date: " . date('M d, Y', gmt_to_local($redalert->create_date, 'UP45')) . "</div>"; //<span class='close'>&times;</span>
      echo "</div>";
    }
    echo "</div>";
    */
  } else {
    echo "<div id='redalertGroup'>";
    echo "<div class='alert alert-warning'>You are not authorized to view the red alerts.</div>";
    echo "</div>";
  }
  ?>




</div>

<script>
  async function deleteRedAlert(redalert_id) {
    const form = new FormData();
    form.append("redalert_id", redalert_id);
    form.append("csrf_test_name", "<?php echo $this->security->get_csrf_hash(); ?>");

    await fetch(
        "<?php echo base_url() ?>index.php/redalert/delete", {
          method: "POST",
          body: form,
        }
      )
      .then((res) => res.json())
      .then(async (data) => {
        if (data.status === 'success') {
          document.querySelector("#timelineitem" + redalert_id).remove();
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Red Alert Deleted Successfully',
            showConfirmButton: false,
            timer: 500
          })

        } else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Red Alert can not be deleted.',
            showConfirmButton: false,
            timer: 2500
          })

        }
      });
  } // end function



  $(document).ready(function() {


    $('#redalertsave').click(function(e) {
      console.log(e.which);
      // if (e.which == 43) { // insert button
      $.post($('#redalertBox').attr('action'), $('#redalertBox').serialize(),
        function(data) {
          // $('#redalertGroup').prepend(data);
          $('#timelineitems').prepend(data);

          $("#redalertTextArea").val('');

        });
      return false;
      // }
    });
  });
</script>