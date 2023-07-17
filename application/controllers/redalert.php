<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Redalert extends CI_Controller
{

  /**
   * Redalert::__construct()
   *
   */
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Karachi');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
  }

  /**
   * Redalert::index()
   */
  public function index($patient_id = 0, $page = 1, $limit = 15)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
  }

  /*
   * Redalert::delete()
   * 
   */
  public function delete()
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    if (!$this->bitauth->has_role('doctor')) {
      return;
    }
    $this->load->model('redalerts');
    $this->redalerts->load($this->input->post('redalert_id'));
    $this->redalerts->delete();
    echo json_encode([
      "status" => "success",
      "message" => "Red Alert Deleted Successfully."
    ]);
  }
  /*
   * Redalert::add()
   * 
   */
  public function add($patient_doctor_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    if (!$this->bitauth->has_role('doctor')) {
      return;
    }
    $this->load->model('redalerts');
    $this->load->model('patient_doctor');
    if ($this->input->post()) {
      $this->form_validation->set_rules(array(
        array('field' => 'patient_doctor_id', 'label' => 'Patient Doctor ID', 'rules' => 'required|has_no_schar',),
        array('field' => 'redalert', 'label' => 'Red Alert', 'rules' => 'required|trim|has_no_schar',),
      ));
      if (
        $this->form_validation->run() == TRUE &&
        $this->input->post('patient_doctor_id') == $patient_doctor_id
      ) {

        $this->patient_doctor->load($patient_doctor_id);
        if ($this->patient_doctor->user_id != $this->session->userdata('ba_user_id'))
          return;
        $this->redalerts->patient_doctor_id = $this->input->post('patient_doctor_id');
        $redalert = $this->input->post('redalert');
        $redalert = str_replace(array("\r", "\n"), '<br>', $redalert);
        $redalert = str_replace("<br><br>", '<br>', $redalert);

        $this->redalerts->redalert = $redalert;
        $this->redalerts->create_date = now();
        $this->redalerts->last_edit_time = now();
        $this->redalerts->save();
        $this->redalerts->load($this->redalerts->redalert_id);
        $data['redalert'] = $this->redalerts;
        // echo "working..........";
        // exit;

        $this->load->view('patient/redalert', $data);
      }
    }
  }

  /*
   * Redalert::edit()
   * 
   */
  public function edit($redalert_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    if (!$this->bitauth->has_role('doctor')) {
      return;
    }
    $this->load->model('redalerts');
    $this->load->model('patient_doctor');
    if ($this->input->post()) {
      $this->form_validation->set_rules(array(
        array('field' => 'redalert_id', 'label' => 'Red Alert ID', 'rules' => 'required|is_numeric',),
        array('field' => 'patient_doctor_id', 'label' => 'Patient Doctor ID', 'rules' => 'required|is_numeric',),
        array('field' => 'redalert', 'label' => 'Red Alert', 'rules' => 'trim|required|has_no_schar',),
      ));
      if (
        $this->form_validation->run() == TRUE &&
        $redalert_id == $this->input->post('redalert_id')
      ) {
        $this->redalerts->load($redalert_id);
        $this->patient_doctor->load($this->redalerts->patient_doctor_id);
        if ($this->patient_doctor->user_id != $this->session->userdata('ba_user_id'))
          return;
        $this->redalerts->redalert = $this->input->post('redalert');
        $this->redalerts->last_edit_time = now();
        $this->redalerts->save();
        $data['redalert'] = $this->redalerts;
        $this->load->view('patient/redalert', $data);
      }
    }
  }
}

/* End of file patient.php */
/* Location: ./application/controllers/patient.php */