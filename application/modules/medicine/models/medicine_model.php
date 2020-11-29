<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicine_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertMedicine($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('medicine', $data2);
    }

     function insertTransfer($data) {
         $this->db->insert('transfers', $data);
    }

     function insertLocationMedicine($location_pro) {
       
        $this->db->insert('location_products', $location_pro);
    }

    function getMedicine() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getLocationMedicine() {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->from('location_products')
                          ->join('medicine', 'location_products.product_id = medicine.id')
                          ->order_by('location_products.id', 'asc')
                          ->get();
        // $query = $this->db->get('medicine');
        return $query->result();
    }

    function getLatestMedicine() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getLastMedicine() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('medicine');
        return $query->row();
    }

    function getMedicineByPageNumber($page_number) {
        $data_range_1 = 50 * $page_number;
        $this->db->order_by('id', 'asc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineByStockAlert() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('quantity <=', 20);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getMedicineByStockAlertByPageNumber($page_number) {
        $data_range_1 = 50 * $page_number;
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('quantity <=', 20);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medicine');
        return $query->row();
    }

    function getMedicineByLocationByProductId($product_id) {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        // $this->db->where('location_id', $location_id);
         $query = $this->db->from('location_products')
                          ->join('locations', 'location_products.location_id = locations.id')
                          ->where('product_id', $product_id)
                          ->order_by('location_id', 'asc')
                          ->get();
        return $query->result();
    }


    function getToMedicineByLocationByProductId($location_id) {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
       $query = $this->db->from('location_products')
                          ->join('locations', 'location_products.location_id = locations.id')
                          // ->where('product_id', $product_id)
                          ->where('location_id !=', $location_id)
                          ->order_by('location_id', 'asc')
                           ->get();
        return $query->result();
    }


    function getMedicineQuantityByLocationByProductId($location_id, $product_id) {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('location_id', $location_id);
        $this->db->where('product_id', $product_id);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('location_products');
        return $query->row();
    }

     function getMedicineQuantityByProductId($product_id) {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->select_sum('loc_quantity');
        $this->db->where('product_id', $product_id);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('location_products');
        return $query->row();
    }


    function getMedicineByKeyByStockAlert($page_number, $key) {
        $data_range_1 = 50 * $page_number;
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('quantity <=', 20);
        $this->db->or_like('name', $key);
        $this->db->or_like('company', $key);



        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineByKey($page_number, $key) {
        $data_range_1 = 50 * $page_number;
        $this->db->like('name', $key);
        $this->db->or_like('company', $key);
        $this->db->order_by('id', 'asc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineByKeyForPos($key) {
        $this->db->like('name', $key);
        $this->db->order_by('id', 'asc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function updateMedicine($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medicine', $data);
    }

     function updateFromMedicineLocation($product_id, $from_location, $data) {
        $this->db->where('product_id', $product_id);
        $this->db->where('location_id', $from_location);
        $this->db->update('location_products', $data);
    }

    function updateToMedicineLocation($id, $to_location, $data1) {
        $this->db->where('product_id', $id);
        $this->db->where('location_id', $to_location);
        $this->db->update('location_products', $data1);
    }

    function insertMedicineCategory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('medicine_category', $data2);
    }

    function getMedicineCategory() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('medicine_category');
        return $query->result();
    }

    function getMedicineCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medicine_category');
        return $query->row();
    }

    function totalStockPrice() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('medicine')->result();
        $stock_price = array();
        foreach ($query as $medicine) {
            $stock_price[] = $medicine->price * $medicine->quantity;
        }

        if (!empty($stock_price)) {
            return array_sum($stock_price);
        } else {
            return 0;
        }
    }

    function updateMedicineCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medicine_category', $data);
    }

    function deleteMedicine($id) {
        $this->db->where('id', $id);
        $this->db->delete('medicine');
        $this->db->where('product_id', $id)->delete('location_products');
    }

     function getSuppliers() {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('supplier');
        return $query->result();
    }

    function deleteMedicineCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('medicine_category');
    }

}
