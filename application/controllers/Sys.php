<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property SysModel $sysModel Description
 * @property Datatables $datatables Description
 * @property \CI_Upload $upload Description
 */
class Sys extends TQ_Controller
{
    public $viewPath = "system/";
    public $modalPath = "system/";

    public function __construct()
    {
        parent:: __construct();
        $this->load->model('sysModel');
        $this->ifNotLogin();
    }

    public function index()
    {
        $this->home();
    }

    public function home()
    {
        $this->data['citiesCovered'] = $this->sysModel->countTotal(TABLE_CITIES, ['cityDeleted' => 0]);
        $this->data['areasCovered'] = $this->sysModel->countTotal(TABLE_AREAS, ['areaDeleted' => 0]);
        $this->data['totalPackages'] = $this->sysModel->countTotal(TABLE_PACKAGES, ['pDeleted' => 0]);
        $this->data['totalActiveCustomers'] = $this->sysModel->countTotal(TABLE_CUSTOMERS, ['cusDeleted' => 0, 'cusStatus' => 'Active']);
        $this->data['totalInactiveCustomers'] = $this->sysModel->countTotal(TABLE_CUSTOMERS, ['cusDeleted' => 0, 'cusStatus' => 'Inactive']);
        $this->data['totalTeamMembers'] = $this->sysModel->countTotal(TABLE_EMPLOYEES, ['eDeleted' => 0]);
        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => "Home", "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => "", "page" => __FUNCTION__]
        )];
        $this->viewPath(__FUNCTION__);
    }

    public function profile()
    {
        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => currentUserName(), "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => "", "page" => __FUNCTION__]
        )];

        $this->data["profile"] = $this->sysModel->getById(TABLE_EMPLOYEES, ["eID" => currentUserID()]);

        $this->form_validation->set_rules('eName', 'Name can not be blank', 'required');
        if ($this->form_validation->run()) {
            $array = ["eName", "eEmail", "eGender", "ePhone", "eAddress"];
            $data = [];
            foreach ($array as $a) {
                $data[$a] = $this->input->post($a);
            }
            if ($this->upload->do_upload('eImage') != null) {
                $img = $this->upload->data();
                $data["eImage"] = $img["file_name"];
                if ($this->data["profile"]->eImage) {
                    unlink($img["file_path"] . $this->data["profile"]->eImage);
                }
            }
            if ($this->sysModel->updateData(TABLE_EMPLOYEES, $data, ['eID' => currentUserID()])) {
                $userData = [];
                if ($this->input->post('password') != NULL) {
                    $userData['password'] = getEncryptedText($this->input->post('password'));
                    $this->sysModel->updateData(TABLE_USERS, $userData, ['userID' => currentUserID()]);
                }
                $this->goToUrl(sysUrl("profile"), "Successfully updated profile!!", SUCCESS);
            } else {
                return $this->goToReference("Failed to add to server!!!", DANGER);
            }
        }
        $this->viewPath("employees/" . __FUNCTION__);
    }

    //city module start
    public function cities()
    {
        $this->ifNotAdmin();
        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => "Cities", "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => "", "page" => __FUNCTION__]
        )];

        $this->viewPath('cities/index');
    }

    public function getCities()
    {
        $this->ifNotAdmin();
        $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . sysUrl('removeCity/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        $extra = '<a class = "btn btn-link p-0 px-1" modal-toggler="true" data-target="#remoteModal1" data-remote="' . sysUrl("updateCity/$1") . '"><i class="fa fa-edit"></i></a>';
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class = \"text-center\">"
            . $extra
            . "</div>";
        $this->datatables->select('c.cityID as cityID, c.cityName, e.eName, c.cityAddedTime, c.cityUpdatedTime')
            ->from(TABLE_CITIES . ' as c')
            ->join(TABLE_EMPLOYEES . ' as e', 'e.eID = c.cityAddedBy')
            ->addColumn('actions', $action, 'cityID')
            ->where(['cityDeleted' => 0])
            ->generate();
        return true;
    }

    public function addCity()
    {
        $this->ifNotAdmin();
        $this->form_validation->set_rules('cityName', 'City Name', 'required');

        if ($this->form_validation->run()) {
            $inputData = [];
            $inputData['cityName'] = $this->input->post("cityName");
            $inputData['cityAddedBy'] = currentUserID();
            $inputData['cityAddedTime'] = getCurrentTime();
            if ($this->sysModel->insertData(TABLE_CITIES, $inputData)) {
                return $this->goToUrl(sysUrl('cities'), 'Successfully added!!', SUCCESS);
            } else {
                return $this->goToReference("Failed to add!!", DANGER);
            }
        }
        $this->modalPath('cities/' . __FUNCTION__);
    }

    public function updateCity($cityID)
    {
        $this->ifNotAdmin();
        $this->form_validation->set_rules('cityName', 'City Name', 'required');
        if ($this->form_validation->run()) {
            $inputData = [];
            $inputData['cityName'] = $this->input->post("cityName");
            $inputData['cityUpdatedTime'] = getCurrentTime();
            if ($this->sysModel->updateData(TABLE_CITIES, $inputData, ['cityID' => $cityID])) {
                return $this->goToUrl(sysUrl('cities'), 'Successfully updated!!', SUCCESS);
            } else {
                return $this->goToReference("Failed to update!!", DANGER);
            }
        }
        $this->data['updateCity'] = $this->sysModel->getById(TABLE_CITIES, ['cityID' => $cityID]);
        $this->modalPath('cities/' . __FUNCTION__);
    }

    public function removeCity($cityID)
    {
        $this->ifNotAdmin();
        $delData['cityDeleted'] = 1;
        if ($this->sysModel->updateData(TABLE_CITIES, $delData, ['cityID' => $cityID])) {
            return $this->goToUrl(sysUrl('cities'), 'Successfully deleted', SUCCESS);
        } else {
            return $this->goToReference("Failed to delete!", WARNING);
        }

    }

    public function checkCityAvailability()
    {
        $check = $this->input->post('cityName');
        if ($this->sysModel->is_available(TABLE_CITIES, ['cityName' => $check, 'cityDeleted' => 0])) {
            echo '<label class="text-danger"><span class="glyphicon glyphicon-ok"></span>City Already Registered. Choose another</label>';
        } else {
            echo '<label class="text-success"><span class="glyphicon glyphicon-remove"></span>Available to be registered</label>';
        }
    }
    //city module end

    //area module start
    public function areas()
    {
        $this->ifNotAdmin();
        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => "Areas", "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => "", "page" => __FUNCTION__]
        )];

        $this->viewPath('areas/index');
    }

    public function getAreas()
    {
        $this->ifNotAdmin();
        $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . sysUrl('removeArea/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        $extra = '<a class = "btn btn-link p-0 px-1" modal-toggler="true" data-target="#remoteModal1" data-remote="' . sysUrl("updateArea/$1") . '"><i class="fa fa-edit"></i></a>';
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class = \"text-center\">"
            . $extra
            . "</div>";
        $this->datatables->select('a.areaID as areaID, a.areaName, c.cityName, e.eName, a.areaAddedTime, a.areaUpdatedTime')
            ->from(TABLE_AREAS . ' as a')
            ->join(TABLE_EMPLOYEES . ' as e', 'e.eID = a.areaAddedBy')
            ->join(TABLE_CITIES . ' as c', 'c.cityID = a.areaCityID')
            ->addColumn('actions', $action, 'areaID')
            ->where(['areaDeleted' => 0])
            ->generate();
        return true;
    }

    public function addArea()
    {
        $this->ifNotAdmin();
        $this->form_validation->set_rules('areaName', 'Area Name', 'required');
        $this->form_validation->set_rules('areaCityID', 'Area City ID', 'required');
        if ($this->form_validation->run()) {
            $inputData = [];
            $inputData['areaName'] = $this->input->post("areaName");
            $inputData['areaCityID'] = $this->input->post("areaCityID");
            $inputData['areaAddedBy'] = currentUserID();
            $inputData['areaAddedTime'] = getCurrentTime();
            if ($this->sysModel->insertData(TABLE_AREAS, $inputData)) {
                return $this->goToUrl(sysUrl('areas'), 'Successfully added!!', SUCCESS);
            } else {
                return $this->goToReference("Failed to add!!", DANGER);
            }
        }
        $this->modalPath('areas/' . __FUNCTION__);
    }

    public function updateArea($areaID)
    {
        $this->ifNotAdmin();
        $this->form_validation->set_rules('areaName', 'Area Name', 'required');
        $this->form_validation->set_rules('areaCityID', 'Area City ID', 'required');
        if ($this->form_validation->run()) {
            $inputData = [];
            $inputData['areaName'] = $this->input->post("areaName");
            $inputData['areaCityID'] = $this->input->post("areaCityID");
            $inputData['areaUpdatedTime'] = getCurrentTime();
            if ($this->sysModel->updateData(TABLE_AREAS, $inputData, ['areaID' => $areaID])) {
                return $this->goToUrl(sysUrl('areas'), 'Successfully updated!!', SUCCESS);
            } else {
                return $this->goToReference("Failed to update!!", DANGER);
            }
        }
        $this->data['updateArea'] = $this->sysModel->getById(TABLE_AREAS, ['areaID' => $areaID]);
        $this->data['chCity'] = $this->sysModel->getSingleData(TABLE_CITIES, ['cityID' => $this->data['updateArea']->areaCityID]);
        $this->modalPath('areas/' . __FUNCTION__);
    }

    public function removeArea($areaID)
    {
        $this->ifNotAdmin();
        $delData['areaDeleted'] = 1;
        if ($this->sysModel->updateData(TABLE_AREAS, $delData, ['areaID' => $areaID])) {
            return $this->goToUrl(sysUrl('areas'), 'Successfully deleted', SUCCESS);
        } else {
            return $this->goToReference("Failed to delete!", WARNING);
        }

    }

    public function checkAreaAvailability()
    {
        $check = $this->input->post('areaName');
        if ($this->sysModel->is_available(TABLE_AREAS, ['areaName' => $check, 'areaDeleted' => 0])) {
            echo '<label class="text-danger"><span class="glyphicon glyphicon-ok"></span>Area Already Registered. Choose another</label>';
        } else {
            echo '<label class="text-success"><span class="glyphicon glyphicon-remove"></span>Available to be registered</label>';
        }
    }

    public function selectCityForArea()
    {
        $json = [];
        $data = $this->input->get("q");
        $json = $this->sysModel->getBySelect2('cityID', 'cityName', $data, ['cityDeleted' => 0], TABLE_CITIES);
        $out = replaceKeys('cityID', 'id', $json);
        echo json_encode($out);
    }
    //area module end

    // customer module start
    public function customers()
    {
        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => "Customers", "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => "", "page" => __FUNCTION__]
        )];

        $this->viewPath('customers/index');

    }

    public function getCustomers()
    {
        $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . sysUrl('removeCustomer/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        $extra = '<a class = "btn btn-link p-0 px-1" modal-toggler="true" data-target="#remoteModal1" data-remote="' . sysUrl("updateCustomer/$1") . '"><i class="fa fa-edit"></i></a>';
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class = \"text-center\">"
            . $extra
            . "</div>";
        $this->datatables->select('cus.cusID as cusID, cus.cusImage, cus.cusName, cus.cusEmail, cus.cusPhone, cus.cusAddress,  c.cityName, a.areaName, cus.cusStatus, cus.cusAddedTime, e.eName, cus.cusUpdatedTime, cus.cusDeleted')
            ->from(TABLE_CUSTOMERS . ' as cus')
            ->join(TABLE_CITIES . ' as c', 'c.cityID = cus.cusCityID')
            ->join(TABLE_AREAS . ' as a', 'a.areaID = cus.cusAreaID')
            ->join(TABLE_EMPLOYEES . ' as e', 'e.eID = cus.cusAddedBy')
            ->addColumn('actions', $action, 'cusID')
            ->where(['cusDeleted' => 0])
            ->generate();
        return true;
    }

    public function addCustomer()
    {
        $this->form_validation->set_rules('cusName', 'Name', 'required');
        $this->form_validation->set_rules('cusPhone', 'Phone', 'required');
        $this->form_validation->set_rules('cusCityID', 'City', 'required');
        $this->form_validation->set_rules('cusAreaID', 'Area', 'required');
        if ($this->form_validation->run()) {
            $arr = ['cusName', 'cusEmail', 'cusPhone', 'cusAddress', 'cusStatus', 'cusCityID', 'cusAreaID'];
            $inputData = [];
            foreach ($arr as $a) {
                $inputData[$a] = $this->input->post($a);
            }
            $inputData['cusAddedTime'] = getCurrentTime();
            $inputData['cusUpdatedTime'] = getCurrentTime();
            $inputData['cusAddedBy'] = currentUserID();
            if ($this->upload->do_upload('cusImage') != null) {
                $img = $this->upload->data();
                $inputData["cusImage"] = $img["file_name"];
            }
            if ($this->sysModel->insertData(TABLE_CUSTOMERS, $inputData)) {
                return $this->goToUrl(sysUrl('customers'), $inputData['cusName'] . ' successfully added as customer!!', SUCCESS);
            } else {
                return $this->goToReference("Failed to add!!", DANGER);
            }
        }
        $this->modalPath('customers/addCustomer');
    }

    public function updateCustomer($cusID)
    {
        $this->data['updateCustomer'] = $this->sysModel->getById(TABLE_CUSTOMERS, ['cusID' => $cusID]);

        $this->form_validation->set_rules('cusName', 'Name', 'required');
        $this->form_validation->set_rules('cusPhone', 'Phone', 'required');
        $this->form_validation->set_rules('cusAddress', 'Address', 'required');
        if ($this->form_validation->run()) {
            $arr = ['cusName', 'cusEmail', 'cusPhone', 'cusAddress', 'cusStatus', 'cusCityID', 'cusAreaID'];
            $inputData = [];
            foreach ($arr as $a) {
                $inputData[$a] = $this->input->post($a);
            }
            $inputData['cusUpdatedTime'] = getCurrentTime();
            if ($this->upload->do_upload('cusImage') != null) {
                $img = $this->upload->data();
                $inputData["cusImage"] = $img["file_name"];
                if ($this->data["updateCustomer"]->cusImage) {
                    unlink($img["file_path"] . $this->data["updateCustomer"]->cusImage);
                }
            }
            if ($this->sysModel->updateData(TABLE_CUSTOMERS, $inputData, ['cusID' => $cusID])) {
                return $this->goToUrl(sysUrl('customers'), $inputData['cusName'] . ' successfully updated as customer!!', SUCCESS);
            } else {
                return $this->goToReference("Failed to add!!", DANGER);
            }
        }
        $this->data['chCity'] = $this->sysModel->getSingleData(TABLE_CITIES, ['cityID' => $this->data['updateCustomer']->cusCityID]);
        $this->data['chArea'] = $this->sysModel->getSingleData(TABLE_AREAS, ['areaID' => $this->data['updateCustomer']->cusAreaID]);
        $this->modalPath('customers/updateCustomer');
    }

    public function removeCustomer($cusID)
    {
        $delData['cusDeleted'] = 1;
        if ($this->sysModel->updateData(TABLE_CUSTOMERS, $delData, ['cusID' => $cusID])) {
            return $this->goToUrl(sysUrl('customers'), 'Successfully deleted', SUCCESS);
        } else {
            return $this->goToReference("Failed to delete!", WARNING);
        }

    }

    public function checkCusPhoneAvailability()
    {
        $check = $this->input->post('cusPhone');
        if ($this->sysModel->is_available(TABLE_CUSTOMERS, ['cusPhone' => $check, 'cusDeleted' => 0])) {
            echo '<label class="text-danger"><span class="glyphicon glyphicon-ok"></span>Customer Already Registered. Choose another</label>';
        } else {
            echo '<label class="text-success"><span class="glyphicon glyphicon-remove"></span>Available to be registered</label>';
        }
    }

    public function selectAreaForCustomer($cityID)
    {
        $json = [];
        $data = $this->input->get("q");
        $json = $this->sysModel->getBySelect2('areaID', 'areaName', $data, ['areaDeleted' => 0, 'areaCityID' => $cityID], TABLE_AREAS);
        $out = replaceKeys('areaID', 'id', $json);
        echo json_encode($out);
    }
    // customer module end

    //employee module starts

    public function team()
    {
        $this->ifNotAdmin();
        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => "Team", "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => "", "page" => "Support Team"]
        )];

        $this->viewPath('employees/index');

    }

    public function getTeam()
    {
        $this->ifNotAdmin();
        $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . sysUrl('removeEmployee/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        $extra = '<a class = "btn btn-link p-0 px-1" modal-toggler="true" data-target="#remoteModal1" data-remote="' . sysUrl("updateEmployee/$1") . '"><i class="fa fa-edit"></i></a>';
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class = \"text-center\">"
            . $extra
            . "</div>";
        $this->datatables->select('eID, eImage, eName, eEmail, eGender, ePhone, eAddress, eDepartment, eDesignation, eSalary, eJoiningDate, eResigningDate, eAddedTime, eUpdatedTime, eDeleted')
            ->from(TABLE_EMPLOYEES)
            ->addColumn('actions', $action, 'eID')
            ->where(['eDeleted' => 0])
            ->generate();
        return true;
    }

    public function addEmployee()
    {
        $this->ifNotAdmin();
        $this->form_validation->set_rules('eName', 'Name', 'required');
        $this->form_validation->set_rules('ePhone', 'Phone', 'required');
        $this->form_validation->set_rules('eSalary', 'Salary', 'required');
        $this->form_validation->set_rules('eJoiningDate', 'JoiningDate', 'required');
        if ($this->form_validation->run()) {
            $arr = ['eName', 'eEmail', 'eGender', 'ePhone', 'eAddress', 'eDepartment', 'eDesignation', 'eSalary', 'eJoiningDate'];
            $inputData = [];
            foreach ($arr as $a) {
                $inputData[$a] = $this->input->post($a);
            }
            $inputData['eJoiningDate'] = changeDateFormat($inputData['eJoiningDate']);
            $inputData['eAddedTime'] = getCurrentTime();
            $inputData['eUpdatedTime'] = getCurrentTime();
            if ($this->upload->do_upload('eImage') != null) {
                $img = $this->upload->data();
                $inputData["eImage"] = $img["file_name"];
            }
            $pass = $this->input->post('uPassword');
            if ($userID = $this->sysModel->insertData(TABLE_EMPLOYEES, $inputData)) {
                if ($pass) {
                    $inputUserData = [];
                    $inputUserData['userID'] = $userID;
                    $inputUserData['password'] = getEncryptedText($pass);
                    $inputUserData['uAddedBy'] = currentUserID();
                    $this->sysModel->insertData(TABLE_USERS, $inputUserData);
                }
                return $this->goToUrl(sysUrl('team'), $inputData['eName'] . ' Successfully added as ' . $inputData['eDesignation'], SUCCESS);
            } else {
                return $this->goToReference("Failed to add!!", DANGER);
            }
        }
        $this->modalPath('employees/' . __FUNCTION__);
    }

    public function updateEmployee($eID)
    {
        $this->ifNotAdmin();
        $this->data["updateEmployee"] = $this->sysModel->getById(TABLE_EMPLOYEES, ["eID" => $eID]);

        $this->form_validation->set_rules('eName', 'Name', 'required');
        $this->form_validation->set_rules('ePhone', 'Phone', 'required');
        $this->form_validation->set_rules('eSalary', 'Salary', 'required');
        $this->form_validation->set_rules('eJoiningDate', 'JoiningDate', 'required');
        if ($this->form_validation->run()) {
            $arr = ['eName', 'eEmail', 'eGender', 'ePhone', 'eAddress', 'eDepartment', 'eDesignation', 'eSalary', 'eJoiningDate', 'eResigningDate'];
            $inputData = [];
            foreach ($arr as $a) {
                $inputData[$a] = $this->input->post($a);
            }
            $inputData['eJoiningDate'] = changeDateFormat($inputData['eJoiningDate']);
            $inputData['eResigningDate'] = changeDateFormat($inputData['eResigningDate']);
            $inputData['eUpdatedTime'] = getCurrentTime();
            if ($this->upload->do_upload('eImage') != null) {
                $img = $this->upload->data();
                $inputData["eImage"] = $img["file_name"];
                if ($this->data["updateEmployee"]->eImage) {
                    unlink($img["file_path"] . $this->data["updateEmployee"]->eImage);
                }
            }

            if ($this->sysModel->updateData(TABLE_EMPLOYEES, $inputData, ['eID' => $eID])) {
                return $this->goToUrl(sysUrl('team'), $inputData['eName'] . ' Successfully updated as ' . $inputData['eDesignation'], SUCCESS);
            } else {
                return $this->goToReference("Failed to add!!", DANGER);
            }
        }
        $this->modalPath('employees/' . __FUNCTION__);
    }

    public function removeEmployee($eID)
    {
        $this->ifNotAdmin();
        $delData['eDeleted'] = 1;
        if ($this->sysModel->updateData(TABLE_EMPLOYEES, $delData, ['eID' => $eID])) {
            return $this->goToUrl(sysUrl('team'), 'Successfully deleted', SUCCESS);
        } else {
            return $this->goToReference("Failed to delete!", WARNING);
        }

    }

    public function checkEmployeeAvailability()
    {
        $check = $this->input->post('eName');
        if ($this->sysModel->is_available(TABLE_EMPLOYEES, ['eName' => $check, 'eDeleted' => 0])) {
            echo '<label class="text-danger"><span class="glyphicon glyphicon-ok"></span>Employee Already Registered. Choose another</label>';
        } else {
            echo '<label class="text-success"><span class="glyphicon glyphicon-remove"></span>Available to be registered</label>';
        }
    }


    //employee module ends

    //package module starts

    public function packages()
    {
        $this->ifNotAdmin();
        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => "Packages", "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => "", "page" => __FUNCTION__]
        )];

        $this->viewPath('packages/index');

    }

    public function getPackages()
    {
        $this->ifNotAdmin();
        $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . sysUrl('removePackage/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        $extra = '<a class = "btn btn-link p-0 px-1" modal-toggler="true" data-target="#remoteModal1" data-remote="' . sysUrl("updatePackage/$1") . '"><i class="fa fa-edit"></i></a>';
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class = \"text-center\">"
            . $extra
            . "</div>";
        $this->datatables->select('p.pID as pID, p.pName, p.pBandwidth, p.pConnectionType, p.pIpType, p.pOthers, p.pRate, e.eName, p.pAddedTime, p.pUpdatedTime, p.pDeleted')
            ->from(TABLE_PACKAGES . ' as p')
            ->join(TABLE_EMPLOYEES . ' as e', 'e.eID = p.pAddedBy')
            ->addColumn('actions', $action, 'pID')
            ->where(['p.pDeleted' => 0])
            ->generate();
        return true;
    }

    public function addPackage()
    {
        $this->ifNotAdmin();
        $this->form_validation->set_rules('pName', 'Name', 'required');
        $this->form_validation->set_rules('pRate', 'Rate', 'required');
        if ($this->form_validation->run()) {
            $arr = ['pName', 'pBandwidth', 'pConnectionType', 'pIpType', 'pOthers', 'pRate'];
            $newPack = [];
            foreach ($arr as $a) {
                $newPack[$a] = $this->input->post($a);
            }
            $newPack['pAddedTime'] = getCurrentTime();
            $newPack['pUpdatedTime'] = getCurrentTime();
            $newPack['pAddedBy'] = currentUserID();
            if ($this->sysModel->insertData(TABLE_PACKAGES, $newPack)) {
                return $this->goToUrl(sysUrl('packages'), $newPack['pName'] . ' Successfully Added!!', SUCCESS);
            } else {
                return $this->goToReference("Failed to add!!", DANGER);
            }
        }
        $this->modalPath('packages/' . __FUNCTION__);
    }

    public function updatePackage($pID)
    {
        $this->ifNotAdmin();
        $this->form_validation->set_rules('pName', 'Name', 'required');
        $this->form_validation->set_rules('pRate', 'Rate', 'required');
        if ($this->form_validation->run()) {
            $arr = ['pName', 'pBandwidth', 'pConnectionType', 'pIpType', 'pOthers', 'pRate'];
            $newPack = [];
            foreach ($arr as $a) {
                $newPack[$a] = $this->input->post($a);
            }
            $newPack['pUpdatedTime'] = getCurrentTime();
            if ($this->sysModel->updateData(TABLE_PACKAGES, $newPack, ["pID" => $pID])) {
                return $this->goToUrl(sysUrl('packages'), $newPack['pName'] . ' Successfully Updated!!', SUCCESS);
            } else {
                return $this->goToReference("Failed to add!!", DANGER);
            }
        }
        $this->data["updatePackage"] = $this->sysModel->getById(TABLE_PACKAGES, ["pID" => $pID]);
        $this->modalPath('packages/' . __FUNCTION__);
    }

    public function removePackage($pID)
    {
        $this->ifNotAdmin();
        $delData['pDeleted'] = 1;
        if ($this->sysModel->softRemoveData(TABLE_PACKAGES, $delData, ['pID' => $pID])) {
            return $this->goToUrl(sysUrl('packages'), 'Successfully deleted', SUCCESS);
        } else {
            return $this->goToReference("Failed to delete!", WARNING);
        }

    }

    public function checkPackageAvailability()
    {
        $check = $this->input->post('pName');
        if ($this->sysModel->is_available(TABLE_PACKAGES, ['pName' => $check, 'pDeleted' => 0])) {
            echo '<label class="text-danger"><span class="glyphicon glyphicon-ok"></span>Package Already Registered. Choose another</label>';
        } else {
            echo '<label class="text-success"><span class="glyphicon glyphicon-remove"></span>Available to be registered</label>';
        }
    }


    //packages module ends


    //connection module start
    public function connections($type)
    {

        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => ucfirst($type) . " Connections", "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => "", "page" => $type . ' ' . __FUNCTION__]
        )];
        if ($type == 'active')
            $this->viewPath('connections/active/index');
        else
            $this->viewPath('connections/inactive/index');
    }

    public function getActives()
    {

        $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . sysUrl('removeConnection/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        $extra = '<a class = "btn btn-link p-0 px-1" modal-toggler="true" data-target="#remoteModal2" data-remote="' . sysUrl("makePayment/$1") . '"><i class="fab fa-paypal"></i></a>';
        $extra .= '<a class = "btn btn-link p-0 px-1" modal-toggler="true" data-target="#remoteModal1" data-remote="' . sysUrl("updateConnection/$1") . '"><i class="fa fa-edit"></i></a>';
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class = \"text-center\">"
            . $extra
            . "</div>";
        $this->datatables->select('con.conID as conID, cus.cusName, p.pName, con.conStart, con.conDetail, e.eName, con.conAddedTime, con.conUpdatedTime')
            ->from(TABLE_CONNECTIONS . '  as con')
            ->join(TABLE_EMPLOYEES . ' as e', 'e.eID = con.conAddedBy')
            ->join(TABLE_PACKAGES . ' as p', 'p.pID = con.conPackID')
            ->join(TABLE_CUSTOMERS . ' as cus', 'cus.cusID = con.conCusID')
            ->addColumn('actions', $action, 'conID')
            ->where(['con.conDeleted' => 0])
            ->generate();
        return true;
    }

    public function addConnection()
    {

        $this->form_validation->set_rules('conStart', 'Start Date', 'required');
        if ($this->form_validation->run()) {
            $arr = ['conCusID', 'conPackID', 'conStart', 'conDetail'];
            $newPack = [];
            foreach ($arr as $a) {
                $newPack[$a] = $this->input->post($a);
            }
            $newPack['conStart'] = changeDateFormat($newPack['conStart']);
            $newPack['conAddedTime'] = getCurrentTime();
            $newPack['conUpdatedTime'] = getCurrentTime();
            $newPack['conAddedBy'] = currentUserID();
            if ($this->sysModel->insertData(TABLE_CONNECTIONS, $newPack)) {
                return $this->goToUrl(sysUrl('connections/active'), 'New Connection Successfully Added!!', SUCCESS);
            } else {
                return $this->goToReference("Failed to add!!", DANGER);
            }
        }
        $this->modalPath('connections/' . __FUNCTION__);
    }

    public function updateConnection($conID)
    {

        $this->form_validation->set_rules('conStart', 'Start Date', 'required');
        if ($this->form_validation->run()) {
            $arr = ['conCusID', 'conPackID', 'conStart', 'conDetail'];
            $newPack = [];
            foreach ($arr as $a) {
                $newPack[$a] = $this->input->post($a);
            }
            $newPack['conStart'] = changeDateFormat($newPack['conStart']);
            $newPack['conUpdatedTime'] = getCurrentTime();
            if ($this->sysModel->updateData(TABLE_CONNECTIONS, $newPack, ['conID' => $conID])) {
                return $this->goToUrl(sysUrl('connections/active'), 'Connection Successfully Updated!!', SUCCESS);
            } else {
                return $this->goToReference("Failed to add!!", DANGER);
            }
        }
        $this->data['updateConnection'] = $this->sysModel->getById(TABLE_CONNECTIONS, ['conDeleted' => 0, 'conID' => $conID]);
        $this->data['chCustomer'] = $this->sysModel->getSingleData(TABLE_CUSTOMERS, ['cusDeleted' => 0, 'cusID' => $this->data['updateConnection']->conCusID]);
        $this->data['chPackage'] = $this->sysModel->getSingleData(TABLE_PACKAGES, ['pDeleted' => 0, 'pID' => $this->data['updateConnection']->conPackID]);
        $this->modalPath('connections/' . __FUNCTION__);
    }

    public function removeConnection($conID)
    {

        $delData['conDeleted'] = 1;
        if ($this->sysModel->softRemoveData(TABLE_CONNECTIONS, $delData, ['conID' => $conID])) {
            return $this->goToUrl(sysUrl('connections/active'), 'Successfully deleted', SUCCESS);
        } else {
            return $this->goToReference("Failed to delete!", WARNING);
        }

    }

    public function selectPackage()
    {
        $json = [];
        $data = $this->input->get("q");
        $json = $this->sysModel->getBySelect2('pID', 'pName', $data, ['pDeleted' => 0], TABLE_PACKAGES);
        $out = replaceKeys('pID', 'id', $json);
        echo json_encode($out);
    }

    public function selectCustomer()
    {
        $json = [];
        $data = $this->input->get("q");
        $json = $this->sysModel->getBySelect2('cusID', 'cusName', $data, ['cusDeleted' => 0, 'cusStatus' => 'Active'], TABLE_CUSTOMERS);
        $out = replaceKeys('cusID', 'id', $json);
        echo json_encode($out);
    }

    //connection moduel end
    //payment start
    public function makePayment($conID)
    {

        $this->data['conInfo'] = $this->sysModel->getSingleData(TABLE_CONNECTIONS, ['conID' => $conID]);
        $this->data['customerInfo'] = $this->sysModel->getSingleData(TABLE_CUSTOMERS, ['cusID' => $this->data['conInfo']->conCusID]);
        $this->data['packageInfo'] = $this->sysModel->getSingleData(TABLE_PACKAGES, ['pID' => $this->data['conInfo']->conPackID]);
        $this->modalPath('payment/modal/detailPayment');
    }

    public function payment()
    {

        $this->form_validation->set_rules('payAmount', 'Amount', 'required');
        if ($this->form_validation->run()) {
            $payment = [];
            $arr = ['payConID', 'payAmount', 'payNote', 'payMonth'];
            foreach ($arr as $a) {
                $payment[$a] = $this->input->post($a);
            }
            $payment['payAddedBy'] = currentUserID();
            $payment['payReference'] = "PAY-" . date('ydm', time()) . RandomString(4) . str_pad($payment['payConID'], 4, 0, STR_PAD_LEFT);
            $payment['payAddedTime'] = getCurrentTime();
            $payID = $this->sysModel->insertData(TABLE_PAYMENT, $payment);
        }
        echo json_encode(['conID' => $payment['payConID'], 'payID' => $payID]);
    }

    public function billing()
    {

        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => "Payment History", "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => "", "page" => "Payment History"]
        )];
        $this->viewPath('payment/index');
    }

    public function getPayments()
    {

        $this->datatables->select('pay.payID as payID, pay.payReference, cus.cusName, p.pName, pay.payMonth, pay.payAmount, pay.payNote, e.eName, pay.payAddedTime')
            ->from(TABLE_PAYMENT . '  as pay')
            ->join(TABLE_CONNECTIONS . ' as con', 'con.conID = pay.payConID')
            ->join(TABLE_PACKAGES . ' as p', 'p.pID = con.conPackID')
            ->join(TABLE_CUSTOMERS . ' as cus', 'cus.cusID = con.conCusID')
            ->join(TABLE_EMPLOYEES . ' as e', 'e.eID = pay.payAddedBy')
            ->generate();
        return true;
    }

    //payment module end

    //invoice module start
    public function invoice($conID, $payID)
    {

        $this->navBarSettings(0, 0, 0, 0);
        $this->data['paymentInfo'] = $this->sysModel->getSingleData(TABLE_PAYMENT, ['payID' => $payID]);
        $this->data['conInfo'] = $this->sysModel->getSingleData(TABLE_CONNECTIONS, ['conID' => $conID]);
        $this->data['customerInfo'] = $this->sysModel->getSingleData(TABLE_CUSTOMERS, ['cusID' => $this->data['conInfo']->conCusID]);
        $this->data['packageInfo'] = $this->sysModel->getSingleData(TABLE_PACKAGES, ['pID' => $this->data['conInfo']->conPackID]);
        $this->data['cityInfo'] = $this->sysModel->getSingleData(TABLE_CITIES, ['cityID' => $this->data['customerInfo']->cusCityID]);
        $this->data['areaInfo'] = $this->sysModel->getSingleData(TABLE_AREAS, ['areaID' => $this->data['customerInfo']->cusAreaID]);
        $this->data['employeeInfo'] = $this->sysModel->getSingleData(TABLE_EMPLOYEES, ['eID' => $this->data['paymentInfo']->payAddedBy]);
        $this->viewPath('payment/' . __FUNCTION__);
    }

    //invoice module end

    public function signout()
    {
        $this->logout();
    }

}