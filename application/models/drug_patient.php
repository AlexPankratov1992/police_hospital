<?php

class Drug_patient extends My_Model
{

    const DB_TABLE = 'drug_patient';
    const DB_TABLE_PK = 'drug_patient_id';

    /**
     * Unique identifire.
     * @var int
     */
    public $drug_patient_id;

    /**
     * Forign key of drugs table.
     * @var int
     */
    public $drug_id;

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

    /**
     * Number of times.
     * @var int
     */
    public $times;

    /**
     * Number of slot.
     * @var int
     */
    public $slot;

    /**
     * OFC of Tablet.
     * @var int
     */
    public $ofc;

    /**
     * Weight of Tablet.
     * @var int
     */
    public $weight;
    /**
     * Height of Tablet.
     * @var int
     */
    public $height;


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
    public $type;
    public $dosage;
    public $dosage_mg;
    public $dosage_ml;



    /**
     * Forign key of doctor_patient table. this will be used to identify the doctor.
     * @var int
     */
    public $patient_doctor_id;

    /*
     * Memo and aditional description for this Item
     * @var string
     */
    public $memo;

    public function get_sold($drug_id = 0)
    {
        $where = "user_id_discharge IS NOT NULL";
        $this->db->where($where);
        if ($drug_id != 0) $this->db->where('drug_id', $drug_id);
        $query = $this->db->get($this::DB_TABLE);
        $ret_val = array();
        $class = get_class($this);
        foreach ($query->result() as $row) {
            $model = new $class;
            $model->populate($row);
            $ret_val[$row->{$this::DB_TABLE_PK}] = $model;
        }
        return $ret_val;
    }

    function getLastDrugList($patient_doctor_id = 0)
    {
        // $query = $this->db->query("select d.drug_name_en, dp.no_of_item, dp.times, dp.slot, dp.type from drug_patient dp INNER JOIN drugs d on dp.drug_id = d.drug_id where patient_id = " . $patient_id . "  AND date(FROM_UNIXTIME(assign_date)) = date(convert_tz(utc_timestamp(), '-05:00', '+00:00'))");
        $query = $this->db->query("select d.drug_name_en, dp.no_of_item, dp.times, dp.slot, dp.type, dp.dosage, dp.dosage_mg, dp.dosage_ml   from drug_patient dp INNER JOIN drugs d on dp.drug_id = d.drug_id where patient_doctor_id = " . $patient_doctor_id);
        return $query->result();
    }
}
