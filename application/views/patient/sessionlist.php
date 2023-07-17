<legend><?php echo "- " . @$title; ?></legend>

<?php //pagination should be added if have time.

if (!empty($patients)) {

  echo "<div>" . $pagination . "<div class='table-responsive'><table class='table table-bordered table-striped'><thead><tr>

           <th>Sr.</th>

           <th>Date</th>

           <th>Session Started</th>

           <th>Session Ended</th>

           <th>Session Patients Total</th>

           <th>Actions</th>

       </tr></thead><tbody>";

  $start = ($page - 1) * $per_page;

  $i = 0;
  $row = 1;
  foreach ($patients as $_patient) {

    if ($i >= (int)$start && $i < (int)$start + (int)$per_page) {

      $actions = anchor('patient/sesspatientslist/' . $_patient->id, '<span class="glyphicon glyphicon-cog"></span>', array('title' => 'Patient Control Panel'));


      //  $actions .= anchor('patient/print_prescription_pad/' . $_patient->id, '<span class="glyphicon glyphicon-print"></span>', array('title' => 'Print Prescription'));

      echo '<tr id="' . $_patient->id . '" title="Session Record">' .

        '<td>' . $row . '</td>' .
        '<td>' . html_escape($_patient->start_date) . '</td>' .
        '<td>' . html_escape($_patient->start) . '</td>' .

        '<td>' . html_escape($_patient->end) . '</td>' .

        '<td>' . html_escape($_patient->session_patients) . '</td><td>';

      '<td class="hidden-print">' . $actions . '</td>' .

        '</tr>';
    }

    $i++;
    $row++;
  }

  echo "</tbody></table></div>" . $pagination . "</div>";
}

echo '<div class="hidden-print">' . anchor('patient/register', 'Register Patient', array('class' => 'hidden-print')) . '</div>';

?>