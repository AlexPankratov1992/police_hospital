<div id="cPanel" class="">
  <?php
  if (!$this->bitauth->get_users())
    include_once 'cp/admin.php';
  if ($this->bitauth->logged_in()) {
    if ($this->bitauth->is_admin())
      include_once 'cp/admin.php';
    //      if($this->bitauth->logged_in()) 
    include_once 'cp/doctor.php';
    if ($this->bitauth->has_role('receptionist'))
      include_once 'cp/receptionist.php';
    if ($this->bitauth->has_role('pharmacy'))
      include_once 'cp/pharmacy.php';
    if ($this->bitauth->has_role('lab'))
      include_once 'cp/lab.php';
    if ($this->bitauth->has_role('xray'))
      include_once 'cp/xray.php';
  }
  ?>
  <style>
    #cPanel a:hover {
      transform: scale(1.1);
      font-size: large;
    }

    #cPanel a {
      width: 180px;
      height: 80px;
      margin-right: 15px;
      margin-bottom: 8px;
      border-radius: 27px;
      font-size: medium;
      padding: 15px;
    }
  </style>
</div>