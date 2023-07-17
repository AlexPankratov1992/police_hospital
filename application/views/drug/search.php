<style>
  .drug_suggestion {
    border: 0;
    margin-top: 13px;
    margin-right: 16px;
  }

  .drug_suggestion:hover {
    transform: scale(1.3);
  }
</style>

<div>
  <div class="modal fade bs-modal-lg" id="modalDrugSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="modal-title" id="myModalLabel">Search Drug |

            <?php
            foreach ($drug_suggestions as $value) {
              // $drug_suggestions[$key] = $value->drug_name_en;
              echo '<input type="button" value="' . $value . '" class="drug_suggestion">';
            }

            ?>
          </h5>

        </div>

        <div class="modal-body">

          <?php
          echo form_open('', array('id' => 'formDrugQ'));
          echo form_input('q', '', 'class="form-control" id="drugQ" required autofocus'); // 
          echo form_button('quickAddDrug', '+ Quick Add Drug', ' id="quickAddDrug" style="margin-top: 10px; border: 0px solid; display:none"'); // 
          echo form_close();
          echo "<p></p>";
          ?>
          <div id="drugResult"></div>
        </div>
        <div class="modal-footer">
          <button name="button" class="btn btn-success" type="button" id="printitdrugs">Print</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#drugQ').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
          // $('input[name = butAssignProd]').click();
          var serialno = prompt("Enter drug serial number to assign");
          serialno = parseInt(serialno) - 1;

          document.querySelector("#drugshortcut").children[serialno].childNodes[1].firstChild.click();
          // alert("Serial Number : " + serialno + " added successfully.")

          return false;
        }
      });

      $('#modalDrugSearch').modal('show');
      $('#drugQ').keyup(function(e) {
        if (e.which != 27) { //if not esc
          //$.get("<?php echo site_url('drug/search') . '/'; ?>"+$('#drugQ').val(),'',
          $.post("<?php echo site_url('drug/search'); ?>", $('#formDrugQ').serialize(),
            function(data) {
              $('#drugResult').html(data);
            });
        }
      });

      $('#quickAddDrug').click(function() {
        // Step 1: add drug
        // let drugName = $('#drugQ').val();
        $.post("<?php echo site_url('drug/quickAddDrug'); ?>", $('#formDrugQ').serialize(),
          function(data) {
            console.log(data);
            // Step 2: Search same drug and show
            $.post("<?php echo site_url('drug/search'); ?>", $('#formDrugQ').serialize(),
              function(data) {
                $('#drugResult').html(data);
              });
          });
      });

    });

    $(document).ready(function() {
      $('#printitdrugs').click(function() {
        let patient_id = document.URL.split('/');
        patient_id = "/" + patient_id[patient_id.length - 1];
        let url = "<?php echo site_url("patient/print_prescription_pad/"); ?>";
        window.location.href = url + patient_id;
      })

      $('.drug_suggestion').click(function(e) {
        document.querySelector("#drugQ").value = $(this).val();
        $.post("<?php echo site_url('drug/search'); ?>", $('#formDrugQ').serialize(),
          function(data) {
            $('#drugResult').html(data);
          });

      })
    });
  </script>
</div>