<?php
include 'view_config.php';
if ($this->input->post("passcode") === "13579") {
  setcookie('dash_pass', 'true');
  $_COOKIE['dash_pass'] = 'true';
?>
  <script>
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Welcome to Dashboard',
      showConfirmButton: false,
      timer: 2500
    })
  </script>
<?php

}
if ($this->input->post("passcode") && $this->input->post("passcode") !== "13579") {
?>
  <script>
    Swal.fire({
      position: 'center',
      icon: 'error',
      title: 'Dashboard Passcode is invalid. Please try again. Thanks',
      showConfirmButton: false,
      timer: 2500
    })
  </script>
<?php
}

if (!isset($_COOKIE['dash_pass'])) {
  // setcookie('lg', 'ro');
  // $_COOKIE['lg'] = 'ro';
  echo form_open('home/dashboard', array("id" => "newDashboardForm", "role" => "form",));
  echo '<div class="form-group"><div class="col-md-4"><input type="text" name="passcode" id="passcode" placeholder="Enter Dashboard Passcode" value="" class="form-control"></div';
  echo '<div class="col-md-4">';
  echo '<div class="col-md-4"><input type="submit" name="submit" id="submit" value="Proceed" class="form-control btn btn-info" /></div><div class="col-md-4">';
  echo anchor('/', 'Go Back', array('class' => 'form-control btn btn-danger', 'id' => 'goback'));
  echo '</div></div></div>';
} else {
?>
  <a href="" id=" remove-passcode" onclick="delete_cookie()">Forget Passcode</a><br />

  <section class="row">
    <aside class="col col-sm-3">
      <?php
      if (strtolower($title) != 'login')
        if (!$this->bitauth->logged_in())
          include_once 'account/login.php';
        else
          include_once 'repository/sidebar.php';
      ?>
    </aside>
    <article class="col col-sm-9" id="mainContent" style="/*right: 8.5%;*/">
      <?php
      if (@$includes)
        foreach ($includes as $include)
          include_once $include . '.php';
      ?>
    </article>
    <?php
    /*<aside class="col col-sm-3">
  
  </aside>*/
    ?>
  </section>

<?php } ?>
<script>
  function delete_cookie() {
    document.cookie = "dash_pass= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
  }
</script>