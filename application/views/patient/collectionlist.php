<legend><?php echo "- " . @$title; ?></legend>

<?php //pagination should be added if have time.

if (!empty($patients)) {

  echo "<div>" . $pagination . "<div class='table-responsive'><table class='table table-bordered table-striped'><thead><tr>

           <th>Sr.</th>

           <th>Visited Date & Time</th>

           <th>Collected Fee</th>

           <th>Name</th>

           <th>Father Name</th>

           <th>Phone</th>

           <th>Date of Brith</th>

           <th>G</th>

           <th>Actions</th>

       </tr></thead><tbody>";

  $start = ($page - 1) * $per_page;

  $i = 0;
  $row = 1;
  foreach ($patients as $_patient) {

    if ($i >= (int)$start && $i < (int)$start + (int)$per_page) {

      $actions = anchor('patient/panel/' . $_patient->patient_id, '<span class="glyphicon glyphicon-cog"></span>', array('title' => 'Patient Control Panel'));


      $actions .= anchor('patient/print_prescription_pad/' . $_patient->patient_id, '<span class="glyphicon glyphicon-print"></span>', array('title' => 'Print Prescription'));

      echo '<tr id="' . $_patient->patient_id . '" title="' . $_patient->memo . '">' .

        '<td>' . $row . '</td>' .
        '<td>' . html_escape($_patient->visit_time) . '</td>' .
        '<td>' . html_escape($_patient->actual_fee) . '</td>' .

        '<td>' . html_escape($_patient->first_name . ' ' . $_patient->last_name) . '</td>' .

        '<td>' . html_escape($_patient->fname) . '</td>' .

        '<td>' . html_escape($_patient->phone) . '</td><td>';

      if (isset($_patient->birth_date)) echo $_patient->birth_date;
      else echo '';
      echo '</td><td>';

      if ($_patient->gender) echo 'M';
      else echo 'F';
      echo '</td>' .

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