<?php

class Redalerts extends MY_Model
{

    const DB_TABLE = 'redalerts';
    const DB_TABLE_PK = 'redalert_id';

    /**
     * Table unique identifier.
     * @var int
     */
    public $redalert_id;

    /**
     * Table forign key to patient_doctor.
     * @var int
     */
    public $patient_doctor_id;

    /*
     * Red Alert body
     * @var string
     */
    public $redalert;

    /*
     * Type of red alert. reserved for future use. defualt val is 1
     * @var small int
     */
    public $redalert_type = 1;

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

    function getRedAlertsByPatientsId($patientId)
    {
        $query = $this->db->query("select * from redalerts where patient_doctor_id in (select patient_doctor_id from patient_doctor_history where patient_id=$patientId)");
        return $query->result();
    }
}
