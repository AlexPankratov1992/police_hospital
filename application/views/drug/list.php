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
    <?php echo form_open('drug', array("id" => "newDrugSearchForm", "role" => "form",)); ?>
    <fieldset>
      <div>
        <?php echo (!empty($error) ? $error : ''); ?>
        <div class="form-group">

          <div class="col-md-4">
            <select name="category" class="form-control">
              <option value="" selected>Drug Category</option>
              <?php
              function getSelectedOption($currentValue, $selectedValue)
              {
                if ($selectedValue === $currentValue) return "selected";
                return "";
              }

              foreach ($categories as $_category) {
                echo '<option value="' . $_category->category . '" ' . getSelectedOption($_category->category, $this->input->post('category')) . '>' . $_category->category . '</option>';
              }
              ?>
            </select>




          </div>
          <div class="col-md-4"><input type="text" name='name' id="name" value="<?php echo $this->input->post('name'); ?>" class='form-control' placeholder='Drug Name' title='Drug Name' /></div>
          <div class="col-md-4"><input type="text" name='no_of_item' id="no_of_item" value="<?php echo $this->input->post('no_of_item'); ?>" class='form-control' placeholder='No. of Days' title='No. of Days' /></div>
          <div class="col-md-4">
            <select name="times" class="form-control">
              <option value="" selected>Select No. of times in a Day</option>
              <option value="1 time" <?php if ($this->input->post('times') === "1 time") {
                                        echo "selected";
                                      } ?>>1 time</option>
              <option value="2 times" <?php if ($this->input->post('times') === "2 times") {
                                        echo "selected";
                                      } ?>>2 times</option>
              <option value="3 times" <?php if ($this->input->post('times') === "3 times") {
                                        echo "selected";
                                      } ?>>3 times</option>
              <option value="L/A x 3" <?php if ($this->input->post('times') === "L/A x 3") {
                                        echo "selected";
                                      } ?>>L/A x 3</option>

            </select>

          </div>
          <div class="col-md-4">
            <select name="slot" class="form-control">
              <option value="" selected>Select Take Time</option>
              <option value="Before Food" <?php if ($this->input->post('slot') === "Before Food") {
                                            echo "selected";
                                          } ?>>Before Food</option>
              <option value="After Food" <?php if ($this->input->post('slot') === "After Food") {
                                            echo "selected";
                                          } ?>>After Food</option>
              <option value="Anytime" <?php if ($this->input->post('slot') === "Anytime") {
                                        echo "selected";
                                      } ?>>Anytime</option>
            </select>

          </div>
        </div>
        <div class="clearfix"></div>
    </fieldset>
    <div class="form-group">
      <div class="col-md-4"><input type="submit" name='submit' id='submit' value='Search' class="form-control btn btn-info" /></div>
      <div class="col-md-4"><?php echo anchor('drug', 'Clear', array('class' => 'form-control btn btn-info')); ?></div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
</div>

<h3 id="drugListTitle"><?php echo "- " . @$title; ?></h3>

<?php //pagination should be added if have time.
if ($drugs) {
  echo "<div id='druglist'>" . $pagination . "<div class='table-responsive'><table id='drug_list_table' class='table table-bordered table-striped'><thead><tr>
           <th>Sr.</th>
           <th>Category</th>
           <th>Name</th>
           <th>No. of Days</th>
           <th>No. of Times</th>
           <th>Take Time</th>
           <!-- th>نام اردو</th -->
           <!-- th>Unit Price</th -->
           <th>Drug (MG)</th>
           <th>Drug (ML)</th>
           <th>Dosage</th>
           <th>Usage Count</th>
           <!-- th>Memo</th -->
           <th>Actions</th>
       </tr></thead><tbody>";
  $start = ($page - 1) * $per_page;
  $i = 0;
  $serial = 1;
  foreach ($drugs as $_drug) {
    if ($i >= (int)$start && $i < (int)$start + (int)$per_page) {
      $actions = '';
      if ($this->bitauth->has_role('pharmacy')) {
        $actions .= anchor('drug/edit/' . $_drug->drug_id, '<span class="glyphicon glyphicon-edit"></span>', array('title' => 'Edit Drug'));
        $actions .= anchor('drug/delete/' . $_drug->drug_id, '<span class="glyphicon glyphicon-remove"></span>', array('title' => 'Delete Drug'));
        $actions .= anchor('drug/check/' . $_drug->drug_id, '<span class="glyphicon glyphicon-check"></span>', array('title' => 'Check Availability'));
      }
      $total_count = 0;
      if (array_key_exists($_drug->drug_id, $usage_count)) {
        $total_count = $usage_count[$_drug->drug_id];
      }

      echo '<tr id="drug' . $_drug->drug_id . '" title="' . $_drug->memo . '">' .
        '<td>' . $serial . '</td>' .
        '<td>' . html_escape($_drug->category) . '</td>' .
        '<td>' . html_escape($_drug->drug_name_en) . '</td>' .
        '<td>' . html_escape($_drug->no_of_item) . '</td>' .
        '<td>' . html_escape($_drug->times) . '</td>' .
        '<td>' . html_escape($_drug->slot) . '</td>' .
        '<!-- td>' . html_escape($_drug->drug_name_fa) . '</td -->' .
        '<!-- td>' . html_escape($_drug->price) . '</td -->' .
        '<td>' . html_escape($_drug->dosage_mg) . '</td>' .
        '<td>' . html_escape($_drug->dosage_ml) . '</td>' .
        '<td>' . html_escape($_drug->dosage) . '</td>' .
        '<td>' . html_escape($total_count) . '</td>' .
        '<!-- td>' . html_escape(character_limiter($_drug->memo, 50, '...')) . '</td -->' .
        '<td class="hidden-print">' . $actions . '</td>' .
        '</tr>';
    }
    $i++;
    $serial++;
  }
  echo '</tbody></table></div>' . $pagination . "</div>";
?>
  <script>
    $(document).ready(function() {
      $('#drug_list_table a').on('click', function(e) {
        if ($(this).attr('title') == 'Delete Drug') {
          e.preventDefault();
          $.get($(this).attr('href'), '', function(data) {
            $('#tmpDiv').html(data);
          });
        }
      });
      $('#drug_list_table a').on('click', function(e) {
        if ($(this).attr('title') == 'Check Availability') {
          e.preventDefault();
          $.get($(this).attr('href'), '', function(data) {
            $('#tmpDiv').html(data);
          });
        }
      });
    });
  </script>
<?php
}
echo '<div class="hidden-print">' . anchor('drug/new_drug', 'Register new drug', array('class' => 'hidden-print')) . '</div>';
?>

<script>
  $(document).ready(function() {
    //formfield toggle script
    $('#drugListTitle').on('click', function() {
      $(this).parent().find('#druglist').toggle();

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
</script>