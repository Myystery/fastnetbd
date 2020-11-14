<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property AuthModel $authModel Description
 */
class Auth extends TQ_Controller
{
    public $viewPath = "auth/";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('authModel');
    }

    public function index()
    {
        $this->ifLogin();
        $this->login();
    }

    public function login()
    {
        $this->navBarSettings(0, 0, 1, 1);
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $user = $this->authModel->loginAuth($email);
            if ($user) {
                $pass = $this->authModel->getById(TABLE_USERS, ['userID' => $user->eID])->password;
                if (getDecryptedText($pass) == $this->input->post('password')) {
                    $this->session->sess_expiration = '360';
                    $this->session->sess_expire_on_close = true;
                    $this->session->set_userdata('user', $user);
                    $this->goToUrl(sysUrl(), "Welcome " . $user->eName . " !!", SUCCESS);
                } else {
                    $this->goToReference("<br>Invalid password!!", DANGER);
                }
            } else {
                $this->goToReference('<br>Invalid User!!', DANGER);
            }
        }
        $this->viewPath(__FUNCTION__);
    }
}
