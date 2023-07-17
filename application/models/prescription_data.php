<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class prescription_data extends MY_Model
{

    const DB_TABLE = 'prescription_data';
    const DB_TABLE_PK = 'id';

    /**
     * Unique identifire.
     * @var int
     */
    public $id;

    /**
     * .
     * @var string
     */
    public $col_1_row_1;

    /**
     * .
     * @var string
     */
    public $col_1_row_2;

    /**
     * .
     * @var string
     */
    public $col_1_row_3;

    /**
     * .
     * @var string
     */
    public $col_2_image;

    /**
     * .
     * @var string
     */
    public $col_3_row_1;

    /**
     * .
     * @var string
     */
    public $col_3_row_2;

    /**
     * .
     * @var string
     */
    public $col_3_row_3;

    /**
     * .
     * @var string
     */
    public $col_3_row_4;

    /**
     * .
     * @var string
     */
    public $col_3_row_5;

    /**
     * .
     * @var string
     */
    public $col_3_row_6;

    public function upddata($data)
    {
        // extract($data);
        $this->db->where('id', 1);
        $this->db->update('prescription_data', $data);
        return true;
    }
}
