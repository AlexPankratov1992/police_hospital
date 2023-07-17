<div id='sidebar'>
  <div id="accordion" class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse">
            <span class="glyphicon glyphicon-cog"></span>
            Patients
          </a>
        </h4>
      </div>
      <div class="panel-collapse collapse in" id="collapseOne">
        <div class="panel-body">
          <table class="table">
            <tbody>
              <tr>
                <td>
                  <span class="glyphicon glyphicon-user text-primary"></span><?php echo anchor('patient/register', ' Register'); ?>
                </td>
              </tr>
              <tr>
                <td>
                  <span class="glyphicon glyphicon-user text-primary"></span><?php echo anchor('patient/', ' List'); ?>
                </td>
              </tr>
              <tr>
                <td>
                  <span class="glyphicon glyphicon-user text-primary"></span><?php echo anchor('patient/waiting', ' Waiting List'); ?>
                </td>
              </tr>
              <!-- tr>
                <td>
                  <span class="glyphicon glyphicon-print text-primary"></span><a href="#" data-toggle="modal" data-target="#myModal">Print Prescription</a>
                </td>
              </tr -->
              <!-- tr>
                <td>
                  <span class="glyphicon glyphicon-book text-primary"></span><?php echo anchor('home/session_report', ' Earning Report'); ?>
                </td>
              </tr -->
              <!-- tr>
                <td>
                  <span class="glyphicon glyphicon-book text-primary"></span><?php echo anchor('home/monthly_report', ' Monthly Report'); ?>
                </td>
              </tr -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php
    //load sidebar based on user Role to get list of all roles check bitauth config file
    if ($this->bitauth->is_admin())
      include_once 'sidebar/admin.php';
    if ($this->bitauth->has_role('doctor'))
      include_once 'sidebar/doctor.php';
    if ($this->bitauth->has_role('pharmacy'))
      include_once 'sidebar/pharmacy.php';
    if ($this->bitauth->has_role('xray'))
      include_once 'sidebar/xray.php';
    if ($this->bitauth->has_role('lab'))
      include_once 'sidebar/lab.php';
    if ($this->bitauth->has_role('receptionist'))
      include_once 'sidebar/receptionist.php';
    if ($this->bitauth->has_role('guest'))
      include_once 'sidebar/guest.php';
    if ($this->bitauth->has_role('patient'))
      include_once 'sidebar/patient.php';
    ?>
    <script>

    </script>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Search Patient</h4>
      </div>
      <div class="modal-body">
        <input type="number" min="1" id="mrn" class="form-control" name="" placeholder="MR Number" href="<?php echo site_url('patient/print_prescription_pad') ?>">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->