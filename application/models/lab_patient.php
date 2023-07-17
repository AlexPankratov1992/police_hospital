<?php

class Lab_patient extends My_Model
{

    const DB_TABLE = 'lab_patient';
    const DB_TABLE_PK = 'lab_patient_id';

    /**
     * Unique identifire.
     * @var int
     */
    public $lab_patient_id;

    /**
     * Forign key of lab table.
     * @var int
     */
    public $test_id;

    /**
     * Forign key of patients table.
     * @var int
     */
    public $patient_id;



    /**
     * Forign key of users table. Id number of employee who created this record.
     * @var int
     */
    public $user_id_assign;

    /**
     * Date of record creation.
     * @var datetime
     */
    public $assign_date;

    /**
     * Number of assigned item.
     * @var int
     */
    public $no_of_item;

    /*
     * Price of drug
     * @var decimal(10,0)
     */
    public $total_cost;

    /**
     * Forign key of users table. Id number of employee who discharge patient (get the money).
     * @var int
     */
    public $user_id_discharge;

    /**
     * Date of patient discharging.
     * @var datetime
     */
    public $discharge_date;

    /*
     * Memo and aditional description for this Item
     * @var string
     */
    public $memo;

    /**
     * Forign key of doctor_patient table. this will be used to identify the doctor.
     * @var int
     */
    public $patient_doctor_id;

    function getLastLabList($patient_doctor_id = 0)
    {
        // $query = $this->db->query("select l.test_name_en from lab_patient lp INNER JOIN lab l on lp.test_id=l.test_id where patient_id=" . $patient_id . " AND date(FROM_UNIXTIME(assign_date))=date(convert_tz(utc_timestamp(), '-05:00', '+00:00'))");
        $query = $this->db->query("select l.test_name_en from lab_patient lp INNER JOIN lab l on lp.test_id=l.test_id where patient_doctor_id=" . $patient_doctor_id);
        return $query->result();
        // if (count($result) > 0) {
        //     return $result[0];
        // } else {
        //     return null;
        // }
    }
}
