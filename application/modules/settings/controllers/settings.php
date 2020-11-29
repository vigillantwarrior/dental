<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('sma');
        $this->load->model('supplier_model');
        if (!$this->ion_auth->in_group(array('admin', 'superadmin'))) {
            redirect('home/permission');
        }
    }

    public function index() {        
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
    }

       

    function subscription() {

        $data['settings'] = $this->settings_model->getSettings();
        $data['subscription'] = $this->settings_model->getSubscription();

        //$bc = array(array('link' => site_url('settings'), 'page' => lang('settings')), array('link' => '#', 'page' => lang('backups')));
        //$meta = array('page_title' => lang('backups'), 'bc' => $bc);
        // $this->page_construct('settings/backups', $this->data, $meta);
        $this->load->view('home/dashboard', $data);
        $this->load->view('subscription', $data);
        $this->load->view('home/footer');
    }


    public function update() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $title = $this->input->post('title');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $currency = $this->input->post('currency');
        $logo = $this->input->post('img_url');
        $buyer = $this->input->post('buyer');
        $p_code = $this->input->post('p_code');

        // var_dump($logo); exit();

        if (!empty($email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            // Validating Name Field
            $this->form_validation->set_rules('name', 'System Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Title Field
            $this->form_validation->set_rules('title', 'Title', 'rtrim|equired|min_length[1]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Address Field   
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('currency', 'Currency', 'trim|required|min_length[1]|max_length[3]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('img_url', 'Logo', 'trim|min_length[1]|max_length[1000]|xss_clean');
            // Validating Department Field   
            $this->form_validation->set_rules('buyer', 'Buyer', 'trim|min_length[5]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('p_code', 'Purchase Code', 'trim|min_length[5]|max_length[50]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('settings', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {

                $file_name = $_FILES['img_url']['name'];

                // var_dump($file_name); exit();
                $file_name_pieces = explode('_', $file_name);
                $new_file_name = '';
                $count = 1;
                foreach ($file_name_pieces as $piece) {
                    if ($count !== 1) {
                        $piece = ucfirst($piece);
                    }

                    $new_file_name .= $piece;
                    $count++;
                }
                $config = array(
                    'file_name' => $new_file_name,
                    'upload_path' => "./uploads/",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => False,
                    'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "1768",
                    'max_width' => "2024"
                );

                $this->load->library('Upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('img_url')) {
                    $path = $this->upload->data();
                    $img_url = "uploads/" . $path['file_name'];
                    $data = array();
                    $data = array(
                        'system_vendor' => $name,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'codec_username' => $buyer,
                        'codec_purchase_code' => $p_code,
                        'logo' => $img_url
                    );

                    // var_dump($data); exit('we good!');
                } else {
                    $data = array();
                    $data = array(
                        'system_vendor' => $name,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'codec_username' => $buyer,
                        'codec_purchase_code' => $p_code,
                    );
                     // var_dump($data); exit('here');
                }
                //$error = array('error' => $this->upload->display_errors());

                $this->settings_model->updateSettings($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                // Loading View
                redirect('settings');
            }
        } else {
            $this->session->set_flashdata('feedback', 'Email Required!');
            redirect('settings', 'refresh');
        }
    }

    public function locations() {        
        $data = array();
        $data['settings'] = $this->settings_model->getLocations();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('locations', $data);
        $this->load->view('home/footer'); // just the footer file
    }

     public function add_location_view() {        
        $data = array();
        $data['settings'] = $this->settings_model->getLocations();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_location', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function add_location() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {

            // exit();
            $data = array();
            $data['settings'] = $this->settings_model->getLocations();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('settings/locations', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'name' => $name,
                'description' => $description
            );

            if (!empty($id)) {
                $this->settings_model->updateLocation($id, $data);

            } else {

            $this->settings_model->insertLocation($data);
            }

            // Loading View
            $this->session->set_flashdata('feedback', 'Updated');
            if (!empty($name)) {
                redirect('settings/locations');
            } else {
                redirect('');
            }
        }
    }

      function editLocationByJason() {
        $id = $this->input->get('id');
        $data['location'] = $this->settings_model->getLocationById($id);
        echo json_encode($data);
    }

    function getLocation() {
        $requestData = $_REQUEST;
        // $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        // if ($limit == -1) {
        //     if (!empty($search)) {
        //         $data['doctors'] = $this->doctor_model->getDoctorBysearch($search);
        //     } else {
        //         $data['doctors'] = $this->doctor_model->getDoctor();
        //     }
        // } else {
        //     if (!empty($search)) {
        //         $data['doctors'] = $this->doctor_model->getDoctorByLimitBySearch($limit, $start, $search);
        //     } else {
        //         $data['doctors'] = $this->doctor_model->getDoctorByLimit($limit, $start);
        //     }
        // }
         $data['locations'] = $this->settings_model->getLocations();

        foreach ($data['locations'] as $location) {
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options1 = '<a type="button" href="#myModal2" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $location->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
                //   $options1 = '<a class="btn btn-info btn-xs btn_width" title="' . lang('edit') . '" href="doctor/editDoctor?id='.$doctor->id.'"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }
            
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options2 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="settings/delete_location?id=' . $location->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash-o"> </i> ' . lang('delete') . '</a>';
            }


            $info[] = array(
                $location->id,
                $location->name,
                $location->description,
               
                //  $options1 . ' ' . $options2 . ' ' . $options3,
                $options1 . ' ' . $options2,
                    //  $options2
            );
        }

        if (!empty($data['locations'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('locations')->num_rows(),
                "recordsFiltered" => $this->db->get('locations')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    function delete_location() {
        $data = array();
        $id = $this->input->get('id');
        $location = $this->db->get_where('locations', array('id' => $id))->row();
       
        $this->db->where('id', $id);
        $this->db->delete('locations');
        // $this->doctor_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('settings/locations');
    }

    function backups() {
        $data['files'] = glob('./files/backups/*.zip', GLOB_BRACE);
        $data['dbs'] = glob('./files/backups/*.txt', GLOB_BRACE);
        $data['settings'] = $this->settings_model->getSettings();

        //$bc = array(array('link' => site_url('settings'), 'page' => lang('settings')), array('link' => '#', 'page' => lang('backups')));
        //$meta = array('page_title' => lang('backups'), 'bc' => $bc);
        // $this->page_construct('settings/backups', $this->data, $meta);
        $this->load->view('home/dashboard', $data);
        $this->load->view('backups', $data);
        $this->load->view('home/footer');
    }

    function language() {

        $data['settings'] = $this->settings_model->getSettings();

        //$bc = array(array('link' => site_url('settings'), 'page' => lang('settings')), array('link' => '#', 'page' => lang('backups')));
        //$meta = array('page_title' => lang('backups'), 'bc' => $bc);
        // $this->page_construct('settings/backups', $this->data, $meta);
        $this->load->view('home/dashboard', $data);
        $this->load->view('language', $data);
        $this->load->view('home/footer');
    }

    function changeLanguage() {
        $id = $this->input->post('id');
        $language = $this->input->post('language');
        $language_settings = $this->input->post('language_settings');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('language', 'language', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('settings', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'language' => $language,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            $this->session->set_flashdata('feedback', 'Updated');
            if (!empty($language_settings)) {
                redirect('settings/language');
            } else {
                redirect('');
            }
        }
    }


     public function suppliers() {

        // echo "here"; exit();
        $data['suppliers'] = $this->supplier_model->getSuppliers();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings/supplier/supplier', $data);
        $this->load->view('home/footer'); // just the footer file
    }

     public function addNewView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings/supplier/add_new');
        $this->load->view('home/footer'); // just the footer file
    }

    public function addNewSupplier() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        // $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        // if (empty($id)) {
        //     $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[50]|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['supplier'] = $this->suppliers_model->getSupplierById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('settings/supplier/add_new', $data);
                $this->load->view('home/footer'); // just the footer file
            } 

            else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('settings/supplier/add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            // $file_name = $_FILES['img_url']['name'];
            // $file_name_pieces = explode('_', $file_name);
            // $new_file_name = '';
            // $count = 1;
            // foreach ($file_name_pieces as $piece) {
            //     if ($count !== 1) {
            //         $piece = ucfirst($piece);
            //     }

            //     $new_file_name .= $piece;
            //     $count++;
            // }
            // $config = array(
            //     'file_name' => $new_file_name,
            //     'upload_path' => "./uploads/",
            //     'allowed_types' => "gif|jpg|png|jpeg|pdf",
            //     'overwrite' => False,
            //     'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            //     'max_height' => "1768",
            //     'max_width' => "2024"
            // );

            // $this->load->library('Upload', $config);
            // $this->upload->initialize($config);

            // if ($this->upload->do_upload('img_url')) {
            //     $path = $this->upload->data();
            //     $img_url = "uploads/" . $path['file_name'];
            //     $data = array();
            //     $data = array(
            //         'img_url' => $img_url,
            //         'name' => $name,
            //         'email' => $email,
            //         'address' => $address,
            //         'phone' => $phone
            //     );
            // } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            // }
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New supplier
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('settings/addNewView');
                } else {
                    $dfg = 12;
                    $password = '12345';
                    // $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('supplier', array('email' => $email))->row()->id;
                    $this->supplier_model->insertSupplier($data);
                    $supplier_user_id = $this->db->get_where('supplier', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->supplier_model->updateSupplier($supplier_user_id, $id_info);
                    $this->session->set_flashdata('feedback', 'Added');
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                }
            } else { // Updating supplier
                $ion_user_id = $this->db->get_where('supplier', array('id' => $id))->row()->ion_user_id;
                // if (empty($password)) {
                //     $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                // } else {
                //     $password = $this->ion_auth_model->hash_password($password);
                // }
                // $this->supplier_model->updateIonUser($username, $email, $ion_user_id);
                $this->supplier_model->updateSupplier($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('settings/suppliers');
        }
    }

    function getSupplier() {
        $data['suppliers'] = $this->supplier_model->getSuppliers();
        $this->load->view('settings/supplier/supplier', $data);
    }

    function editSupplier() {
        $data = array();
        $id = $this->input->get('id');
        $data['supplier'] = $this->supplier_model->getSupplierById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings/supplier/add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editSupplierByJason() {
        $id = $this->input->get('id');
        $data['supplier'] = $this->supplier_model->getSupplierById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('supplier', array('id' => $id))->row();
        
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $id);
        
        $this->supplier_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('settings/suppliers');
    }



    function selectPaymentGateway() {
        $id = $this->input->post('id');
        $payment_gateway = $this->input->post('payment_gateway');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('payment_gateway', 'Payment Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            redirect('pgateway');
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'payment_gateway' => $payment_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            $this->session->set_flashdata('feedback', 'Updated');
            if (!empty($payment_gateway)) {
                redirect('pgateway');
            } else {
                redirect('');
            }
        }
    }
    
     function selectSmsGateway() {
        $id = $this->input->post('id');
        $sms_gateway = $this->input->post('sms_gateway');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('sms_gateway', 'Sms Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            redirect('pgateway');
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'sms_gateway' => $sms_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            $this->session->set_flashdata('feedback', 'Updated');
            if (!empty($sms_gateway)) {
                redirect('sms');
            } else {
                redirect('');
            }
        }
    }

    function backup_database() {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->dbutil();
        $prefs = array(
            'format' => 'sql',
            'filename' => 'hms_db_backup.sql'
        );
        $back = $this->dbutil->backup($prefs);
        $backup = & $back;
        $db_name = 'db-backup-on-' . date("Y-m-d-H-i-s") . '.txt';
        $save = './files/backups/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->session->set_flashdata('message', 'Database backup Successfull !');
        redirect("settings/backups");

        /* 	
          $this->load->dbutil();
          $backup = $this->dbutil->backup();
          $this->load->helper('file');
          write_file('Downloads.sql', $backup);
          $this->load->helper('download');
          force_download('backup.zip', $backup); */
    }

    function backup_files() {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->library('zip');
        $data = array_diff(scandir(FCPATH), array('..', '.', 'files')); // 'files' folder will be excluded here with '.' and '..'
        foreach ($data as $d) {
            $path = FCPATH . $d;
            if (is_dir($path))
                $this->zip->read_dir($path, false);
            if (is_file($path))
                $this->zip->read_file($path, false);
        }
        $filename = 'file-backup-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->archive(FCPATH . 'files/backups/' . $filename);
        $this->session->set_flashdata('message', 'Application backup Successfull !');
        redirect("settings/backups");
        exit();
    }

    /* function backup_files()
      {
      if (!$this->ion_auth->in_group('admin')) {
      $this->session->set_flashdata('error', lang('access_denied'));
      redirect("home/permission");
      }
      $this->load->dbutil();
      $backup = $this->dbutil->backup();
      $this->load->helper('file');

      $filename = 'file-backup-' . date("Y-m-d-H-i-s");
      $this->sma->zip("./", './files/backups/', $filename);
      $this->session->set_flashdata('message', lang('backup_saved'));
      redirect("settings/backups");
      exit();
      } */

    function restore_database($dbfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $file = file_get_contents('./files/backups/' . $dbfile . '.txt');
        $this->db->conn_id->multi_query($file);
        $this->db->conn_id->close();
        $this->session->set_flashdata('message', 'Restoring of Backup Successfull');
        redirect('settings/backups');
    }

    function download_database($dbfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->library('zip');
        $this->zip->read_file('./files/backups/' . $dbfile . '.txt');
        $name = 'db_backup_' . date('Y_m_d_H_i_s') . '.zip';
        $this->zip->download($name);
        exit();
    }

    function download_backup($zipfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->helper('download');
        force_download('./files/backups/' . $zipfile . '.zip', NULL);
        exit();
    }

    function restore_backup($zipfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $file = './files/backups/' . $zipfile . '.zip';
        $this->sma->unzip($file, './');
        $this->session->set_flashdata('info', 'Restoring of Application Successfull');
        redirect("settings/backups");
        exit();
    }

    function delete_database($dbfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        unlink('./files/backups/' . $dbfile . '.txt');
        $this->session->set_flashdata('info', 'Deleting of Database Successfull');
        redirect("settings/backups");
    }

    function delete_backup($zipfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        unlink('./files/backups/' . $zipfile . '.zip');
        $this->session->set_flashdata('info', 'Deleting of App Backup Successfull');
        redirect("settings/backups");
    }

}

/* End of file settings.php */
/* Location: ./application/modules/settings/controllers/settings.php */


