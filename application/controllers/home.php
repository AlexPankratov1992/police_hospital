<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/home
     *    - or -
     *        http://example.com/index.php/home/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/home/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    /**
     * this is the index of home page
     * this should load the main panel for user
     */
    public function index()
    {
        date_default_timezone_set('Asia/Karachi');

        //initialize and load header
        $data['title'] = 'Clinic Management System';
        $data['navActiveId'] = 'navbarLiHome';

        $data['includes'] = array('home/cp');

        date_default_timezone_set('Asia/Karachi');


        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer', $data);
    }


    /**
     * this is the index of home page
     * this should load the main panel for user
     */
    public function dashboard()
    {
        date_default_timezone_set('Asia/Karachi');

        //initialize and load header
        $data['title'] = 'Dashboard';
        $data['navActiveId'] = 'navbarLiHome';
        $this->load->model('patients');

        // all time total
        $data['total_patients'] = count($this->patients->get_active_patients());
        $data['total_sessions'] = count($this->patients->get_sessionwise_patients_report());

        // durationwise total
        $data['todays_patients_waiting'] = count($this->patients->get_waiting_patients()); // today's
        $data['todays_patients_inprogress'] = count($this->patients->get_inprogress_patients()); // today's
        $data['todays_patients_treated'] = count($this->patients->get_treated_patients()); // today's        
        $data['todays_collection'] = $this->patients->get_todays_collection()->total; // today's
        $data['todays_collection_active'] = $this->patients->get_todays_collection('active')->total; // today's

        $data['monthly_collection'] = $this->patients->get_monthly_collection()->total; // monthly

        $data['includes'] = array('home/dashboard');


        $this->load->view('header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('footer', $data);
    }

    public function fees_management()
    {
        $patient_doctor_id = $this->input->post('patient_doctor_id');
        $updatedFees = $this->input->post('updatedFees');
        $this->db->where('patient_doctor_id', $patient_doctor_id)->update('patient_doctor', array('fee' => $updatedFees));
        echo json_encode(['status' => true, 'message' => 'Charges Updated Successfully', 'id' => 2]);
    }

    public function session_management()
    {
        date_default_timezone_set('Asia/Karachi');

        $id = $this->input->post('id');
        $last_session = $this->db->limit(1)->order_by('id', 'desc')->get('sessions');
        if ($id == 1) {
            if ($last_session->num_rows() > 0) {
                $row = $last_session->row();
                if (!empty($row->end)) {
                    $this->db->insert('sessions', array('start' => date('Y-m-d H:i:s'), 'created_by' => $this->session->userdata('ba_user_id')));
                    echo json_encode(['status' => true, 'message' => 'Session Started Successfully', 'id' => 2]);
                } else {
                    echo json_encode(['status' => false, 'message' => 'End the Previous Session First', 'id' => 1]);
                }
            } else {
                $this->db->insert('sessions', array('start' => date('Y-m-d H:i:s'), 'created_by' => $this->session->userdata('ba_user_id')));
                echo json_encode(['status' => true, 'message' => 'Session Started Successfully', 'id' => 3]);
            }
        } elseif ($id == 2) {
            if ($last_session->num_rows() > 0) {
                $row = $last_session->row();
                if (empty($row->end)) {
                    $this->db->where('id', $row->id)->update('sessions', array('end' => date('Y-m-d H:i:s'), 'modified_by' => $this->session->userdata('ba_user_id')));
                    echo json_encode(['status' => true, 'message' => 'Session Ended Successfully', 'id' => 4]);
                } else {
                    echo json_encode(['status' => false, 'message' => 'Start the Session First', 'id' => 5]);
                }
            } else {
                echo json_encode(['status' => false, 'message' => 'Start the Session First', 'id' => 6]);
            }
        }
    }

    public function session_report()
    {
        date_default_timezone_set('Asia/Karachi');

        if (!$this->bitauth->logged_in()) {
            $this->session->set_userdata('redir', current_url());
            redirect('account/login');
        }

        $data['list'] = $this->db->select('patients.patient_id, patients.first_name, patients.last_name, sp.created_at as visit_date, sp.id as receipt_num, userdata.fees')
            ->from('session_patients as sp')
            ->join('patients', 'sp.patient_id = patients.patient_id')
            ->join('patient_doctor as pd', 'sp.patient_id = pd.patient_id')
            ->join('userdata', 'pd.user_id = userdata.user_id')
            ->where('pd.user_id', $this->session->userdata('ba_user_id'))
            ->get();
        $data['total'] = 0;

        //      echo "<pre>";
        //      var_dump($data['total_sum']);
        //      echo "</pre>";
        //      die;
        $data['title'] = 'Earning Report';
        $data['navActiveId'] = 'navbarLiPatient';


        $path = 'report/earning-report';
        $data['includes'] = array($path);
        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer', $data);
    }

    public function monthly_report()
    {
        if (!$this->bitauth->logged_in()) {
            $this->session->set_userdata('redir', current_url());
            redirect('account/login');
        }
        $data['list'] = $this->db->select('patients.patient_id, patients.first_name, patients.last_name, sp.created_at as visit_date, sp.id as receipt_num, userdata.fees')
            ->from('session_patients as sp')
            ->join('patients', 'sp.patient_id = patients.patient_id')
            ->join('patient_doctor as pd', 'sp.patient_id = pd.patient_id')
            ->join('userdata', 'pd.user_id = userdata.user_id')
            ->where('pd.user_id', $this->session->userdata('ba_user_id'));

        if ($_POST) {
            $month = $this->input->post('month');
            $data['month_post'] = $month;
            if ($month == 'current') {
            } else {
                $data['list'] = $data['list']->where('month(sp.created_at)', date('m'))->get();
            }
        } else {
            $data['list'] = $data['list']->where('month(sp.created_at)', date('m'))->get();
        }

        $data['total'] = 0;

        //      echo "<pre>";
        //      var_dump($data['total_sum']);
        //      echo "</pre>";
        //      die;
        $data['title'] = 'Monthly Report';
        $data['navActiveId'] = 'navbarLiPatient';


        $path = 'report/monthly-report';
        $data['includes'] = array($path);
        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer', $data);
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */