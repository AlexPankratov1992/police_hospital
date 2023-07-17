<?php

function check_session()
{
    $CI = &get_instance();

    $data = $CI->db->limit(1)->order_by('id', 'desc')->get('sessions');
    if ($data->num_rows() > 0) {
        $row = $data->row();
        if (!empty($row->end)) {
            return 0;
        } else {
            return 1;
        }
    } else {
        return 0;
    }
}

function get_session()
{
    $CI = &get_instance();
    $id = $CI->db->limit(1)->order_by('id', 'desc')->get('sessions')->row('id');
    return $id;
}

function current_session()
{
    $CI = &get_instance();
    $last_session = $CI->db->limit(1)->order_by('id', 'desc')->get('sessions');
    $session_status = 'style="color:red"';
    if ($last_session->num_rows() > 0) {
        $row = $last_session->row();
        if (empty($row->end)) {
            $session_status = 'style="color:#57e81f"';
        }
    }

    return $session_status;
}

function waiting_total()
{
    $CI = &get_instance();
    $CI->load->model('patients');
    $todays_patients_waiting = count($CI->patients->get_waiting_patients()); // today's
    return $todays_patients_waiting;
}

function inprogress_total()
{
    $CI = &get_instance();
    $CI->load->model('patients');
    $todays_patients_inprogress = count($CI->patients->get_inprogress_patients()); // today's
    return $todays_patients_inprogress;
}
