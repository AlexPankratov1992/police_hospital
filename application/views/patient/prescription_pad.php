<style>
  @media print {

    html,
    body,
    .prescription_form {
      height: 96% !important;
      left:50%;
    }
  }

  input {
    border: none
  }

  body {
    transition: all 0.3s ease;
  }

  .wrapper {
    height: 100vh;
    width: 100vw;
    display: flex;
    flex-direction: column;
    background: red;
    margin: 50px;
  }

  .prescription_form {
    width: 100%;
    height: 100vh;

    background: white;
  }

  .prescription {
    width: 720px;
    height: 960px;
    margin: 0 auto;
    /* border: 1px solid lightgrey; */
  }

  .prescription tr>td {
    padding: 15px;
  }

  .header {
    color: #333;
    width: 100%;
    display: flex;
    justify-content: space-between;
    /* align-items: center; */
  }

  .logo {
    flex: 1;
    padding-left: 0px;
    font-weight: bold;
    float: right;
    text-align: right;
    font-size: 19px;
    line-height: 17px;
    margin-right: 75px;
  }

  .logo img {
    width: 120px;
    height: 120px;
    float: left;
  }

  .credentials {
    flex: 1;
    /*direction: rtl;*/
    line-height: 3px;
    text-align: right;
    position: relative;
    right: 28px;
  }

  .credentials h4 {
    line-height: 1em;
    letter-spacing: 1px;
    font-weight: 700;
    margin: 0px;
    padding: 0px;
  }

  .credentials p {
    margin: 0 0 5px 0;
    padding: 3px 0px;
  }

  .credentials small {
    margin: 0;
    padding: 0;
    letter-spacing: 0px;
    font-style: italic;
    /* padding-right: 80px; */
    font-weight: 600;
  }

  .d-header {
    width: 100%;
    /* text-align: center;*/
    background: mediumseagreen;
    padding: 5px;
    color: white;
    font-weight: 800;
  }

  .symptoms,
  .tests,
  .advice {
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .symptoms ul,
  .tests ul {
    list-style: square;
    margin: 0;
    padding-left: 10px;
    height: 100%;
  }

  .advice p {
    letter-spacing: 0;
    font-size: 14px;
  }

  .advice .adv_text {
    flex-grow: 1;
    width: 100%;
    height: 100%;
  }

  .desease_details {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
  }

  .med_name {
    font-size: 16px;
    font-weight: bold;
    padding: 0;
  }

  .taking_time {
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
    text-align: right;
  }

  .schedual {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .sc_time {
    margin: 0;
    padding: 0;
    float: left;
  }

  .sc_time span {
    font-weight: bold;
    margin-right: 1rem;
  }

  .sc {
    border: none;
    outline: none;
    font-size: 15px;
  }

  select {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    appearance: none;
    outline: 0;
    box-shadow: none;
    border: 0 !important;
    background: #fff;
    background-image: none;
  }

  select::-ms-expand {
    display: none;
  }

  .select {
    font-size: 15px;
    color: #335;
    position: relative;
    float: left;
    overflow: hidden;
    position: relative;
    right: 12px;
  }

  select {
    font-weight: bold;
    padding: 0 0.5em;
    color: #333;
    cursor: pointer;
    outline: none;
  }

  .med_name {
    border: 0;
    outline: 0;
  }

  .period {
    font-size: 14px;
  }

  input[type="date"] {
    padding: 0;
    margin: 0;
    font-weight: bold;
    border: none;
  }

  .medicine {
    display: flex;
    flex-flow: column;
    height: 100%;
  }

  .med_name_action,
  .med_when_action,
  .med_period_action {
    display: none;
  }

  .med_meal_action .btn {
    margin: 2px;
  }

  .med_period {
    border: none;
    outline: none;
  }

  #add_med {
    margin: 20px 5px;
    flex-grow: 1;
  }

  #add_med {
    animation: shake 1.5s linear infinite;
  }

  @keyframes shake {

    10%,
    90% {
      transform: translate3d(-1px, 0, 0);
    }

    20%,
    80% {
      transform: translate3d(2px, 0, 0);
    }

    30%,
    50%,
    70% {
      transform: translate3d(-4px, 0, 0);
    }

    40%,
    60% {
      transform: translate3d(4px, 0, 0);
    }

    95% {
      opacity: 0;
    }
  }

  #add_symptoms {
    margin: 20px 5px;
    flex-grow: 1;
    opacity: 1;
  }

  .symp_action,
  .test_action,
  .adv_action {
    display: none;
  }

  .med_footer {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  hr {
    /* margin: 10px 0px; */
  }

  .med:hover hr {
    /* border-top: 3px #111 solid; */
  }

  .med_period_action {
    float: right;
  }

  span.date {
    color: #333399;
    float: right;
    clear: both;
    position: relative;
    right: 21px;    
  }

  .del_action {
    width: 100%;
    text-align: right;
  }

  .delete {
    width: 50px;
    opacity: 0;
    display: none;
  }

  .med:hover .delete {
    /* display: inline; */
    /* opacity: 1; */
  }

  .folded {
    visibility: hidden;
  }

  .button_group {
    position: fixed;
    right: 120px;
    bottom: 100px;
  }

  #snacking,
  #snacked {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
  }

  #snacking.show,
  #snacked.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
  }

  @-webkit-keyframes fadein {
    from {
      bottom: 0;
      opacity: 0;
    }

    to {
      bottom: 30px;
      opacity: 1;
    }
  }

  @keyframes fadein {
    from {
      bottom: 0;
      opacity: 0;
    }

    to {
      bottom: 30px;
      opacity: 1;
    }
  }

  @-webkit-keyframes fadeout {
    from {
      bottom: 30px;
      opacity: 1;
    }

    to {
      bottom: 0;
      opacity: 0;
    }
  }

  @keyframes fadeout {
    from {
      bottom: 30px;
      opacity: 1;
    }

    to {
      bottom: 0;
      opacity: 0;
    }
  }

  /* New css for header patient info row */
  .patient-info {
    padding: 0px !important;
    padding-left: 5px !important;
    height: 31px;
  }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<div class="wrapper">
  <div class="prescription_form">
    <table class="prescription" data-prescription_id="" border="0">
      <tbody>
        <tr height="15%">
          <td colspan="2">
            <div class="header">
              <div class="logo">
                <p><?= $p_data->col_1_row_1 ?></p>
                <p><small><?= $p_data->col_1_row_2 ?></small></p>
                <p><small><?= $p_data->col_1_row_3 ?></small></p>
              </div>
              <div>
                <img src="<?= $p_data->col_2_image ?>" />
              </div>
              <div class="credentials">
                <p><small><?= $p_data->col_3_row_1 ?></small></p>
                <p><small><?= $p_data->col_3_row_2 ?></small></p>
                <p><small><?= $p_data->col_3_row_3 ?></small></p>
                <p><small><?= $p_data->col_3_row_4 ?></small></p>
                <p><small><?= $p_data->col_3_row_5 ?></small></p>
                <p><small><?= $p_data->col_3_row_6 ?></small></p>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="patient-info">
            <strong class="patient-info">Name:</strong> <u class="patient-info"><input value="<?php echo $patient->first_name;  ?>" size="13" /></u>
            <strong class="patient-info">Card#</strong><u class="patient-info"><input value="<?php echo $patient->card_no; ?>" size="2"></u><strong>Age:</strong>
            <input size="20" value="<?php
                                    if ($patient->birth_date != "0000-00-00") {
                                      //echo $patient->birth_date . " <br>";
                                      $interval = date_diff(date_create(), date_create($patient->birth_date));
                                      // echo $interval->format("%Y Year(s), %M Month(s),%D Day(s)");
                                      echo $interval->format("%Y Yr(s),%M Mth(s),%D Day(s)");
                                    } else {
                                      echo "-----------";
                                    }
                                    ?>" />
            <div style="text-align: right !important;float: right;    position: relative;
    right: 46px;
    font-size: 13px;"><strong>Dated:</strong><u><?php echo date("d/m/Y"); ?></u></div>
          </td>

        </tr>
        <tr>
          <td width="20%" style="    border-right: 1px solid;">
            <div class="desease_details">

              <div class="symptoms">
                <h4 class="d-header">Examination</h4>
                <ul class="symp" data-toggle="tooltip" data-placement="bottom" title="" contenteditable="true" data-original-title="">
                  <?php if (!empty($examination->ofc)) echo "<li>OFC \t: \t" . $examination->ofc . "</li>"; ?>
                  <?php if (!empty($examination->weight)) echo "<li>Weight:\t" . $examination->weight . "</li>"; ?>
                  <?php if (!empty($examination->height)) echo "<li>Height:\t" . $examination->height . "</li>"; ?>
                  <?php if (!empty($examination->bp)) echo "<li>BP \t: \t" . $examination->bp . "</li>"; ?>
                  <?php if (!empty($examination->temperature)) echo "<li>Temperature \t: \t" . $examination->temperature . "</li>"; ?>
                  <?php if (!empty($examination->oxygen_sat)) echo "<li>Oxygen Sat: \t" . $examination->oxygen_sat . "</li>"; ?>
                  <?php if (!empty($examination->xrayr)) // echo "<li>Xray Results: \t" . $examination->xrayr . "</li>"; 
                  ?>
                  <?php if (!empty($examination->labr)) // echo "<li>Lab Test Results: \t" . $examination->labr . "</li>"; 
                  ?>
                </ul>
                <!-- div class="symp_action">
                  <button id="symp_save" data-prescription_id="" class="btn btn-sm btn-success save">Save</button>
                  <button class="btn btn-sm btn-danger cancel-btn">Cancel</button>
                </div -->
              </div>
              <div class="tests">
                <h4 class="d-header">Tests</h4>
                <ul class="tst" data-toggle="tooltip" data-placement="bottom" title="" contenteditable="true" data-original-title="">
                  <?php
                foreach ($lab as $l) {
                  if (!empty($l->test_name_en)) echo "<li>" . $l->test_name_en . "</li>";
                }
                  ?>

                </ul>
                <!-- div class="test_action">
                  <button id="test_save" data-prescription_id="" class="btn btn-sm btn-success save">Save</button>
                  <button class="btn btn-sm btn-danger cancel-btn">Cancel</button>
                </div -->
              </div>
              <div class="tests">
                <h4 class="d-header">X-Ray</h4>
                <ul class="tst" data-toggle="tooltip" data-placement="bottom" title="" contenteditable="true" data-original-title="">

                  <?php
                  foreach ($xrays as $x) {
                    if (!empty($x->xray_name_en)) echo "<li>" . $x->xray_name_en . "</li>";
                  }
                  ?>

                </ul>
                <div class="adv_action">
                  <button id="adv_save" data-prescription_id="" class="btn btn-sm btn-success save">Save</button>
                  <button class="btn btn-sm btn-danger cancel-btn">Cancel</button>
                </div>
              </div>
            </div>
          </td>
          <td width="60%" valign="top">

            <span style="font-size: 3em;">R<sub>x</sub></span>
            <div class="medicine">
              <section class="med_list">
                <?php
                foreach ($drugs as $d) { ?>

                  <div class="med">
                    ⚫ <input class="med_name" data-med_id="2" data-toggle="tooltip" title="" placeholder="Enter medicine name" value="<?php if (!empty($d->drug_name_en)) echo "" . $d->drug_name_en . "" ?>" data-original-title="">
                    <!-- div class="med_name_action" style="display: none;">
                      <button data-med_id="2" class="btn btn-sm btn-success save">Save</button>
                      <button class="btn btn-sm btn-danger cancel-btn">Cancel</button>
                    </div -->
                    <div class="schedual">
                      <div class="sc_time">
                        <input type="text" name="product" size="20" list="dosage_times" value="<?php
                                                                                                if ($d->times === '1 time') echo (!empty($d->dosage)) ? "0+0+" . number_format($d->dosage, 2, '.', '') . "ml" : '0+0+1';
                                                                                                if ($d->times === '2 times') echo (!empty($d->dosage)) ? number_format($d->dosage, 2, '.', '') . "ml+0+" . number_format($d->dosage, 2, '.', '') . "ml" : '1+0+1';
                                                                                                if ($d->times === '3 times') echo (!empty($d->dosage)) ? number_format($d->dosage, 2, '.', '') . "ml+" . number_format($d->dosage, 2, '.', '') . "ml+" . number_format($d->dosage, 2, '.', '') . "ml" : '1+1+1';
                                                                                                if ($d->times === 'L/A x 3') echo 'L/A x 3';
                                                                                                ?>" />
                        <datalist class="sc" data-med_id="2" id="dosage_times">
                          <option value="L/A x 1">L/A x 1</option>
                          <option value="L/A x 2">L/A x 2</option>
                          <option value="L/A x 3">L/A x 3</option>
                          <option value="L/A x 4">L/A x 4</option>
                          <option value="L/A x 5">L/A x 5</option>
                          <option value="1+1+1">1+1+1</option>
                          <option value="1+0+1">1+0+1</option>
                          <option value="0+1+1">0+1+1</option>
                          <option value="1+0+0">1+0+0</option>
                          <option value="0+0+1">0+0+1</option>
                          <option value="1+1+1+1">1+1+1+1</option>

                          <option value="1ml+1ml+1ml">1ml+1ml+1ml</option>
                          <option value="1ml+0+1ml">1ml+0+1ml</option>
                          <option value="0+1ml+1ml">0+1ml+1ml</option>
                          <option value="1ml+0+0">1ml+0+0</option>
                          <option value="0+0+1ml">0+0+1ml</option>
                          <option value="1ml+1ml+1ml+1ml">1ml+1ml+1ml+1ml</option>

                          <option value="2ml+2ml+2ml">2ml+2ml+2ml</option>
                          <option value="2ml+0+2ml">2ml+0+2ml</option>
                          <option value="0+2ml+2ml">0+2ml+2ml</option>
                          <option value="2ml+0+0">2ml+0+0</option>
                          <option value="0+0+2ml">0+0+2ml</option>
                          <option value="2ml+2ml+2ml+2ml">2ml+2ml+2ml+2ml</option>

                          <option value="3ml+3ml+3ml">3ml+3ml+3ml</option>
                          <option value="3ml+0+3ml">3ml+0+3ml</option>
                          <option value="0+3ml+3ml">0+3ml+3ml</option>
                          <option value="3ml+0+0">3ml+0+0</option>
                          <option value="0+0+3ml">0+0+3ml</option>
                          <option value="3ml+3ml+3ml+3ml">3ml+3ml+3ml+3ml</option>

                          <option value="4ml+4ml+4ml">4ml+4ml+4ml</option>
                          <option value="4ml+0+4ml">4ml+0+4ml</option>
                          <option value="0+4ml+4ml">0+4ml+4ml</option>
                          <option value="4ml+0+0">4ml+0+0</option>
                          <option value="0+0+4ml">0+0+4ml</option>
                          <option value="4ml+4ml+4ml+4ml">4ml+4ml+4ml+4ml</option>
                        </datalist>
                        <?php if (!empty($d->dosage)) // echo "(" . $d->dosage . "ml each time)"; 
                        ?>
                        <!-- div class="med_when_action" style="display: none;">
                          <button data-med_id="2" class="btn btn-sm btn-success save">✓</button>
                        </div -->
                      </div>
                      <div class="taking_time select">
                        <select class="meal" data-med_id="2">
                          <?php if (!empty($d->slot)) echo '<option value="1" selected="">' . $d->slot . '</option>' ?>
                          <option value="2">Before Meal</option>
                          <option value="3">Take any time</option>
                          <option value="2">After Meal</option>
                        </select>
                        <!-- div class="med_meal_action" style="display: none;">
                          <button data-med_id="2" class="btn btn-sm btn-success save">✓</button>
                        </div -->
                      </div>
                    </div>
                    <div class="med_footer">
                      <div class="period">
                        Take for <input class="med_period" type="text" data-med_id="2" placeholder="? days/weeks..." value="<?php if (!empty($d->no_of_item)) echo '' . $d->no_of_item . ' day(s)' ?>">
                        <!-- div class="med_period_action" style="display: none;">
                          <button data-med_id="2" class="btn btn-sm btn-success save">✓</button>
                        </div -->
                        <span class="date">(Untill <?php echo date('d-M-y', strtotime(date("Y-m-d") . '+' . $d->no_of_item . ' day')) ?>)</span>
                      </div>
                      <!-- div class="del_action">
                        <button data-med_id="2" class="btn btn-sm btn-danger delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                      </div -->
                    </div>
                  </div>



                <?php } ?>


              </section>

            </div>

          </td>
        </tr>
      </tbody>
    </table>
    <div class="button_group hidden-print">
      <button class="issue_prescription btn btn-success" onclick="window.print();">Print</button>
      <button class="pdf_prescription btn btn-danger" onclick="history.back();">Go Back</button>
      <!-- button class="pdf_prescription btn btn-danger">PDF</button -->
    </div>
    <div id="snacking">Saving...</div>
    <div id="snacked">Saved!</div>
  </div>
</div>


<script>
  $(document).ready(function() {
    Date.prototype.calcDate = function(days) {
      let date = new Date(this.valueOf());
      date.setDate(date.getDate() + days);
      return `(Untill ${date.getUTCDate()}-${date.getUTCMonth() +
			1}-${date.getUTCFullYear()})`;
    };
    let timeout;

    function snackSaving() {
      let snack = document.getElementById("snacking");
      snack.className = "show";
      timeout = setTimeout(() => {
        alert('ERR: Conection timeout.')
      }, 8000);
    }

    function snackSaved() {
      clearTimeout(timeout);
      let snack = document.getElementById("snacking");
      snack.className = snack.className.replace("show", "");
      let snacked = document.getElementById("snacked");
      snacked.className = "show";
      setTimeout(function() {
        snacked.className = snacked.className.replace("show", "");
      }, 1500);
    }
    $("[data-toggle=tooltip]").tooltip("show");
    setTimeout(function() {
      $("[data-toggle=tooltip]").tooltip("hide");
    }, 5000); //hide tooltips after 5sec
    $(document).keyup(function() {
      $("[data-toggle=tooltip]").tooltip("hide");
    }); //hide tooltip while typing
    $(document).on("focusin keypress", ".med_name", function(e) {
      let x = $(this).siblings("div.med_name_action");
      if (e.type == "focusin") {
        x.css("display", "block");
      }
      if (e.type == "keypress") {
        if (e.keyCode == 13) x.children("button.save").click();
      }
    });

    $(document).on("click", ".cancel-btn", function() {
      $(this)
        .parent()
        .css("display", "none"); //hides save/cancel btn
    });
    $(document).on("click", ".med_name_action button.save", function() {
      $(this)
        .parent()
        .css("display", "none");
      $(".sc_time").removeClass("folded");
    });
    $(".med_name").keypress(function(e) {
      if (e.which == 13) {
        $("#symp_save").click();
      }
    });

    $(document).on("mousedown", ".sc", function(e) {
      let x = $(this).siblings("div.med_when_action");
      x.css("display", "block");
    });
    $(document).on("click", ".med_when_action button.save", function() {
      $(this)
        .parent()
        .css("display", "none");
      $(".select").removeClass("folded");
    });
    $("select.sc").change(function() {
      let x = $(this).siblings("div.med_when_action");
      x.css("display", "none");
    });

    $(document).on("mousedown", ".meal", function() {
      let x = $(this).siblings("div.med_meal_action");
      x.css("display", "block");
    });
    $(document).on("click", ".med_meal_action button.save", function() {
      $(this)
        .parent()
        .css("display", "none");
      $(".period").removeClass("folded");
    });

    $(document).on("focusin keypress", ".med_period", function(e) {
      let x = $(this).siblings("div.med_period_action");
      if (e.type == "focusin") {
        x.css("display", "block");
      }
      if (e.type == "keypress") {
        if (e.keyCode == 13) x.children("button.save").click();
      }
    });
    $(document).on("click", ".med_period_action button.save", function() {
      $(this)
        .parent()
        .css("display", "none");
    });
    $(document).on("keyup", ".med_period", function() {
      let period = $(this).val();
      let num = +period.match(/\d+/g)[0];
      let type = period.match(/\b(\w)/g)[1];
      let days = null;
      if (type == "d") days = num;
      else if (type == "w") days = num * 7;
      else if (type == "m") days = num * 30;
      else if (type == "y") days = num * 365;
      let span = $(this).siblings("span.date");
      if (days) {
        let date = new Date().calcDate(days);
        span.html(date);
      } else {
        span.html("(Invalid time period)");
      }
    });

    $(".sc").keyup(function(e) {
      if (isNaN(e.key)) return;
      let el = $(this);
      el = el
        .val()
        .split("-")
        .join("");
      let finalVal = el.match(/.{1,1}/g).join("-");
      $(this).val(finalVal);
    });

    function initLi(e) {
      let txt = e.target.innerHTML;
      if (!txt.includes("<li>")) {
        let el = "<li></li>";
        $(this).append(el);
      }
    }
    $(".symptoms ul").focusin(initLi);
    $(".symptoms ul").keyup(function(e) {
      let fl = $(this)
        .children()
        .first();
      let el = `<li>${e.target.textContent}</li>`;
      if (fl.text().length < 1) {
        $(this).html("");
        $(this).append(el);
      }
    });
    $("#symp_save").click(function() {
      $(".symp_action").css("display", "none");
    });

    $(".tests ul").focusin(initLi);
    $(".tests ul").keyup(function() {
      let fl = $(this)
        .children()
        .first();
      let el = "<li></li>";
      if (fl.text().length < 1) {
        $(this).html("");
        $(this).append(el);
      }
    });
    $("#test_save").click(function() {
      $(".test_action").css("display", "none");
    });

    $(".symptoms ul").focusin(function() {
      $(".symp_action").css("display", "block");
    });

    $(".tests ul").focusin(function() {
      $(".test_action").css("display", "block");
    });

    $(".advice p").focusin(function() {
      $(".adv_action").css("display", "block");
    });

    $("#adv_save").click(function() {
      $(".adv_action").css("display", "none");
    });

    $(document).on("click", ".delete", function() {
      let parent = $(this).closest(".med");
      parent.remove();
    });

    let med_id = 1;
    $("#add_med").click(function() {
      med_id++;
      let sourceTemplate = $("#new_medicine").html();
      Mustache.parse(sourceTemplate);
      let sourceHTML = Mustache.render(sourceTemplate, {
        med_id
      });
      let medicine = $(".med_list");
      medicine.append(sourceHTML);
    })
  });
</script>