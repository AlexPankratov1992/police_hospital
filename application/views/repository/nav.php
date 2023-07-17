<style>
  .icon-button {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    color: #333333;
    /* background: #dddddd; */
    border: none;
    outline: none;
    border-radius: 50%;
    top: 11px;
  }

  .icon-button:hover {
    cursor: pointer;
  }

  .icon-button:active {
    background: #cccccc;
  }

  .icon-button__badge {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 25px;
    height: 25px;
    background: red;
    color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
  }
</style>
<?php
if (empty($session_status)) {
  $session_status = current_session();
}
?>
<nav id="main_nav" class="navbar navbar-default" role="navigation">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <div class="navbar-header">

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

      <span class="sr-only">Toggle navigation</span>

      <span class="icon-bar"></span>

      <span class="icon-bar"></span>

      <span class="icon-bar"></span>

    </button>

    <a class="navbar-brand" href="#" onclick="$('#main_nav').toggleClass('navbar-fixed-top');$('#fixedNavPadding').toggleClass('hidden');return false;"></a>

  </div>

  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">

      <li id="navbarLiHome"><?php echo anchor('', '<span class="glyphicon glyphicon-home"></span> Home'); ?></li>
      <li id="navbarLiHome"><?php echo anchor('home/dashboard', '<span class="glyphicon glyphicon-dashboard"></span> Dashboard'); ?></li>

      <!-- li id="navbarLiReport"><?php echo anchor('report_bug/add', '<span class="glyphicon glyphicon-file"></span> Report a Bug', array('onclick' => "jQuery.get($(this).attr('href'),'',function(data){jQuery('#tmpDiv').html(data);});return false;")); ?></li -->
      <?php
      if ($this->bitauth->has_role('receptionist')) {
      ?>

        <li id="navbarLiSession"><a <?php echo $session_status; ?> href="" data-toggle="modal" data-target="#form"><span class="glyphicon glyphicon-off" <?php echo $session_status; ?>></span> Session</a></li>

        <button title="Waiting Patients List" type="button" class="icon-button glyphicon glyphicon-time" onclick="window.location='<?php echo site_url('patient/waiting') ?>';" style="float: left;">
          <span class="material-icons"></span>
          <span class="icon-button__badge" <?php if (waiting_total() === 0) {
                                              echo "style='background: green !important;'";
                                            } ?>><?php echo waiting_total(); ?></span>
        </button>
        <button title="InProgress Patients List" type="button" class="icon-button glyphicon glyphicon-repeat" onclick="window.location='<?php echo site_url('patient/inprogress') ?>';" style="float: right; margin-left: 11px;">
          <span class="material-icons"></span>
          <span class="icon-button__badge" <?php if (inprogress_total() === 0) {
                                              echo "style='background: green !important;'";
                                            } ?>><?php echo inprogress_total(); ?></span>
        </button>

      <?php
      }
      ?>

      <?php

      if ($this->bitauth->is_admin())

        include_once 'nav/admin.php';

      elseif ($this->bitauth->has_role('doctor'))

        include_once 'nav/doctor.php';

      elseif ($this->bitauth->has_role('xray'))

        include_once 'nav/xray.php';

      elseif ($this->bitauth->has_role('lab'))

        include_once 'nav/lab.php';

      elseif ($this->bitauth->has_role('pharmacy'))

        include_once 'nav/pharmacy.php';

      elseif ($this->bitauth->has_role('receptionist'))

        include_once 'nav/receptionist.php';

      elseif ($this->bitauth->has_role('guest'))

        include_once 'nav/guest.php';

      elseif ($this->bitauth->has_role('patient'))

        include_once 'nav/patient.php';

      else

        include_once 'nav/default.php';

      ?>
      <li>
        <div class='form-group' style="margin-left:10px;">
          <?php echo "<input type='text' placeholder='Card Number' id='goToPatient' style='margin-top:10px;    width: 105px;     border: 2px solid ivory !important' href='" .  site_url('patient/panelCard') . "'/>"; ?>
          <div id='patientList2'>
          </div>
        </div>
      </li>
      <li id="navbarGoTo" style="margin-left:10px;">
        <?php echo "<input type='number' placeholder='Mobile Number' id='goToPatient2' style='margin-top:10px;     width: 118px;     border: 2px solid ivory' href='" .  site_url('patient/panelMobile') . "'/>"; ?>
      </li>
      <li>
        <div class='form-group' style="margin-left:10px;">
          <input type='text' placeholder='Name/Father Name' id='patientName' style='margin-top:10px;     width: 141px;border: 2px solid ivory' />
          <div id='patientList'>

          </div>
        </div>
      </li>


      <li class="dropdown">
        <!-- Fixed on all users -->

        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

          <span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('ba_first_name') . ' ' . $this->session->userdata('ba_last_name'); ?> <b class="caret"></b>

        </a>

        <ul class="dropdown-menu">

          <li><?php echo anchor('account/edit_user/' . $this->session->userdata('ba_user_id'), '<span class="glyphicon glyphicon-user"></span> Profile'); ?></li>

          <li class="divider"></li>

          <li><?php echo anchor('account/logout', '<span class="glyphicon glyphicon-off"></span> Logout'); ?></li>

        </ul>

      </li>

    </ul>

  </div>

  <?php if (isset($navActiveId)) { ?>

    <script>
      $(document).ready(function() {
        $('#<?php echo $navActiveId ?>').addClass('active');


        $('#main_nav').toggleClass('navbar-fixed-top');
        $('#fixedNavPadding').toggleClass('hidden');
      });


      $("#goToPatient3").datepicker({
        dateFormat: 'mm/dd/yy',
        onSelect: function(dateText) {
          // alert("Selected date: " + dateText + "; input's current value: " + this.value);
          var date = $(this).val();
          console.log(date, 'change')
          var val = $(this).val();
          window.location = $(this).attr('href') + '/' + val;
        }
      });
    </script>

  <?php } ?>

</nav>