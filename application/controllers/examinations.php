<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Examinations extends CI_Controller
{

  /**
   * Comment::__construct()
   *
   */
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Karachi');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
  }

  /**
   * Comment::index()
   */
  public function index($patient_id = 0, $page = 1, $limit = 15)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    // $this->load->model('comments');
    //     
    // $data['comments'] = $this->comments->get_by_fkey('patient_id',$patient_id,$limit, ($page-1)*$limit);
    // $data['title'] = 'Comments List';
    // $data['navActiveId']='navbarLiPatient';
    // $data['includes']=array('comments/list');
    //     
    // $this->load->view('header',$data);
    // $this->load->view('index',$data);
    // $this->load->view('footer',$data);
  }

  /*
   * Comment::add()
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
    $this->load->model('examination');
    $this->load->model('patient_doctor');
    if ($this->input->post()) {
      $this->form_validation->set_rules(array(
        array('field' => 'patient_doctor_id', 'label' => 'Patient Doctor ID', 'rules' => 'required|has_no_schar',),
        // array('field' => 'ofc', 'label' => 'OFC', 'rules' => 'required|trim|has_no_schar',),
        // array('field' => 'weight', 'label' => 'weight', 'rules' => 'required|trim|has_no_schar',),
        // array('field' => 'height', 'label' => 'height', 'rules' => 'required|trim|has_no_schar',),
      ));
      if (
        $this->form_validation->run() == TRUE &&
        $this->input->post('patient_doctor_id') == $patient_doctor_id
      ) {
        $this->patient_doctor->load($patient_doctor_id);
        if ($this->patient_doctor->user_id != $this->session->userdata('ba_user_id'))
          return;
        $this->examination->patient_doctor_id = $this->input->post('patient_doctor_id');
        $ofc = $this->input->post('ofc') . "cm";
        $weight = $this->input->post('weight') . "KG";;
        $height = $this->input->post('height') . "cm";
        $temperature = $this->input->post('temperature') . "&#176;F";;
        $bp = $this->input->post('bp') . "mmHg";;
        $oxygen_sat = $this->input->post('oxygen_sat') . "(O2)";;
        $xrayr = $this->input->post('xrayr');
        $labr = $this->input->post('labr');


        // $comment = $comment . replace('/(?:\r\n|\r|\n)/g', '<br>');
        // $comment = str_replace('/(?:\r\n|\r|\n)/g', '<br>', $comment);
        // $comment = str_replace(array("\r", "\n"), '<br>', $comment);
        // $comment = str_replace("<br><br>", '<br>', $comment);

        $this->examination->ofc = $ofc; // $this->input->post('comment');
        $this->examination->height = $height; // $this->input->post('comment');
        $this->examination->weight = $weight; // $this->input->post('comment');

        $this->examination->temperature = $temperature; // $this->input->post('comment');
        $this->examination->bp = $bp; // $this->input->post('comment');
        $this->examination->oxygen_sat = $oxygen_sat; // $this->input->post('comment');
        $this->examination->xrayr = $xrayr; // $this->input->post('comment');
        $this->examination->labr = $labr; // $this->input->post('comment');

        $this->examination->create_date = now();
        $this->examination->last_edit_time = now();
        $this->examination->save();
        $this->examination->load($this->examination->examination_id);
        $data['examination'] = $this->examination;
        $this->load->view('patient/examination', $data);
      }
    }
  }

  /*
   * Comment::edit()
   * 
   */
  public function edit($comment_id = 0)
  {
    if (!$this->bitauth->logged_in()) {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    if (!$this->bitauth->has_role('doctor')) {
      return;
    }
    $this->load->model('comments');
    $this->load->model('patient_doctor');
    if ($this->input->post()) {
      $this->form_validation->set_rules(array(
        array('field' => 'comment_id', 'label' => 'Comment ID', 'rules' => 'required|is_numeric',),
        array('field' => 'patient_doctor_id', 'label' => 'Patient Doctor ID', 'rules' => 'required|is_numeric',),
        array('field' => 'comment', 'label' => 'Comment', 'rules' => 'trim|required|has_no_schar',),
      ));
      if (
        $this->form_validation->run() == TRUE &&
        $comment_id == $this->input->post('comment_id')
      ) {
        $this->comments->load($comment_id);
        $this->patient_doctor->load($this->comments->patient_doctor_id);
        if ($this->patient_doctor->user_id != $this->session->userdata('ba_user_id'))
          return;
        $this->comments->comment = $this->input->post('comment');
        $this->comments->last_edit_time = now();
        $this->comments->save();
        $data['comment'] = $this->comments;
        $this->load->view('patient/comment', $data);
      }
    }
  }
}

/* End of file patient.php */
/* Location: ./application/controllers/patient.php */