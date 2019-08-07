<?php

class PM_Model extends CI_Model
{
    public function __construct()
    {
    }

    public function check_special_field($tName, $fieldName, $value) {
        $this->db->select('*');
        $this->db->from($tName);
        $this->db->where('f_isdelete', '0');
        $this->db->where($fieldName, $value);

        return empty($this->db->get()->row()) ? FALSE : TRUE;
    }

    public function get_info($tName, $fNo, $sStr = "*", $isStructured = true) {
        $this->db->select($sStr);
        $this->db->from($tName);
        if ($isStructured) $this->db->where('f_isdelete', '0');
        $this->db->where('f_no', $fNo);
        return $this->db->get()->row();
    }

    public function get_info_with_where($tName, $wStr, $sStr = "*", $isStructured = true) {
        $this->db->select($sStr);
        $this->db->from($tName);
        if ($isStructured) $this->db->where('f_isdelete', '0');
        $this->db->where($wStr);
        return $this->db->get()->row();
    }

    public function get_list_from_nos($tName, $fNos, $sStr = '*', $wStr = '') {
        $fNoList = explode(',', $fNos);

        $this->db->select($sStr);
        $this->db->from($tName);
        $this->db->where_in('f_no', $fNoList);
        if (!empty($wStr)) $this->db->where($wStr);

        return $this->db->get()->result_array();
    }

    public function get_max_no($tName, $fName = 'f_no') {
        $this->db->select('MAX('.$fName.') as maxno');
        $this->db->from($tName);

        $row = $this->db->get()->row();
        return (isset($row)) ? $row->maxno : 0;
    }

    public function get_list($tName, $count = 0, $wStr = '', $orderitem = '', $orderby = '', $sStr = '*') {
        $this->db->select($sStr);
        $this->db->from($tName);
        if ($count > 0)
            $this->db->limit($count);
        if ($wStr)
            $this->db->where($wStr);

        if (!empty($orderitem)) {
            $this->db->order_by($orderitem, $orderby);
        }
        return $this->db->get()->result_array();
    }

    public function update_info($tName, $info) {
        $this->db->where('f_no', $info['f_no']);
        foreach ($info as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update($tName);
    }

    public function save_info($tName, $info, $isStructured = true) {
        $data = array();

        if ($isStructured) {
            $curtime = date('Y-m-d H:i:s');
            if (empty($info['f_regtime'])) $info['f_regtime'] = $curtime;
            $info['f_updatetime'] = $curtime;
        }

        foreach ($info as $key => $value) {
            $data[$key] = $value;
        }
        $this->db->insert($tName, $data);
        return $this->db->insert_id();
    }

    public function delete_info($tName, $fNos) {
        $fNoList = explode(',', $fNos);
        $this->db->where_in('f_no', $fNoList);
        $this->db->set('f_isdelete', '1');
        $this->db->update($tName);
    }

    public function delete_info_completely($tName, $fNos) {
        $fNoList = explode(',', $fNos);
        $this->db->where_in('f_no', $fNoList);
        $this->db->delete($tName);
    }

    public function delete_info_with_where($tName, $wStr) {
        $this->db->where($wStr);
        $this->db->set('f_isdelete', '1');
        $this->db->update($tName);
    }

    public function delete_info_with_where_completely($tName, $wStr) {
        $this->db->where($wStr);
        $this->db->delete($tName);
    }

}
