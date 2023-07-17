<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends CI_Controller
{

  /**
   * Patient::__construct()
   *
   */
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Karachi');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
  }

  /**
   * Patient::index()
   */
  public function index($limit = 15, $page = 1, $reverse = 1)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('patients');
    // ============== [ start advance search filters ] ============
    $search = $this->input->post();
    if ($search) {
      $card_no = $search['card_no'];
      $name = $search['name'];
      $father_name = $search['father_name'];
      $mobile_no = $search['mobile_no'];
      $address = $search['address'];
      $date_of_birth = $search['date_of_birth'];
      $gender = $search['gender'];
      $sort_by = $search['sort_by'];
      $sort_type = $search['sort_type'];

      $data['patients'] = $this->patients->search_patients($card_no, $name, $father_name, $mobile_no, $address, $date_of_birth, $gender, $sort_by, $sort_type);

      // ============== [ end   advance search filters ] ============
    } else {
      $data['patients'] = $this->patients->get_active_patients(); // (int)$reverse
    }

    // old way
    // $this->patients->getwhere('patients', array('is_active' => 1), 0, 0);
    // $this->patients->is_active = 1;
    // $this->patients->like('patients.is_active', 1);
    // $data['patients'] = $this->patients->get(0, 0, 0); // (int)$reverse
    // echo "<pre>";
    // print_r($data['patients']);
    // exit;
    $data['title'] = 'Patient List';
    $data['navActiveId'] = 'navbarLiPatient';

    $data['page'] = (int)$page;
    $data['per_page'] = (int)$limit;
    $this->load->library('pagination');
    $this->load->library('my_pagination');
    $config['base_url'] = site_url('patient/index/' . $data['per_page']);
    $config['total_rows'] = count($data['patients']);
    $config['per_page'] = $data['per_page'];
    $this->my_pagination->initialize($config);
    $data['pagination'] = $this->my_pagination->create_links();

    $path = 'patient/list';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }


  /**
   * Patient::index()
   */
  public function search($limit = 15, $page = 1, $reverse = 1)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('patients');
    // $this->patients->getwhere('patients', array('is_active' => 1), 0, 0);
    // $this->patients->is_active = 1;
    // $this->patients->like('patients.is_active', 1);
    $data['patients'] = $this->patients->get_active_patients(); // (int)$reverse
    // $data['patients'] = $this->patients->get(0, 0, 0); // (int)$reverse
    // echo "<pre>";
    // print_r($data['patients']);
    // exit;
    $data['title'] = 'Patient List';
    $data['navActiveId'] = 'navbarLiPatient';

    $data['page'] = (int)$page;
    $data['per_page'] = (int)$limit;
    $this->load->library('pagination');
    $this->load->library('my_pagination');
    $config['base_url'] = site_url('patient/index/' . $data['per_page']);
    $config['total_rows'] = count($data['patients']);
    $config['per_page'] = $data['per_page'];
    $this->my_pagination->initialize($config);
    $data['pagination'] = $this->my_pagination->create_links();

    $path = 'patient/list';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }


  /**
   * Patient::inactive()
   */
  public function waitingList($limit = 15, $page = 1, $reverse = 1)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('patients');
    // $this->patients->getwhere('patients', array('is_active' => 1), 0, 0);
    // $this->patients->is_active = 1;
    // $this->patients->like('patients.is_active', 1);
    // $data['patients'] = $this->patients->get_active_patients(); // (int)$reverse
    $data['patients'] = $this->patients->get_waiting_patients(); // (int)$reverse
    // $data['patients'] = $this->patients->get(0, 0, 0); // (int)$reverse
    // echo "<pre>";
    // print_r($data['patients']);
    // exit;
    $data['title'] = "Today's Waiting Patients List";
    $data['navActiveId'] = 'navbarLiPatient';

    $data['page'] = (int)$page;
    $data['per_page'] = (int)$limit;
    $this->load->library('pagination');
    $this->load->library('my_pagination');
    $config['base_url'] = site_url('patient/waitingList/' . $data['per_page']);
    $config['total_rows'] = count($data['patients']);
    $config['per_page'] = $data['per_page'];
    $this->my_pagination->initialize($config);
    $data['pagination'] = $this->my_pagination->create_links();

    $path = 'patient/inprogresslist';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  /**
   * Patient::inactive()
   */
  public function collectionListMonthly($limit = 15, $page = 1, $reverse = 1)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('patients');
    // $this->patients->getwhere('patients', array('is_active' => 1), 0, 0);
    // $this->patients->is_active = 1;
    // $this->patients->like('patients.is_active', 1);
    // $data['patients'] = $this->patients->get_active_patients(); // (int)$reverse
    $data['patients'] = $this->patients->get_monthly_collectionlist(); // (int)$reverse
    // $data['patients'] = $this->patients->get(0, 0, 0); // (int)$reverse
    // echo "<pre>";
    // print_r($data['patients']);
    // exit;
    $data['title'] = "Monthly Patientwise Collection List";
    $data['navActiveId'] = 'navbarLiPatient';

    $data['page'] = (int)$page;
    $data['per_page'] = (int)$limit;
    $this->load->library('pagination');
    $this->load->library('my_pagination');
    $config['base_url'] = site_url('patient/collectionListMonthly/' . $data['per_page']);
    $config['total_rows'] = count($data['patients']);
    $config['per_page'] = $data['per_page'];
    $this->my_pagination->initialize($config);
    $data['pagination'] = $this->my_pagination->create_links();

    $path = 'patient/collectionlist';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  /**
   * Patient::inactive()
   */
  public function collectionList($limit = 15, $page = 1, $reverse = 1)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    $session_type=($this->input->get('session') && $this->input->get('session')=='active')? 'active': 'all';
    // echo $session_type; exit;
     
    $this->load->model('patients');
    // $this->patients->getwhere('patients', array('is_active' => 1), 0, 0);
    // $this->patients->is_active = 1;
    // $this->patients->like('patients.is_active', 1);
    // $data['patients'] = $this->patients->get_active_patients(); // (int)$reverse
    $data['patients'] = $this->patients->get_todays_collectionlist($session_type); // (int)$reverse
    // $data['patients'] = $this->patients->get(0, 0, 0); // (int)$reverse
    // echo "<pre>";
    // print_r($data['patients']);
    // exit;
    $data['title'] = "Today's Patientwise Collection List";
    $data['navActiveId'] = 'navbarLiPatient';

    $data['page'] = (int)$page;
    $data['per_page'] = (int)$limit;
    $this->load->library('pagination');
    $this->load->library('my_pagination');
    $config['base_url'] = site_url('patient/collectionList/' . $data['per_page']);
    $config['total_rows'] = count($data['patients']);
    $config['per_page'] = $data['per_page'];
    $this->my_pagination->initialize($config);
    $data['pagination'] = $this->my_pagination->create_links();

    $path = 'patient/collectionlist';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  /**
   * Patient::inactive()
   */
  public function sessionlist($limit = 15, $page = 1, $reverse = 1)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('patients');
    // $this->patients->getwhere('patients', array('is_active' => 1), 0, 0);
    // $this->patients->is_active = 1;
    // $this->patients->like('patients.is_active', 1);
    // $data['patients'] = $this->patients->get_active_patients(); // (int)$reverse
    $data['patients'] = $this->patients->get_sessionwise_patients_report(); // (int)$reverse
    // $data['patients'] = $this->patients->get(0, 0, 0); // (int)$reverse
    // echo "<pre>";
    // print_r($data['patients']);
    // exit;
    $data['title'] = "Sessionwise Patients Reports";
    $data['navActiveId'] = 'navbarLiPatient';

    $data['page'] = (int)$page;
    $data['per_page'] = (int)$limit;
    $this->load->library('pagination');
    $this->load->library('my_pagination');
    $config['base_url'] = site_url('patient/sessionlist/' . $data['per_page']);
    $config['total_rows'] = count($data['patients']);
    $config['per_page'] = $data['per_page'];
    $this->my_pagination->initialize($config);
    $data['pagination'] = $this->my_pagination->create_links();

    $path = 'patient/sessionlist';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }
  /**
   * Patient::inactive()
   */
  public function treated($limit = 15, $page = 1, $reverse = 1)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('patients');
    // $this->patients->getwhere('patients', array('is_active' => 1), 0, 0);
    // $this->patients->is_active = 1;
    // $this->patients->like('patients.is_active', 1);
    // $data['patients'] = $this->patients->get_active_patients(); // (int)$reverse
    $data['patients'] = $this->patients->get_treated_patients(); // (int)$reverse
    // $data['patients'] = $this->patients->get(0, 0, 0); // (int)$reverse
    // echo "<pre>";
    // print_r($data['patients']);
    // exit;
    $data['title'] = "Today's Treatment Finished Patients List";
    $data['navActiveId'] = 'navbarLiPatient';

    $data['page'] = (int)$page;
    $data['per_page'] = (int)$limit;
    $this->load->library('pagination');
    $this->load->library('my_pagination');
    $config['base_url'] = site_url('patient/treated/' . $data['per_page']);
    $config['total_rows'] = count($data['patients']);
    $config['per_page'] = $data['per_page'];
    $this->my_pagination->initialize($config);
    $data['pagination'] = $this->my_pagination->create_links();

    $path = 'patient/inprogresslist';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  /**
   * Patient::inactive()
   */
  public function inprogress($limit = 15, $page = 1, $reverse = 1)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('patients');
    // $this->patients->getwhere('patients', array('is_active' => 1), 0, 0);
    // $this->patients->is_active = 1;
    // $this->patients->like('patients.is_active', 1);
    // $data['patients'] = $this->patients->get_active_patients(); // (int)$reverse
    $data['patients'] = $this->patients->get_inprogress_patients(); // (int)$reverse
    // $data['patients'] = $this->patients->get(0, 0, 0); // (int)$reverse
    // echo "<pre>";
    // print_r($data['patients']);
    // exit;
    $data['title'] = 'In Progress Patient List';
    $data['navActiveId'] = 'navbarLiPatient';

    $data['page'] = (int)$page;
    $data['per_page'] = (int)$limit;
    $this->load->library('pagination');
    $this->load->library('my_pagination');
    $config['base_url'] = site_url('patient/inprogress/' . $data['per_page']);
    $config['total_rows'] = count($data['patients']);
    $config['per_page'] = $data['per_page'];
    $this->my_pagination->initialize($config);
    $data['pagination'] = $this->my_pagination->create_links();

    $path = 'patient/inprogresslist';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }


  /**
   * Patient::inactive()
   */
  public function inactive($limit = 15, $page = 1, $reverse = 1)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('patients');
    // $this->patients->getwhere('patients', array('is_active' => 1), 0, 0);
    // $this->patients->is_active = 1;
    // $this->patients->like('patients.is_active', 1);
    // $data['patients'] = $this->patients->get_active_patients(); // (int)$reverse
    $data['patients'] = $this->patients->get_inactive_patients(); // (int)$reverse
    // $data['patients'] = $this->patients->get(0, 0, 0); // (int)$reverse
    // echo "<pre>";
    // print_r($data['patients']);
    // exit;
    $data['title'] = 'Deleted/Inactive Patient List';
    $data['navActiveId'] = 'navbarLiPatient';

    $data['page'] = (int)$page;
    $data['per_page'] = (int)$limit;
    $this->load->library('pagination');
    $this->load->library('my_pagination');
    $config['base_url'] = site_url('patient/inactive/' . $data['per_page']);
    $config['total_rows'] = count($data['patients']);
    $config['per_page'] = $data['per_page'];
    $this->my_pagination->initialize($config);
    $data['pagination'] = $this->my_pagination->create_links();

    $path = 'patient/inactivelist';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  public function test()
  {
    // echo now();
    //echo now();
    // echo date("Y-m-d H:i:s");
    //echo strtotime(date("Y-m-d H:i:s"));
  }

  /**
   * Patient::status()
   */
  public function status($patient_doctor_id = 0)
  {

    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    if (!($this->bitauth->has_role('doctor'))) {
      $this->_no_access();
      return;
    }

    $patient_doctor_id = $this->input->post('patient_doctor_id');
    if (empty($patient_doctor_id)) {
      $this->_no_doctor();
      return;
    }
    $this->load->model('patient_doctor');
    $patient_doctor_record = $this->patient_doctor->get_by_fkey('patient_doctor_id', $patient_doctor_id, 'desc', 0);
    if (empty($patient_doctor_record[$patient_doctor_id]->user_id)) {
      $this->_no_doctor();
      return;
    }

    $this->load->model('sessions');
    $current_session_id = $this->sessions->get_current_session_id();
    if ($current_session_id === 0) {
      $this->_no_session();
      return;
    }


    $this->load->model('patient_doctor');
    if ($this->input->post()) {


      $this->form_validation->set_rules(array(
        array('field' => 'patient_doctor_id', 'label' => 'Transaction ID', 'rules' => 'trim|is_numeric|has_no_schar',),
        array('field' => 'patient_id', 'label' => 'Patient ID', 'rules' => 'trim|is_numeric|has_no_schar',),
        array('field' => 'user_id', 'label' => 'Doctor ID', 'rules' => 'trim|is_numeric|has_no_schar',),
        array('field' => 'status', 'label' => 'Status Code', 'rules' => 'trim|is_numeric|has_no_schar',),
      ));
      if ($this->form_validation->run() == TRUE) {

        $submit = $this->input->post('submit');

        // appointment work
        if ($submit === 'Create Appointment') {
          //move old appointment
          $patient_doctor = $this->input->post(); // array
          $this->patient_doctor->load($patient_doctor['patient_doctor_id']);
          $existing = $this->patient_doctor; //

          $this->load->model('patient_doctor_history');
          $this->patient_doctor_history->patient_doctor_id = $existing->patient_doctor_id;
          $this->patient_doctor_history->patient_id = $existing->patient_id;
          $this->patient_doctor_history->user_id = $existing->user_id;
          $this->patient_doctor_history->fee = $existing->fee;
          $this->patient_doctor_history->visit_date = $existing->visit_date;
          $this->patient_doctor_history->status = $existing->status;
          $this->patient_doctor_history->session_id = $existing->session_id;
          $this->patient_doctor_history->token_no = $existing->token_no;
          $this->patient_doctor_history->save();

          // delete old 
          $this->patient_doctor->delete();

          //creae new appointment

          $this->load->model('patient_doctor');
          $this->load->model('patient_doctor');
          // $token_no = $this->patient_doctor->get_token_no($current_session_id);
          // if (count($token_no) === 0 || count($token_no) === 1) {
          //   $token_no = 1;
          // } else {
          //   $token_no = $token_no->count + 1;
          // }

          $this->patient_doctor->patient_id = $patient_doctor['patient_id'];
          $this->patient_doctor->user_id = $patient_doctor['user_id'];
          $this->patient_doctor->fee = $patient_doctor['fee'];
          $this->patient_doctor->status = 0;
          $this->patient_doctor->session_id = $current_session_id;
          //$this->patient_doctor->token_no = $token_no;
          $this->patient_doctor->visit_date = now();
          // echo "<pre>";
          // print_r($this->patient_doctor);
          // exit;
          $this->patient_doctor->save();


          $this->db->insert('session_patients', array(
            'patient_id' => $patient_doctor['patient_id'],
            'session_id' => $current_session_id,
            'created_at' => date('Y-m-d H:i:s')
          ));

          redirect($this->input->post('url'));
        } // end appointment work

        $patient_doctor = $this->input->post();

        $this->patient_doctor->load($patient_doctor['patient_doctor_id']);
        if ($this->patient_doctor->patient_id == $patient_doctor['patient_id'] && $submit !== 'Create Appointment') {
          // echo "hi " . $submit;
          $token_no = $this->patient_doctor->get_token_no($current_session_id);
          if (count($token_no) === 0) {
            $token_no = 1;
          } else {
            $token_no = $token_no->count;
          }

          $status_code = $patient_doctor['status'];
          $this->patient_doctor->user_id = $patient_doctor['user_id'];
          $this->patient_doctor->status = $status_code;
          $this->patient_doctor->session_id = $current_session_id;
          $this->patient_doctor->token_no = $token_no;

          if ($status_code == 2) $this->patient_doctor->visit_date = now();
          $this->patient_doctor->save();
          redirect($this->input->post('url'));
        }
      }
    }
  }

  /**
   * Patient::waiting()
   */
  public function waiting($doctor = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    if (!($this->bitauth->has_role('doctor')) || !($this->bitauth->has_role('receptionist'))) {
      $this->_no_access();
      return;
    }
    $this->load->model('patient_doctor');
    $this->load->model('patients');

    if (!$doctor && $this->bitauth->has_role('doctor', False)) //if doctor==0 and user is a doctor so only show his/her waiting list, admin will see all the list by parameter FALSE
      $doctor = $this->session->userdata('ba_user_id');

    //load doctor waiting list including generals not assigned to any doctor
    $list = $this->patient_doctor->get_waiting($doctor);
    // echo "<pre>";
    // print_r($list);
    // exit;

    $data['waitings'] = $list;
    $data['title'] = 'Waiting List';
    $data['navActiveId'] = 'navbarLiPatient';
    $path = 'patient/waiting';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }



  /*
   * Patient::register
   */
  public function register()
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('sessions');
    $current_session_id = $this->sessions->get_current_session_id();
    if ($current_session_id === 0) {
      $this->_no_session();
      return;
    }


    if (!($this->bitauth->has_role('receptionist'))) {
      $this->_no_access();
      return;
    }
    $data = array();

    if ($this->input->post()) {
      $this->form_validation->set_rules(array(
        array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|has_no_schar',),
        array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|has_no_schar',),
        array('field' => 'fname', 'label' => 'Father Name', 'rules' => 'trim|has_no_schar',),
        array('field' => 'gender', 'label' => 'Gender', 'rules' => 'required',),
        array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|valid_email',),
        array('field' => 'phone', 'label' => 'Phone', 'rules' => 'required|trim',),
        array('field' => 'address', 'label' => 'Address', 'rules' => 'trim',),
        array('field' => 'social_id', 'label' => 'Social ID', 'rules' => 'trim|has_no_schar',),
        array('field' => 'id_type', 'label' => 'ID Type', 'rules' => 'trim',),
        array('field' => 'doctor', 'label' => 'Doctor Name', 'rules' => 'required|trim|has_no_schar',),
        array('field' => 'memo', 'label' => 'Memo', 'rules' => '',),
        array('field' => 'age', 'label' => 'Date of Birth', 'rules' => 'required',),
        array('field' => 'card_no', 'label' => 'Card No', 'rules' => 'required',),
      ));

      if ($this->form_validation->run() == TRUE && check_session()) {
        $_doctor = $this->input->post('doctor');
        $_fee = $this->input->post('fee');
        $birth_date = $_POST['age']; // mktime(0, 0, 0, date('m'), date('d'), date('Y') - $_POST['age']); //convert age to birth_date
        unset($_POST['submit'], $_POST['doctor'], $_POST['age']); //delete extra post var

        //register patient
        $patient = $this->input->post();
        $patient['birth_date'] = $birth_date;
        $patient['create_date'] = now();
        // echo "<pre>";
        // print_r($patient);
        // exit;
        $this->load->model('patients');
        foreach ($patient as $key => $value) {
          $this->patients->$key = $value;
        }
        $this->patients->is_active = 1;
        $this->patients->save();

        //assign doctor
        $this->load->model('patient_doctor');
        $token_no = $this->patient_doctor->get_token_no($current_session_id);
        if (count($token_no) === 0) {
          $token_no = 1;
        } else {
          $token_no = $token_no->count + 1;
        }

        $this->patient_doctor->patient_id = $this->patients->patient_id;
        $this->patient_doctor->user_id = $_doctor;
        $this->patient_doctor->fee = $_fee;
        $this->patient_doctor->session_id = $current_session_id;
        $this->patient_doctor->token_no = $token_no;

        $this->patient_doctor->visit_date = now();
        $this->patient_doctor->save();

        $this->db->insert('session_patients', array(
          'patient_id' => $this->patients->patient_id,
          'session_id' => get_session(),
          'created_at' => date('Y-m-d H:i:s')
        ));

        //show patient info
        redirect('patient/ticket/' . $this->patients->patient_id); //show visit ticket to print
        //add financial info (fees)
      } else {
        $data['error'] = validation_errors('<div class="alert alert-danger">', '</div>');
        if (!check_session()) {
          $data['error'] = '<div class="alert alert-danger">Your session is not started yet. First start the session to register a patient</div>';
        }
      }
    }
    $data['title'] = 'Register Patient';
    $data['id_type_options'] = $this->_id_type_options();
    $data['doctor_list'] = $this->_doctor_list();
    $path = 'patient/add_patient';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  /**
   * ticket()
   * prints the initial bill for patient
   */
  public function ticket($patient_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('patients');
    $this->patients->load($patient_id);

    $this->load->model('patient_doctor');
    $this->patient_doctor->get_by_fkey('patient_id', $patient_id);
    $doc_info = $this->bitauth->get_user_by_id($this->patient_doctor->user_id);

    $data['title'] = 'Patient Ticket';
    $data['patient'] = $this->patients;
    $data['doctor'] = $this->patient_doctor;
    $data['doc_info'] = $doc_info;
    $path = 'account/users';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array('patient/ticket');
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  /*
   * Patient::panel
   * show details
   * tab for comments, drugs, xrays & tests
   * 
   */
  // patient_id => card_no
  public function panelDob($patient_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    // if (!is_int($patient_id)) {
    //   $patient_id = (int) filter_var($patient_id, FILTER_SANITIZE_NUMBER_INT);
    // }
    $this->load->model('patients');
    // echo $patient_id;
    // $originalDate = $patient_id;
    // $patient_id = date("Y-m-d", strtotime($originalDate));
    // echo $patient_id;

    $result = $this->patients->findByDob($patient_id);
    // echo "<pre>";
    // print_r($result);
    // exit;
    if (count($result) > 0) {
      $patient_id = $result[0]->patient_id;
    } else {
      $patient_id = 5345345;
    }
    $this->patients->load($patient_id);
    // print_r($this->patients);
    // exit;


    $this->load->model('patient_doctor');
    $this->patient_doctor->get_by_fkey('patient_id', $patient_id);
    $doc_info = $this->bitauth->get_user_by_id($this->patient_doctor->user_id);

    $this->load->model('examination');
    $examination = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $examination = $this->examination->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);


    $this->load->model('comments');
    $comments = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $comments = $this->comments->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);

    $this->load->model('drug_patient');
    $drugs = $this->drug_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('drugs');

    $this->load->model('xray_patient');
    $xrays = $this->xray_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('xrays');

    $this->load->model('lab_patient');
    $lab = $this->lab_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('lab');


    $pd_ids = array();
    $patient_doctor_history = $this->db->select("patient_doctor_id")->where('patient_id', $patient_id)->get('patient_doctor_history')->result();
    foreach ($patient_doctor_history as $pdh) $pd_ids[] = $pdh->patient_doctor_id;
    $patient_doctor = $this->db->select("patient_doctor_id")->where('patient_id', $patient_id)->get('patient_doctor')->result();
    foreach ($patient_doctor as $pd) $pd_ids[] = $pd->patient_doctor_id;

    $redalerts = 'unauthorized';
    if (count($pd_ids) > 0) {
      $examination = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('examination_id', 'desc')->get('examination')->result();
      $comments = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('comment_id', 'desc')->get('comments')->result();
      $redalerts = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('redalert_id', 'desc')->get('redalerts')->result();
    }

    $data['redalerts'] = $redalerts;


    $data['title'] = 'Patient Panel';
    $data['patient'] = $this->patients;
    $data['doctor'] = $this->patient_doctor;
    $data['doc_info'] = $doc_info;
    $data['comments'] = $comments;
    $data['examination'] = $examination;
    $data['drugs'] = $drugs;
    $data['xrays'] = $xrays;
    $data['lab'] = $lab;

    $path = 'patient/panel';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }


  /*
   * Patient::panel
   * show details
   * tab for comments, drugs, xrays & tests
   * 
   */
  // patient_id => card_no
  public function panelMobile($patient_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    if (!is_int($patient_id)) {
      $patient_id = (int) filter_var($patient_id, FILTER_SANITIZE_NUMBER_INT);
    }
    $this->load->model('patients');

    $result = $this->patients->findByMobile($patient_id);
    // echo "<pre>";
    // print_r($result);
    // exit;
    if (count($result) > 0) {
      $patient_id = $result[0]->patient_id;
    } else {
      $patient_id = 5345345;
    }
    $this->patients->load($patient_id);
    // print_r($this->patients);
    // exit;


    $this->load->model('patient_doctor');
    $this->patient_doctor->get_by_fkey('patient_id', $patient_id);
    $doc_info = $this->bitauth->get_user_by_id($this->patient_doctor->user_id);

    $this->load->model('examination');
    $examination = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $examination = $this->examination->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);


    $this->load->model('comments');
    $comments = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $comments = $this->comments->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);

    $this->load->model('drug_patient');
    $drugs = $this->drug_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('drugs');

    $this->load->model('xray_patient');
    $xrays = $this->xray_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('xrays');

    $this->load->model('lab_patient');
    $lab = $this->lab_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('lab');

    $pd_ids = array();
    $patient_doctor_history = $this->db->select("patient_doctor_id")->where('patient_id', $patient_id)->get('patient_doctor_history')->result();
    foreach ($patient_doctor_history as $pdh) $pd_ids[] = $pdh->patient_doctor_id;
    $patient_doctor = $this->db->select("patient_doctor_id")->where('patient_id', $patient_id)->get('patient_doctor')->result();
    foreach ($patient_doctor as $pd) $pd_ids[] = $pd->patient_doctor_id;

    $redalerts = 'unauthorized';
    if (count($pd_ids) > 0) {
      $examination = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('examination_id', 'desc')->get('examination')->result();
      $comments = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('comment_id', 'desc')->get('comments')->result();
      $redalerts = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('redalert_id', 'desc')->get('redalerts')->result();
    }

    $data['redalerts'] = $redalerts;

    $data['title'] = 'Patient Panel';
    $data['patient'] = $this->patients;
    $data['doctor'] = $this->patient_doctor;
    $data['doc_info'] = $doc_info;
    $data['comments'] = $comments;
    $data['examination'] = $examination;
    $data['drugs'] = $drugs;
    $data['xrays'] = $xrays;
    $data['lab'] = $lab;

    $path = 'patient/panel';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }
  /*
   * Patient::panel
   * show details
   * tab for comments, drugs, xrays & tests
   * 
   */
  // patient_id => card_no
  public function panelCard($patient_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    if (!is_int($patient_id)) {
      $patient_id = (int) filter_var($patient_id, FILTER_SANITIZE_NUMBER_INT);
    }
    $this->load->model('patients');
    $result = $this->patients->findByCardNo($patient_id);
    // echo "<pre>";
    // print_r($result);
    // exit;
    if (count($result) > 0) {
      $patient_id = $result[0]->patient_id;
    } else {
      $patient_id = 5345345;
    }
    $this->patients->load($patient_id);
    // print_r($this->patients);
    // exit;


    $this->load->model('patient_doctor');
    $this->patient_doctor->get_by_fkey('patient_id', $patient_id);
    $doc_info = $this->bitauth->get_user_by_id($this->patient_doctor->user_id);

    $this->load->model('comments');
    $comments = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $comments = $this->comments->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);

    $this->load->model('examination');
    $examination = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $examination = $this->examination->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);

    $this->load->model('drug_patient');
    $drugs = $this->drug_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('drugs');

    $this->load->model('xray_patient');
    $xrays = $this->xray_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('xrays');

    $this->load->model('lab_patient');
    $lab = $this->lab_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('lab');

    $pd_ids = array();
    $patient_doctor_history = $this->db->select("patient_doctor_id")->where('patient_id', $patient_id)->get('patient_doctor_history')->result();
    foreach ($patient_doctor_history as $pdh) $pd_ids[] = $pdh->patient_doctor_id;
    $patient_doctor = $this->db->select("patient_doctor_id")->where('patient_id', $patient_id)->get('patient_doctor')->result();
    foreach ($patient_doctor as $pd) $pd_ids[] = $pd->patient_doctor_id;

    $redalerts = 'unauthorized';
    if (count($pd_ids) > 0) {
      $examination = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('examination_id', 'desc')->get('examination')->result();
      $comments = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('comment_id', 'desc')->get('comments')->result();
      $redalerts = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('redalert_id', 'desc')->get('redalerts')->result();
    }

    $data['redalerts'] = $redalerts;

    $data['title'] = 'Patient Panel';
    $data['patient'] = $this->patients;
    $data['doctor'] = $this->patient_doctor;
    $data['doc_info'] = $doc_info;
    $data['comments'] = $comments;
    $data['examination'] = $examination;
    $data['drugs'] = $drugs;
    $data['xrays'] = $xrays;
    $data['lab'] = $lab;

    $path = 'patient/panel';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  public function clear($patient_id = 0){
    $this->db->where('patient_id', $patient_id);
    $data=array('status' => 1);
    $this->db->update('patient_doctor', $data);
    echo "1 Record cleared from waiting";
    exit;
  }


  /*
   * Patient::panel
   * show details
   * tab for comments, drugs, xrays & tests
   * 
   */
  // patient_id => card_no
  public function panel($patient_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    if (!is_int($patient_id)) {
      $patient_id = (int) filter_var($patient_id, FILTER_SANITIZE_NUMBER_INT);
    }
    $this->load->model('patients');
    $this->patients->load($patient_id);
    // print_r($this->patients);
    // exit;


    $this->load->model('patient_doctor');
    $this->patient_doctor->get_by_fkey('patient_id', $patient_id);
    $doc_info = $this->bitauth->get_user_by_id($this->patient_doctor->user_id);

    // $this->load->model('examination');
    // $examination = 'unauthorized';
    // if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
    //   $examination = $this->examination->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);

    //$this->load->model('comments');
    // $comments = '';
    // if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
    //   $comments = $this->comments->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);

    $pd_ids = array();
    $patient_doctor_history = $this->db->select("patient_doctor_id")->where('patient_id', $patient_id)->get('patient_doctor_history')->result();
    foreach ($patient_doctor_history as $pdh) $pd_ids[] = $pdh->patient_doctor_id;
    $patient_doctor = $this->db->select("patient_doctor_id")->where('patient_id', $patient_id)->get('patient_doctor')->result();
    foreach ($patient_doctor as $pd) $pd_ids[] = $pd->patient_doctor_id;

    $examination = 'unauthorized';
    $comments = 'unauthorized';
    $redalerts = 'unauthorized';
    if (count($pd_ids) > 0) {
      $examination = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('examination_id', 'desc')->get('examination')->result();
      $comments = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('comment_id', 'desc')->get('comments')->result();
      $redalerts = $this->db->where_in('patient_doctor_id', $pd_ids)->order_by('redalert_id', 'desc')->get('redalerts')->result();
    }




    $this->load->model('drug_patient');
    $drugs = $this->drug_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('drugs');

    $this->load->model('xray_patient');
    $xrays = $this->xray_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('xrays');

    $this->load->model('lab_patient');
    $lab = $this->lab_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('lab');


    $data['title'] = 'Patient Panel';
    $data['patient'] = $this->patients;
    $data['doctor'] = $this->patient_doctor;
    $data['doc_info'] = $doc_info;
    $data['comments'] = $comments;
    $data['redalerts'] = $redalerts;
    $data['examination'] = $examination;
    $data['drugs'] = $drugs;
    $data['xrays'] = $xrays;
    $data['lab'] = $lab;

    $path = 'patient/panel';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }


  /*
     * Patient::prescription
     * show details
     * tab for comments, drugs, xrays & tests
     *
     */
  public function print_prescription_pad2($patient_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    if (!is_int($patient_id)) {
      $patient_id = (int) filter_var($patient_id, FILTER_SANITIZE_NUMBER_INT);
    }
    $this->load->model('patients');
    $this->patients->load($patient_id);

    $this->load->model('patient_doctor');
    $this->patient_doctor->get_by_fkey('patient_id', $patient_id);
    $doc_info = $this->bitauth->get_user_by_id($this->patient_doctor->user_id);

    $this->load->model('comments');
    $comments = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $comments = $this->comments->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);

    $this->load->model('drug_patient');
    $drugs = $this->drug_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('drugs');

    $this->load->model('xray_patient');
    $xrays = $this->xray_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('xrays');

    $this->load->model('lab_patient');
    $lab = $this->lab_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('lab');

    $data['title'] = 'Patient Panel';
    $data['patient'] = $this->patients;
    $data['doctor'] = $this->patient_doctor;
    $data['doc_info'] = $doc_info;
    $data['comments'] = $comments;
    $data['drugs'] = $drugs;
    $data['xrays'] = $xrays;
    $data['lab'] = $lab;

    $path = 'patient/prescription_pad2';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      //$this->load->view('header', $data);
      $this->load->view('patient/prescription_pad2', $data);
      // $this->load->view('footer', $data);
    }
  }

  /*
     * Patient::prescription
     * show details
     * tab for comments, drugs, xrays & tests
     *
     */
  public function print_prescription_pad($patient_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    if (!is_int($patient_id)) {
      $patient_id = (int) filter_var($patient_id, FILTER_SANITIZE_NUMBER_INT);
    }
    $this->load->model('patients');
    $this->patients->load($patient_id);

    $this->load->model('patient_doctor');
    $this->patient_doctor->get_by_fkey('patient_id', $patient_id);
    $doc_info = $this->bitauth->get_user_by_id($this->patient_doctor->user_id);

    if (empty($this->patient_doctor->patient_doctor_id))    $this->patient_doctor->patient_doctor_id = 0;
    $this->load->model('examination');
    $examination = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $examination = $this->examination->getExaminationList($this->patient_doctor->patient_doctor_id);


    $this->load->model('comments');
    $comments = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $comments = $this->comments->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);


    $this->load->model('prescription_data');
    $prescription_data = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $prescription_data = $this->prescription_data->get_by_fkey('id', 1, 'desc', 0);


    $this->load->model('drug_patient');
    $drugs = $this->drug_patient->getLastDrugList($this->patient_doctor->patient_doctor_id);

    if (!empty($examination->weight)) {
      $weight = str_replace("KG", "", $examination->weight);
      $index = 0;
      foreach ($drugs as $value) {
        $value = $value;

        // final formula here
        if (!empty($drugs[$index]->dosage_mg) && !empty($drugs[$index]->dosage_ml) && !empty($drugs[$index]->dosage)) {
          $dosage_mg = $drugs[$index]->dosage_mg; // Drug Mg
          $dosage_ml = $drugs[$index]->dosage_ml; // Drug ML
          $dosage = $drugs[$index]->dosage; // dosage(mg)
          // 1. mg per ml formula : TESTED
          $dosage_mg_per_ml = (float)$dosage_mg / (float)$dosage_ml; // mg per ml
          // 2. dosage per kg formula : TESTED
          $dosage_mg_per_kg = (float)$dosage * (float)$weight; // dosage mg per kg
          // 3. recommended dosage mg
          $drugs[$index]->dosage = $dosage_mg_per_kg / $dosage_mg_per_ml;
        } else {
          $drugs[$index]->dosage = "";
        }
        $index++;
      }
    }

    // echo "<pre>";
    // print_r($drugs);
    // exit;

    //$drugs = $this->drug_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    // $this->load->model('drugs');

    $this->load->model('xray_patient');
    $xrays = $this->xray_patient->getLastXrayList($this->patient_doctor->patient_doctor_id);

    $this->load->model('lab_patient');
    $lab = $this->lab_patient->getLastLabList($this->patient_doctor->patient_doctor_id);
    // $this->load->model('lab');
    // echo "<pre>";
    // var_dump($doc_info);
    // exit;

    $data['title'] = 'Patient Panel';
    $data['patient'] = $this->patients;
    $data['doctor'] = $this->patient_doctor;
    $data['p_data'] = $prescription_data[1];
    $data['doc_info'] = $doc_info;
    $data['comments'] = $comments;
    $data['examination'] = $examination;
    $data['drugs'] = $drugs;
    $data['xrays'] = $xrays;
    $data['lab'] = $lab;

    $path = 'patient/prescription_pad';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      //$this->load->view('header', $data);
      $this->load->view('patient/prescription_pad', $data);
      // $this->load->view('footer', $data);
    }
  }


  /*
     * Patient::prescription
     * show details
     * tab for comments, drugs, xrays & tests
     *
     */
  public function print_prescription($patient_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    if (!is_int($patient_id)) {
      $patient_id = (int) filter_var($patient_id, FILTER_SANITIZE_NUMBER_INT);
    }
    $this->load->model('patients');
    $this->patients->load($patient_id);

    $this->load->model('patient_doctor');
    $this->patient_doctor->get_by_fkey('patient_id', $patient_id);
    $doc_info = $this->bitauth->get_user_by_id($this->patient_doctor->user_id);

    $this->load->model('comments');
    $comments = 'unauthorized';
    if ($this->patient_doctor->user_id == 0 || $this->session->userdata('ba_user_id') == $this->patient_doctor->user_id)
      $comments = $this->comments->get_by_fkey('patient_doctor_id', $this->patient_doctor->patient_doctor_id, 'desc', 0);

    $this->load->model('drug_patient');
    $drugs = $this->drug_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('drugs');

    $this->load->model('xray_patient');
    $xrays = $this->xray_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('xrays');

    $this->load->model('lab_patient');
    $lab = $this->lab_patient->get_by_fkey('patient_id', $this->patients->patient_id, 'asc', 0);
    $this->load->model('lab');

    $data['title'] = 'Patient Panel';
    $data['patient'] = $this->patients;
    $data['doctor'] = $this->patient_doctor;
    $data['doc_info'] = $doc_info;
    $data['comments'] = $comments;
    $data['drugs'] = $drugs;
    $data['xrays'] = $xrays;
    $data['lab'] = $lab;

    $path = 'patient/prescription';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }


  /*
   * Patient::delete_patient
   */
  public function delete_patient($patient_id = 0)
  {
    $this->load->model('patients');
    $this->patients->load($patient_id);
    $this->patients->is_active = 0;
    $this->patients->save();

    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    if (!($this->bitauth->has_role('receptionist'))) {
      $this->_no_access();
      return;
    }

    redirect('patient/index');
  }

  /*
   * Patient::edit_patient
   */
  public function edit_patient($patient_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    if (!($this->bitauth->has_role('receptionist'))) {
      $this->_no_access();
      return;
    }
    $this->load->model('patients');
    $this->patients->load($patient_id);

    $data = array();
    if ($this->input->post()) {
      $this->form_validation->set_rules(array(
        array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|has_no_schar',),
        array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|has_no_schar',),
        array('field' => 'fname', 'label' => 'Father Name', 'rules' => 'trim|has_no_schar',),
        array('field' => 'gender', 'label' => 'Gender', 'rules' => 'required',),
        array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|valid_email',),
        array('field' => 'phone', 'label' => 'Phone', 'rules' => 'required|trim',),
        array('field' => 'address', 'label' => 'Address', 'rules' => 'trim',),
        array('field' => 'social_id', 'label' => 'Social ID', 'rules' => 'trim|has_no_schar',),
        array('field' => 'id_type', 'label' => 'ID Type', 'rules' => 'required|trim',),
        array('field' => 'doctor', 'label' => 'Doctor', 'rules' => 'required|trim|has_no_schar',),
        array('field' => 'memo', 'label' => 'Memo', 'rules' => '',),
        array('field' => 'birth_date', 'label' => 'Birth Date', 'rules' => 'required',),
        array('field' => 'picture', 'label' => 'Picture', 'rules' => '',),
      ));

      if ($this->form_validation->run() == TRUE) {
        //check if patient form already loaded from this app -> should be checked with session
        $session_check = $this->session->userdata(current_url());
        $this->session->unset_userdata(current_url());
        // if ($session_check && $session_check[0] == $patient_id) {
        $doctor = $this->input->post('doctor');
        unset($_POST['doctor'], $_POST['submit']);
        //upload picture
        if ($_FILES['picture']['tmp_name']) //check if any picture is selected to upload
        {
          $path = 'uploads/patient/' . $patient_id . '/profile/';
          $config['upload_path'] = './' . $path;
          $config['file_name'] = 'p' . $patient_id . '_profile_picture';
          $config['overwrite'] = TRUE;
          $config['allowed_types'] = 'gif|jpg|jpeg|png';
          $config['max_size'] = '100';
          $config['max_width'] = '300';
          $config['max_height'] = '400';
          $this->load->library('upload', $config);

          if (!$this->upload->do_upload('picture')) {
            $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
          } else {
            $data['upload_data'] = $this->upload->data();
            $_POST['picture'] = $path . $data['upload_data']['file_name'];
            if (isset($this->patients->picture) && !($this->patients->picture == $_POST['picture'])) //delete picture if it is not overwritten
              unlink('./' . $this->patients->picture);
          }
        }
        //update patient
        $patient = $this->input->post();
        $originalDate = $patient['birth_date'];
        $patient['birth_date'] = date("Y-m-d", strtotime($originalDate));
        // echo "<pre>";
        // print_r($patient);
        // exit;
        foreach ($patient as $key => $value)
          $this->patients->$key = $value;
        // $this->patients->birth_date = strtotime($this->input->post('birth_date'));
        $this->patients->save();

        //update patient doctor
        $this->load->model('patient_doctor');
        $this->patient_doctor->load($session_check[1]);
        $this->patient_doctor->patient_id = $patient_id;
        $this->patient_doctor->user_id = $doctor;
        if (empty($this->patient_doctor->visit_date)) {
          $this->load->model('sessions');
          $current_session_id = $this->sessions->get_current_session_id();
          if ($current_session_id === 0) {
            $this->_no_session();
            return;
          }
          $this->db->insert('session_patients', array(
            'patient_id' => $patient_id,
            'session_id' => $current_session_id,
            'created_at' => date('Y-m-d H:i:s')
          ));
          $token_no = $this->patient_doctor->get_token_no($current_session_id);
          if (count($token_no) === 0) {
            $token_no = 1;
          } else {
            $token_no = $token_no->count + 1;
          }

          $this->patient_doctor->visit_date = now();
          $this->patient_doctor->session_id = $current_session_id;
          $this->patient_doctor->token_no = $token_no;

          $this->patient_doctor->fee = "400";
        }

        if ($this->patient_doctor->status == 1) $this->patient_doctor->status = 0;
        $this->patient_doctor->save();

        redirect('patient');
        // } else {
        //user may have sent the form to a url other than the original
        //   $data['error'] = '<div class="alert alert-danger">Form URL Error</div>';
        // }

      } else {
        $data['error'] = validation_errors();
      }
    }
    $this->load->model('patient_doctor');
    $this->patient_doctor->get_by_fkey('patient_id', $patient_id);
    $this->session->set_userdata(current_url(), array($patient_id, $this->patient_doctor->patient_doctor_id));

    $data['title'] = 'Edit Patient';
    $data['patient'] = $this->patients;
    $data['doctor'] = $this->patient_doctor->user_id;
    $data['doctor_list'] = $this->_doctor_list();
    $data['id_type_options'] = $this->_id_type_options();
    $path = 'patient/edit_patient';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  /**
   * _doctor_list()
   * returns a list of doctor to assign the patient to.
   */
  public function _doctor_list()
  {
    $doctors = $this->bitauth->get_users_by_role('doctor');
    $admins = $this->bitauth->get_users_by_role('admin');
    $doctor_list = array();
    $doctor_list[0] = 'Doctor Name';
    foreach ($admins as $_admin) {
      $doctor_list[$_admin->user_id] = $_admin->last_name . ', ' . $_admin->first_name;
    }
    foreach ($doctors as $_doctor) {
      $doctor_list[$_doctor->user_id] = $_doctor->last_name . ', ' . $_doctor->first_name;
    }

    // echo "<pre>";
    // print_r($doctor_list);
    // exit;
    return $doctor_list;
  }

  /**
   * _id_type_options()
   * returns the array of id_type
   */
  public function _id_type_options()
  {
    return array(
      'CNIC' => 'CNIC',
      'Passport' => 'Passport',
      'Driver License' => 'Driver License',
      'Bank ID Card' => 'Bank ID Card',
    );
  }

  /**
   * account::_no_session()
   *
   */
  public function _no_doctor()
  {
    $data['title'] = 'Doctor Not Assigned';
    $path = 'account/no_doctor';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  /**
   * account::_no_session()
   *
   */
  public function _no_session()
  {
    $data['title'] = 'Session Not Started';
    $path = 'account/no_session';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  /**
   * account::_no_access()
   *
   */
  public function _no_access()
  {
    $data['title'] = 'Unauthorized Access';
    $path = 'account/no_access';
    if (isset($_GET['ajax']) && $_GET['ajax'] == true) {
      $this->load->view($path, $data);
    } else {
      $data['includes'] = array($path);
      $this->load->view('header', $data);
      $this->load->view('index', $data);
      $this->load->view('footer', $data);
    }
  }

  // Auto Complete Patient List
  public function patientList()
  {
    $patient = $this->input->post('patient');

    $this->load->model('patients');
    $response = $this->patients->patientsList($patient);

    $output = '<ul class="list-unstyled autocomplete">';

    if (!empty($response)) {
      foreach ($response as $r) {
        $output .= '<li class="listing">' . $r->patient_id . ' - ' . $r->card_no . ' - ' . ucwords($r->name) . '</li>';
      }
    } else {
      $output .= '<li  class="listing"> Patient not Found</li>';
    }

    $output .= '</ul>';
    echo $output;
  }

  // Auto Complete Patient List by Card No
  public function patientsListByCardNo()
  {
    $patient = $this->input->post('cardNo');

    $this->load->model('patients');
    $response = $this->patients->patientsListByCardNo($patient);

    $output = '<ul class="list-unstyled autocomplete">';

    if (!empty($response)) {
      foreach ($response as $r) {
        $output .= '<li class="listing2" id="listing-' . $r->patient_id . '">' . $r->card_no . ' : ' . ucwords($r->name) . '</li>';
      }
    } else {
      $output .= '<li  class="listing2">Card not Found</li>';
    }

    $output .= '</ul>';
    echo $output;
  }
}

/* End of file patient.php */
/* Location: ./application/controllers/patient.php */