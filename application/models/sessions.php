<?php

class Sessions extends MY_Model
{

    const DB_TABLE = 'sessions';
    const DB_TABLE_PK = 'id';

    /**
     * Table unique identifier.
     * @var int
     */
    public $id;

    /**
     * Session Start Time
     * @var timestamp
     */
    public $start;

    /**
     * Session End Time
     * @var timestamp
     */
    public $end;

    /*
     * Created By
     * @var int
     */
    public $created_by;

    /*
     * Updated By
     * @var int
     */
    public $modified_by;

    public function get_current_session_id()
    {
        $last_session = $this->db->limit(1)->order_by('id', 'desc')->get('sessions');
        $session_status = 0;
        if ($last_session->num_rows() > 0) {
            $row = $last_session->row();
            if (empty($row->end)) {
                $session_status = $row->id;
            }
        }
        return $session_status;
    }
}
