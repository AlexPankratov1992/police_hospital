<?php
function getSelectedOption($currentValue, $selectedValue)
{
  if ($selectedValue === $currentValue) return "selected";
  return "";
}
if ($drugs) {
  echo "<div class='table-responsive'><table class='table table-bordered table-striped'><thead><tr>
          <th style='display:none;'>ID</th>
          <th>Action</th>
          <th>Serial#</th>
          <!-- th>Type</th -->
          <th>Name</th>
          <!-- th>نام اردو</th -->
          <th>Times</th>
          <th>Slot</th>
          <!-- th>OFC</th -->
          <!-- th>Weight</th -->
          <!-- th>Height</th -->
          <!-- th>Unit Price</th -->
          <th>Days</th>
          <th>Drug(MG) </th>
          <th>Drug(ML)</th>
          <th>Dosage</th>
       </tr></thead><tbody id='drugshortcut'>";
  $srno = 0;
  foreach ($drugs as $_drug) {
    $actions = anchor('#', 'Assign');
    $srno = $srno + 1;


    echo '<tr id="' . $_drug->drug_id . '" title="' . $_drug->memo . '">' .
      '<td style="display:none;">' . html_escape($_drug->drug_id) . '</td>' .
      '<td class="hidden-print">' . $actions . '</td>' .
      '<td>' . $srno . '</td>' .
      '<!-- td><select name="type"><option value="Tablet">Tablet</option><option value="Syrub">Syrub</option><option value="Capsules">Capsules</option><option value="Liquid">Liquid</option><option value="Lotion">Lotion</option><option value="Oil">Oil</option><option value="Drops">Drops</option><option value="IV Injection">IV Injection</option><option value="IM Injection">IM Injection</option></select></td -->' .
      '<td>' . html_escape($_drug->drug_name_en) . '</td>' .
      '<input type="hidden" name="name" style="width: 81px;" value="' . html_escape($_drug->drug_name_en) . '"/></td>' .
      '<!-- td>' . html_escape($_drug->drug_name_fa) . '</td -->' .
      '<td><select name="times"><option value="1 time" ' . getSelectedOption("1 time", $_drug->times) . '>1 time</option><option value="2 times" ' . getSelectedOption("2 times", $_drug->times) . '>2 times</option><option value="3 times" ' . getSelectedOption("3 times", $_drug->times) . '>3 times</option><option value="L/A x 3" ' . getSelectedOption("L/A x 3", $_drug->times) . '>L/A x 3</option></select></td>' .
      '<td><select name="slot"><option value="Before Food" ' . getSelectedOption("Before Food", $_drug->slot) . '>Before Food</option><option value="After Food" ' . getSelectedOption("After Food", $_drug->slot) . '>After Food</option><option value="Anytime"  ' . getSelectedOption("Anytime", $_drug->slot) . '>Anytime</option></select></td>' .
      '<!-- td><input type="text" name="ofc" value=""/></td -->' .
      '<!-- td><input type="text" name="weight" value=""/></td -->' .
      '<!-- td><input type="text" name="height" value=""/></td -->' .
      '<!-- td>' . html_escape($_drug->price) . '</td -->' .
      '<td><input type="number" name="no_of_item" style="width: 81px;" value="' . $_drug->no_of_item . '"/></td>' .
      '<td><input type="number" step=".01" style="width: 81px;" name="dosage_mg" value="' . $_drug->dosage_mg . '"/></td>' .
      '<td><input type="number" step=".01" style="width: 81px;" name="dosage_ml" value="' . $_drug->dosage_ml . '"/></td>' .
      '<td><input type="number" step=".01" style="width: 81px;" name="dosage" value="' . $_drug->dosage . '"/></td>' .
      '</tr>';
  } ?>
  </tbody>
  </table>
  <script>
    $(document).ready(function() {
      $('#drugResult a').on('click', function(e) {
        e.preventDefault();
        var tr = $(this).parent().parent();
        $('#drug_id').val(tr.find('td:first').text());
        $('#times').val(tr.find('select[name="times"]').val());
        $('#slot').val(tr.find('select[name="slot"]').val());
        $('#type').val(tr.find('select[name="type"]').val());
        $('#ofc').val(tr.find('input[name="ofc"]').val());
        $('#weight').val(tr.find('input[name="weight"]').val());
        $('#height').val(tr.find('input[name="height"]').val());
        $('#no_of_item').val(tr.find('input[name="no_of_item"]').val());
        $('#total_cost').val(tr.find('td:nth(6)').text() * tr.find('input[name="no_of_item"]').val());
        $('#drug_patient_doctor_id').val($('#fk_patient_doctor_id').text());
        $('#dosage_mg').val(tr.find('input[name="dosage_mg"]').val());
        $('#dosage_ml').val(tr.find('input[name="dosage_ml"]').val());
        $('#dosage').val(tr.find('input[name="dosage"]').val());

        $.post($('#addDrugForm').attr('action'), $('#addDrugForm').serialize(), function(data) {
          if (data != '') {
            var paid = $('#paid').text() * 1;
            var unpaid = $('#unpaid').text() * 1;
            var trWithId = $('#drugGroup tbody tr>td[class="id"]').parent();
            if (trWithId.last().html()) {
              $('#drugGroup tbody tr>td[class="id"]:last').parent().after(data);
              var data = $('#drugGroup tbody tr>td[class="id"]:last').parent();
              data.find('td:first').html((trWithId.last().find('td:first').text() * 1) + 1);
              var tc = data.find('.actions a:first').attr('tc') * 1;
              unpaid += tc;
              $('#paid').text(paid);
              $('#unpaid').text(unpaid);
              $('#tc').html(unpaid + paid);
              if (paid > 0) $('.paid').removeClass('hidden');
              else $('.paid').addClass('hidden');
              if (unpaid > 0) $('.unpaid').removeClass('hidden');
              else $('.unpaid').addClass('hidden');
              if (paid > 0 && unpaid > 0) $('.tc').removeClass('hidden');
              else $('.tc').addClass('hidden');
            } else {
              $('#drugGroup tbody').html(data);
              var data = $('#drugGroup tbody tr>td[class="id"]:last').parent();
              data.find('td:first').html(1);
              $('#drugGroup tbody').append('<tr class="paid text-success hidden"><td></td><td></td><td></td><td></td><td>Paid:</td><td id="paid">0</td><td></td></tr>');
              $('#drugGroup tbody').append('<tr class="unpaid text-danger"><td></td><td></td><td></td><td></td><td><!-- Unpaid: --></td><td id="unpaid"></td><td></td></tr>');
              $('#drugGroup tbody').append('<tr class="tc text-info hidden"><td></td><td></td><td></td><td></td><td>Total:</td><td id="tc">' + data.find('.actions a:first').attr('tc') + '</td><td></td></tr>');
            }

            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Drug ' + tr.find('input[name="name"]').val() + ' has been assigned to the patient successfully',
              showConfirmButton: false,
              timer: 1000
            })

            $('#drugGroup tr > td> a').on('click', drugItemsAction);
          }
        });
      });
    });
    document.querySelector("#quickAddDrug").style.display = "none";
  </script>
  </script>
  </div><?php
      } else {
        echo '<div class="alert alert-danger text-center"><h1>Drug Not Found</h1></div><script>document.querySelector("#quickAddDrug").style.display="block";</script>';
      }
        ?>