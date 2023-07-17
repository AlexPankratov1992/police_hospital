<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends MY_Model
{

    const DB_TABLE = 'patients';
    const DB_TABLE_PK = 'patient_id';

    /**
     * Unique identifire.
     * @var int
     */
    public $patient_id;

    /**
     * First name.
     * @var int
     */
    public $first_name;

    /**
     * Last name.
     * @var int
     */
    public $last_name;

    /**
     * Father name.
     * @var int
     */
    public $fname;

    /**
     * Father name.
     * @var int
     */
    public $gender;

    /**
     * Father name.
     * @var int
     */
    public $email;

    /**
     * Father name.
     * @var int
     */
    public $phone;

    /**
     * Father name.
     * @var int
     */
    public $address;

    /**
     * Father name.
     * @var int
     */
    public $social_id;

    /**
     * Father name.
     * @var int
     */
    public $id_type;

    /**
     * Father name.
     * @var int
     */
    public $birth_date;

    /**
     * Father name.
     * @var int
     */
    public $create_date;

    /**
     * Path of picture file.
     * @var string
     */
    public $picture;

    /**
     * Memo and aditional Info.
     * @var string
     */
    public $memo;

    /**
     * Soft Deleted/InActive Patients
     * @var int
     */
    public $is_active;
    /**
     * Soft Deleted/InActive Patients
     * @var int
     */
    public $card_no;

    function get_todays_collection($session_type='all')
    {
        // get today date 
        // $today = date("Y-m-d");
        if($session_type=='active'){
            $query = $this->db->query("select session_id,sum(a.fee) as total from (select patient_doctor_id, patient_id, user_id, visit_date, status, fee, session_id from patient_doctor union all select patient_doctor_id, patient_id, user_id, visit_date, status, fee, session_id from patient_doctor_history) a inner join patients b on a.patient_id=b.patient_id where date(FROM_UNIXTIME(a.visit_date)) = date(convert_tz(utc_timestamp(), '-05:00', '+00:00')) and session_id=(select max(id) from sessions)");
        }else {
            $query = $this->db->query("select sum(a.fee) as total from (select patient_doctor_id, patient_id, user_id, visit_date, status, fee from patient_doctor union all select patient_doctor_id, patient_id, user_id, visit_date, status, fee from patient_doctor_history) a inner join patients b on a.patient_id=b.patient_id where date(FROM_UNIXTIME(a.visit_date)) = date(convert_tz(utc_timestamp(), '-05:00', '+00:00'))");
        }
        return $query->result()[0];
    }

    function get_todays_collectionlist($session_type)
    {
        // get today date 
        // $today = date("Y-m-d");
        if($session_type=='active'){
            $query = $this->db->query("select a.session_id,FROM_UNIXTIME(a.visit_date) as visit_time, a.fee as actual_fee, b.* from (select patient_doctor_id, patient_id, user_id, visit_date, status, fee, session_id from patient_doctor union all select patient_doctor_id, patient_id, user_id, visit_date, status, fee, session_id  from patient_doctor_history) a inner join patients b on a.patient_id=b.patient_id where date(FROM_UNIXTIME(a.visit_date)) = date(convert_tz(utc_timestamp(), '-05:00', '+00:00')) and a.session_id=(SELECT max(id) as session_id FROM `sessions`)");
        }else {
            $query = $this->db->query("select FROM_UNIXTIME(a.visit_date) as visit_time, a.fee as actual_fee, b.* from (select patient_doctor_id, patient_id, user_id, visit_date, status, fee from patient_doctor union all select patient_doctor_id, patient_id, user_id, visit_date, status, fee  from patient_doctor_history) a inner join patients b on a.patient_id=b.patient_id where date(FROM_UNIXTIME(a.visit_date)) = date(convert_tz(utc_timestamp(), '-05:00', '+00:00'))");
        }

        return $query->result();
    }

    // monthly collection
    function get_monthly_collection()
    {
        // get today date 
        // $today = date("Y-m-d");
        $query = $this->db->query("select sum(a.fee) as total from (select patient_doctor_id, patient_id, user_id, visit_date, status, fee from patient_doctor union all select patient_doctor_id, patient_id, user_id, visit_date, status, fee from patient_doctor_history) a inner join patients b on a.patient_id=b.patient_id where year(date(FROM_UNIXTIME(a.visit_date))) = year(date(convert_tz(utc_timestamp(), '-05:00', '+00:00'))) and month(date(FROM_UNIXTIME(a.visit_date))) = month(date(convert_tz(utc_timestamp(), '-05:00', '+00:00')))");
        return $query->result()[0];
    }

    function get_monthly_collectionlist()
    {
        // get today date 
        // $today = date("Y-m-d");
        $query = $this->db->query("select FROM_UNIXTIME(a.visit_date) as visit_time, a.fee as actual_fee, b.* from (select patient_doctor_id, patient_id, user_id, visit_date, status, fee from patient_doctor union all select patient_doctor_id, patient_id, user_id, visit_date, status, fee  from patient_doctor_history) a inner join patients b on a.patient_id=b.patient_id where year(date(FROM_UNIXTIME(a.visit_date))) = year(date(convert_tz(utc_timestamp(), '-05:00', '+00:00'))) and month(date(FROM_UNIXTIME(a.visit_date))) = month(date(convert_tz(utc_timestamp(), '-05:00', '+00:00')))");
        return $query->result();
    }


    function get_treated_patients()
    {
        // get today date 
        // $today = date("Y-m-d");
        $query = $this->db->query("select * from patients p where p.patient_id in (select a.patient_id from patient_doctor a where date(FROM_UNIXTIME(a.visit_date)) = date(convert_tz(utc_timestamp(), '-05:00', '+00:00')) and a.status=1)");
        return $query->result();
    }

    function get_inprogress_patients()
    {
        $query = $this->db->query("SELECT p.*,pd.token_no from patients p INNER JOIN (select pd.patient_id, pd.token_no from patient_doctor pd where status=2) AS pd ON p.patient_id=pd.patient_id");
        return $query->result();
    }

    function get_waiting_patients()
    {
        $query = $this->db->query("select * from patients p where p.patient_id in (select a.patient_id from patient_doctor a where date(FROM_UNIXTIME(a.visit_date)) = date(convert_tz(utc_timestamp(), '-05:00', '+00:00')) and a.status=0)");
        return $query->result();
    }

    function search_patients($card_no, $name, $father_name, $mobile_no, $address, $date_of_birth, $gender, $sort_by, $sort_type)
    {
        $this->db->where('is_active', 1);
        if (!empty($card_no)) $this->db->like('card_no', $card_no);
        if (!empty($name)) $this->db->like("concat(first_name,' ',last_name)", $name);
        if (!empty($father_name)) $this->db->like('fname', $father_name);
        if (!empty($mobile_no)) $this->db->like('phone', $mobile_no);
        if (!empty($address)) $this->db->like('address', $address);
        if (!empty($date_of_birth)) $this->db->like('birth_date', $date_of_birth);
        if ($gender !== '') $this->db->where('gender', $gender);


        if ($sort_by === "name") {
            $this->db->order_by("first_name", $sort_type);
        }
        if ($sort_by === "create_date") {
            $this->db->order_by("DATE(FROM_UNIXTIME(`create_date`))", $sort_type);
        } else {
            if (!empty($sort_by))  $this->db->order_by($sort_by, $sort_type);
        }
        $query = $this->db->get('patients');
        $result = $query->result();

        // echo $this->db->last_query();
        // exit;
        return $result;
    }


    function get_active_patients()
    {
        $this->db->where('is_active', 1);
        $this->db->order_by("DATE(FROM_UNIXTIME(`create_date`))", "DESC");
        $query = $this->db->get('patients');
        return $query->result();
    }

    function get_inactive_patients()
    {
        $this->db->where('is_active', 0);
        $query = $this->db->get('patients');
        return $query->result();
    }

    function load_active($id)
    {
        $this->db->where('is_active', 1);
        $this->db->where('patient_id', $id);
        $query = $this->db->get('patients');
        $result = $query->result();
        // echo "<pre>";
        // print_r($result->patient_id);
        // exit;
        return $result;
    }

    public function findByCardNo($card_no)
    {
        // $this->db->where('is_active', 1);
        $this->db->where('card_no', $card_no);
        $query = $this->db->get('patients');
        return $query->result();
    }

    public function findByMobile($mobile_no)
    {
        // $this->db->where('is_active', 1);
        $this->db->where('phone', $mobile_no);
        $query = $this->db->get('patients');
        return $query->result();
    }

    public function findByDob($dob)
    {
        // $this->db->where('is_active', 1);
        $this->db->where('birth_date', $dob);
        $query = $this->db->get('patients');
        return $query->result();
    }

    public function patientsList($term)
    {
        $this->db->select('card_no,patient_id, name');
        $this->db->from('patient_lists');
        return $this->db->like('name', $term)->get()->result();
    }

    public function patientsListByCardNo($term)
    {
        $this->db->select('card_no,patient_id,name');
        $this->db->from('patient_lists');
        return $this->db->like('card_no', $term)->get()->result();
    }

    public function get_sessionwise_patients_report()
    {
        $query = $this->db->query("select date(s.start) as start_date, s.id, s.start, COALESCE(end, 'Running') as end , count(*) as session_patients from sessions s inner join session_patients sp on s.id=sp.session_id group by s.id order by s.id desc");
        return $query->result();
    }
}
