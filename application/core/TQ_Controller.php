<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @property SysModel $sysModel Description
 * @property \CI_Upload $upload Description *
 */
class TQ_Controller extends CI_Controller
{

    private $viewInit = "theme/";
    public $viewPath = "", $modalPath = "";
    public $meta = [], $data = [], $navMeta = [];

    public function __construct()
    {
        parent::__construct();
        $upconfig['upload_path'] = 'uploads/';
        $upconfig["encrypt_name"] = TRUE;
        $upconfig['max_size'] = 5 * 1024;
        $upconfig['allowed_types'] = '*';
        $this->upload->initialize($upconfig);
    }

    //	View path dynamic
    public function viewPath($page, $hideContentHeader = false)
    {
        $this->view($this->viewPath . $page, $hideContentHeader);
    }

    public function view($page, $hideContentHeader = false)
    {
        $this->data["title"] = isset($this->data["title"]) ? $this->data["title"] : systemName();

        if (!isset($this->data["navBarSettings"])) {
            $this->navBarSettings();
        }

        $this->setNavMeta($hideContentHeader);
        $passData = array_merge($this->data, ["navMeta" => $this->navMeta], $this->meta);
        $this->load->view($this->viewInit . "header", $passData);
        $this->load->view($this->viewInit . "navbar", $passData);
        $this->load->view($this->viewInit . $page, $passData);
        $this->load->view($this->viewInit . "footer", $passData);
    }

    //	Modal path dynamic
    public function modalPath($page)
    {
        $this->modal($this->modalPath . $page);
    }

    public function modal($page)
    {
        $passData = array_merge($this->data, $this->meta);
        $this->load->view($this->viewInit . $page, $passData);
    }

    //	Navbar, SlideBar, Alert handle
    private function setNavMeta($hideContentHeader)
    {
        $this->navMeta["pageTitle"] = isset($this->navMeta["pageTitle"]) ? $this->navMeta["pageTitle"] : "";
        $this->navMeta["bc"] = isset($this->navMeta["bc"]) ? $this->navMeta["bc"] : [["page" => "", "url" => "j"]];
        $this->navMeta["hideContentHeader"] = $hideContentHeader;
    }

    /**
     * Setting for menubar
     * @param type $topBar
     * @param type $slideBar
     * @return type
     */
    function navBarSettings($topBar = true, $slideBar = true, $topAlert = true, $mainContentCard = true)
    {
        $this->data["showNavBar"] = $slideBar;
        $this->data["navBarSettings"] = ["slideBar" => $slideBar, "topBar" => $topBar, "topAlert" => $topAlert, "mainContentCard" => $mainContentCard];
    }

    //	Set alert
    function setAlertMsg($msg = "", $msgType = "")
    {
        if ($msg) {
            $_SESSION["altMsg"] = $msg;
            $_SESSION["altMsgType"] = $msgType;
        }
    }

    //	Url redirection handler
    function goToReference($msg = "", $msgType = "")
    {
        $this->setAlertMsg($msg, $msgType);
        return redirect($_SERVER["HTTP_REFERER"]);
    }

    function gotoReferrer()
    {
        return redirect($this->agent->referrer());
    }

    function goToUrl($url, $msg = "", $msgType = "")
    {
        $this->setAlertMsg($msg, $msgType);
        return redirect($url);
    }

    function someThingWrong()
    {
        $this->setAlertMsg("Something Wrong!", DANGER);
        return redirect(base_url());
    }


    /**
     * redirect to login page if not loged in user
     * @return type
     */
    function ifLogin()
    {
        if (currentSession()) {
            return $this->goToUrl(sysUrl(), "Welcome back - " . currentUserName() . " !", INFO);
        }
    }

    function ifNotLogin()
    {
        if (!currentSession()) {
            $request_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
            return $this->goToUrl(loginUrl() . "?redirect=" . $request_link, "<br>Access proteced- Please Login!!!", DANGER);
        }
    }

    /**
     * redirect if not admin staff
     * @return type
     */
    function ifNotAdmin()
    {
        if (!isAdmin()) {
            return $this->goToUrl(loginUrl(), "<br>Access protected! Only Admin can access", DANGER);
        }
    }

    function ifNotCoAdmin()
    {
        if (!isCoAdmin()) {
            return $this->goToUrl(loginUrl(), "<br>Access protected! Only Co-Admin can access", DANGER);
        }
    }

    function emailBody($mailSub, $mail)
    {
        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
                        <title>' . html_escape($mailSub) . '</title>
                    <style type="text/css">
                         body {
                            font-family: Arial, Verdana, Helvetica, sans-serif;
                            font-size: 16px;
                           }
                    </style>
                    </head>
                    <body>
                    ' . $mail . '
                    </body>
                </html>';
    }


    public function logout()
    {
        $this->session->unset_userdata('user');
        session_destroy();
        return redirect(site_url());
    }

}
