<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicine extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('medicine_model');
        if (!$this->ion_auth->in_group(array('admin', 'Pharmacist', 'Doctor'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
       // $data['medicines'] = $this->medicine_model->getMedicineByPageNumber($page_number);
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['suppliers'] = $this->medicine_model->getSuppliers();
        $data['locations'] = $this->settings_model->getLocations();
        $data['settings'] = $this->settings_model->getSettings();
        $data['pagee_number'] = $page_number;
        $data['p_n'] = '0';
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine', $data);
        $this->load->view('home/footer'); // just the header file
    }

     public function locationProducts() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
       // $data['medicines'] = $this->medicine_model->getMedicineByPageNumber($page_number);
        $data['medicines'] = $this->medicine_model->getLocationMedicine();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['suppliers'] = $this->medicine_model->getSuppliers();
        $data['locations'] = $this->settings_model->getLocations();
        $data['settings'] = $this->settings_model->getSettings();
        $data['pagee_number'] = $page_number;
        $data['p_n'] = '0';
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('location_products', $data);
        $this->load->view('home/footer'); // just the header file
    }

    

    public function medicineByPageNumber() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['medicines'] = $this->medicine_model->getMedicineByPageNumber($page_number);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['pagee_number'] = $page_number;
        $data['p_n'] = $page_number;
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function medicineStockAlert() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = '0';
        $data['medicines'] = $this->medicine_model->getMedicineByStockAlert($page_number);
      //  $data['medicines'] = $this->medicine_model->getMedicineByStockAlertByPageNumber($page_number);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['pagee_number'] = $page_number;
        $data['settings'] = $this->settings_model->getSettings();
        $data['alert'] = 'Alert Stock';
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine_stock_alert', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function medicineStockAlertByPageNumber() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $data['medicines'] = $this->medicine_model->getMedicineByStockAlert($page_number);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['pagee_number'] = $page_number;
        $data['alert'] = 'Alert Stock';
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine_stock_alert', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function searchMedicine() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $key = $this->input->get('key');
        $data['medicines'] = $this->medicine_model->getMedicineByKey($page_number, $key);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $data['pagee_number'] = $page_number;
        $data['key'] = $key;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function searchMedicineInAlertStock() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $key = $this->input->get('key');
        $data['medicines'] = $this->medicine_model->getMedicineByKeyByStockAlert($page_number, $key);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $data['pagee_number'] = $page_number;
        $data['key'] = $key;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine_stock_alert', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addMedicineView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['suppliers'] = $this->medicine_model->getSuppliers();
        $data['locations'] = $this->settings_model->getLocations();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_medicine_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

     public function transferMedicineView() {
        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['locmedicines'] = $this->medicine_model->getLocationMedicine();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['suppliers'] = $this->medicine_model->getSuppliers();
        $data['locations'] = $this->settings_model->getLocations();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_transfer_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

      public function quan() {

        $product_id = 2872;
        $from_location = 3;
        $previous_qty = $this->db->get_where('location_products', array('product_id' => $product_id, 'location_id' => $from_location))->row()->loc_quantity;

       var_dump($previous_qty);
    }


    public function addMedicineTransfer() {
       
        $product_id = $this->input->post('product_id');
        $from_location = $this->input->post('from_location');
        $to_location = $this->input->post('to_location');
        $trans_quantity = $this->input->post('trans_quantity');

         $avail = $this->input->post('avail');

         // var_dump($to_location); exit();

         if($avail < $trans_quantity){

            // echo "less than"; exit();

            $this->session->set_flashdata('feedback', 'Insufficient stock');

           redirect('medicine');

         }
    
        // if ((empty($id))) {
        //     $add_date = date('m/d/y');
        // } else {
        //     $add_date = $this->db->get_where('medicine', array('id' => $id))->row()->add_date;
        // }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Product Field
        $this->form_validation->set_rules('product_id', 'Product', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating From location Field
        $this->form_validation->set_rules('from_location', 'From', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating To location Field
        $this->form_validation->set_rules('to_location', 'To', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Quantity Field
        $this->form_validation->set_rules('trans_quantity', 'Quantity', 'trim|min_length[1]|max_length[100]|xss_clean');
        


        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['categories'] = $this->medicine_model->getMedicineCategory();
            $data['suppliers'] = $this->medicine_model->getSuppliers();
            $data['locations'] = $this->settings_model->getLocations();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_new_transfer_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(

                'product_id' => $product_id,
                'from_location' => $from_location,
                'to_location' => $to_location,
                'trans_quantity' => $trans_quantity
                
            );

            $this->medicine_model->insertTransfer($data);

$from_previous_qty = $this->db->get_where('location_products', array('product_id' => $product_id, 'location_id' => $from_location))->row()->loc_quantity;

$to_previous_qty = $this->db->get_where('location_products', array('product_id' => $product_id, 'location_id' => $to_location))->row()->loc_quantity;


            // $new_qty = $previous_qty + $qty;
            // $data = array();
            // $data = array('quantity' => $new_qty);
            // $this->medicine_model->updateMedicine($id, $data);

            if (empty($to_previous_qty)) {
               
             
                $from_new_qty = $from_previous_qty - $trans_quantity;
                $fromdata = array();
                $fromdata = array('loc_quantity' => $from_new_qty);

                $this->medicine_model->updateFromMedicineLocation($product_id, $from_location, $fromdata);

               $location_pro = array(

                'product_id' => $product_id,
                'loc_quantity' => $trans_quantity,
                'location_id' => $to_location
            );

               $this->medicine_model->insertLocationMedicine($location_pro);


                $this->session->set_flashdata('feedback', 'Added');
            } else {
                
                $from_new_qty = $from_previous_qty - $trans_quantity;
                $data = array();
                $data = array('loc_quantity' => $from_new_qty);

                $this->medicine_model->updateFromMedicineLocation($product_id, $from_location, $data);

                $to_new_qty = $to_previous_qty + $trans_quantity;
                $data1 = array();
                $data1 = array('loc_quantity' => $to_new_qty);

                $this->medicine_model->updateToMedicineLocation($product_id, $to_location, $data1);


                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('medicine');
        }
    }

     function getFromAvailableMedsByLocationJson() {
       
        // $location_id = $this->input->get('fromloc');
        $product_id = $this->input->get('proid');

        $data['availablemed'] = $this->medicine_model->getMedicineByLocationByProductId($product_id);
        echo json_encode($data);
    }

    function getToAvailableMedsByLocationJson() {
       
        $location_id = $this->input->get('fromloc');
        // $product_id = $this->input->get('proid');

        $data['toavailablemed'] = $this->medicine_model->getToMedicineByLocationByProductId($location_id);
        echo json_encode($data);
    }

    function getAvailableMedsQuantityByLocationByProductJson() {
       
        $location_id = $this->input->get('fromloc');
        $product_id = $this->input->get('proid');

        $availquantity =   $this->medicine_model->getMedicineQuantityByLocationByProductId($location_id, $product_id);

        $data['quantity'] = $availquantity->loc_quantity;
        echo json_encode($data);
    }




    //  function getAvailableMedsByLocationJson() {
       
    //     $location_id = $this->input->get('fromloc');
    //     $product_id = $this->input->get('proid');

    //     $data['availablemed'] = $this->medicine_model->getMedicineByLocationByProductId($location_id, $product_id);
    //     echo json_encode($data);
    // }


    public function addNewMedicine() {
        
        $id = $this->input->post('id');

        // var_dump($id); exit();
        $name = $this->input->post('name');
        $category = $this->input->post('category');
        $price = $this->input->post('price');
        $box = $this->input->post('box');
        $s_price = $this->input->post('s_price');
        $quantity = $this->input->post('quantity');
        $generic = $this->input->post('generic');
        $company = $this->input->post('company');
        $effects = $this->input->post('effects');
        $e_date = $this->input->post('e_date');

        $brand = $this->input->post('brand');
        $supplier = $this->input->post('supplier');
        $location = $this->input->post('location');

        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('medicine', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Purchase Price Field
        $this->form_validation->set_rules('price', 'Purchase Price', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Store Box Field
        $this->form_validation->set_rules('box', 'Store Box', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Selling Price Field
        $this->form_validation->set_rules('s_price', 'Selling Price', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Quantity Field
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('generic', 'Generic Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Company Name Field
        $this->form_validation->set_rules('company', 'Company', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Effects Field
        $this->form_validation->set_rules('effects', 'Effects', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Expire Date Field
        $this->form_validation->set_rules('e_date', 'Expire Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['categories'] = $this->medicine_model->getMedicineCategory();
            $data['suppliers'] = $this->medicine_model->getSuppliers();
            $data['locations'] = $this->settings_model->getLocations();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_new_medicine_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('name' => $name,
                'category' => $category,
                'price' => $price,
                'box' => $box,
                's_price' => $s_price,
                'quantity' => $quantity,
                'generic' => $generic,
                'company' => $company,
                'effects' => $effects,
                'add_date' => $add_date,
                'e_date' => $e_date,
                'brand' => $brand,
                'supplier' => $supplier,
                'location' => $location,
            );
            if (empty($id)) {
                $this->medicine_model->insertMedicine($data);

               $med = $this->medicine_model->getLastMedicine();

               $medid = $med->id;

               $location_pro = array(

                'product_id' => $medid,
                'loc_quantity' => $quantity,
                'location_id' => $location
            );

               $this->medicine_model->insertLocationMedicine($location_pro);


                $this->session->set_flashdata('feedback', 'Added');
            } else {

                // echo "not empty"; exit();


                $to_previous_qty = $this->db->get_where('location_products', array('product_id' => $id, 'location_id' => $location))->row()->loc_quantity;

                $to_new_qty = $to_previous_qty + $quantity;
                $data1 = array();
                $data1 = array('loc_quantity' => $to_new_qty);

                // var_dump($location); exit();

                $this->medicine_model->updateMedicine($id, $data);
                $this->medicine_model->updateToMedicineLocation($id, $location, $data1);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('medicine');
        }
    }



    function editMedicine() {
        $data = array();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['suppliers'] = $this->medicine_model->getSuppliers();
        $data['locations'] = $this->settings_model->getLocations();
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_medicine_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function load() {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $previous_qty = $this->db->get_where('medicine', array('id' => $id))->row()->quantity;
        $new_qty = $previous_qty + $qty;
        $data = array();
        $data = array('quantity' => $new_qty);
        $this->medicine_model->updateMedicine($id, $data);
        $this->session->set_flashdata('feedback', 'Medicine Loaded');
        redirect('medicine');
    }

    function editMedicineByJason() {
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineById($id);
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $this->medicine_model->deleteMedicine($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('medicine');
    }

    public function medicineCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category_view');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_new_category_view');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->medicine_model->insertMedicineCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->medicine_model->updateMedicineCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('medicine/medicineCategory');
        }
    }

    function edit_category() {
        $data = array();
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineCategoryById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editMedicineCategoryByJason() {
        $id = $this->input->get('id');
        $data['medicinecategory'] = $this->medicine_model->getMedicineCategoryById($id);
        echo json_encode($data);
    }

    function deleteMedicineCategory() {
        $id = $this->input->get('id');
        $this->medicine_model->deleteMedicineCategory($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('medicine/medicineCategory');
    }

}

/* End of file medicine.php */
/* Location: ./application/modules/medicine/controllers/medicine.php */
