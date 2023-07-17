<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="custom.css">
<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,500,600" rel="stylesheet" type="text/css">

<style>
  .main-section {
    width: 80%;
    margin: 0 auto;
    text-align: center;
    padding: 0px 5px;
  }

  .dashbord {
    width: 32%;
    display: inline-block;
    background-color: #34495E;
    color: #fff;
    margin-top: 50px;
  }

  .icon-section i {
    font-size: 30px;
    padding: 10px;
    border: 1px solid #fff;
    border-radius: 50%;
    margin-top: -25px;
    margin-bottom: 10px;
    background-color: #34495E;
  }

  .icon-section p {
    margin: 0px;
    font-size: 20px;
    padding-bottom: 10px;
  }

  .detail-section {
    background-color: #2F4254;
    padding: 5px 0px;
  }

  .dashbord .detail-section:hover {
    background-color: #5a5a5a;
    cursor: pointer;
  }

  .detail-section a {
    color: #fff;
    text-decoration: none;
  }

  .dashbord-green .icon-section,
  .dashbord-green .icon-section i {
    background-color: #16A085;
  }

  .dashbord-green .detail-section {
    background-color: #149077;
  }

  .dashbord-orange .icon-section,
  .dashbord-orange .icon-section i {
    background-color: #F39C12;
  }

  .dashbord-orange .detail-section {
    background-color: #DA8C10;
  }

  .dashbord-blue .icon-section,
  .dashbord-blue .icon-section i {
    background-color: #2980B9;
  }

  .dashbord-blue .detail-section {
    background-color: #2573A6;
  }

  .dashbord-red .icon-section,
  .dashbord-red .icon-section i {
    background-color: #E74C3C;
  }

  .dashbord-red .detail-section {
    background-color: #CF4436;
  }

  .dashbord-skyblue .icon-section,
  .dashbord-skyblue .icon-section i {
    background-color: #8E44AD;
  }

  .dashbord-skyblue .detail-section {
    background-color: #803D9B;
  }
</style>
<div class="main-section">
  <div class="dashbord">
    <div class="icon-section">
      <i class="fa fa-users" aria-hidden="true"></i><br>
      <small>Total Patients</small>
      <p><?= $total_patients ?></p>
    </div>
    <div class="detail-section">
      <a href="../patient">More Info </a>
    </div>
  </div>
  <div class="dashbord dashbord-red">
    <div class="icon-section">
      <i class="fa fa-money" aria-hidden="true"></i><br>
      <small>Current Month Collection</small>
      <p><?= $monthly_collection ?> Rupees</p>
    </div>
    <div class="detail-section">
      <a href="../patient/collectionListMonthly">More Info </a>
    </div>
  </div>
  <div class="dashbord dashbord-skyblue">
    <div class="icon-section">
      <i class="fa fa-clock-o" aria-hidden="true"></i><br>
      <small>Clinic Sessions</small>
      <p><?= $total_sessions ?></p>
    </div>
    <div class="detail-section">
      <a href="../patient/sessionlist">More Info </a>
    </div>
  </div>
  <div class="dashbord dashbord-green">
    <div class="icon-section">
      <i class="fa fa-check" aria-hidden="true"></i><br>
      <small>Today's Patients Treated</small>
      <p><?= $todays_patients_treated ?></p>
    </div>
    <div class="detail-section">
      <a href="../patient/treated">More Info </a>
    </div>
  </div>
  <div class="dashbord dashbord-gray">
    <div class="icon-section">
      <i class="fa fa-arrow-right" aria-hidden="true"></i><br>
      <small>Today's Patients In Progress</small>
      <p><?= $todays_patients_inprogress ?></p>
    </div>
    <div class="detail-section">
      <a href="../patient/inprogress">More Info </a>
    </div>
  </div>

  <div class="dashbord dashbord-orange">
    <div class="icon-section">
      <i class="fa fa-spinner" aria-hidden="true"></i><br>
      <small>Today's Patients Waiting</small>
      <p><?= $todays_patients_waiting ?> New</p>
    </div>
    <div class="detail-section">
      <a href="../patient/waitingList">More Info </a>
    </div>
  </div>
  <div class="dashbord dashbord-blue">
    <div class="icon-section">
      <i class="fa fa-money" aria-hidden="true"></i><br>
      <small>Today's Collections</small>
      <p><?= $todays_collection ?> Rupees</p>
    </div>
    <div class="detail-section">
      <a href="../patient/collectionList">More Info </a>
    </div>
  </div>
  <div class="dashbord dashbord-gray">
    <div class="icon-section">
      <i class="fa fa-money" aria-hidden="true"></i><br>
      <small>Today's Active Session Collections</small>
      <p><?= $todays_collection_active ?> Rupees</p>
    </div>
    <div class="detail-section">
      <a href="../patient/collectionList?session=active">More Info </a>
    </div>
  </div>
</div>