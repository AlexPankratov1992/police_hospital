<?php

class Examination extends MY_Model
{

    const DB_TABLE = 'examination';
    const DB_TABLE_PK = 'examination_id';

    /**
     * Table unique identifier.
     * @var int
     */
    public $examination_id;

    /**
     * Table forign key to patient_doctor.
     * @var int
     */
    public $patient_doctor_id;

    /*
     * OFC body
     * @var string
     */
    public $ofc;

    /*
     * height body
     * @var string
     */
    public $height;

    /*
     * weight body
     * @var string
     */
    public $weight;
    public $temperature;
    public $bp;
    public $oxygen_sat;
    public $xrayr;
    public $labr;


    /*
     * Type of comment. reserved for future use. defualt val is 1
     * @var small int
     */
    public $examination_type = 1;

    /*
     * date of creation of this row
     * @var (int)timestamp
     */
    public $create_date;

    /*
     * date of last edit
     * @var (int)timestamp
     */
    public $last_edit_time;

    function getExaminationList($patient_doctor_id = 0)
    {
        $query = $this->db->query("select * from examination where patient_doctor_id=" . $patient_doctor_id . " order by examination_id desc limit 1");
        $result = $query->result();
        if (count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }
}
