<?php
/**
 * Author Suraya Islam Mim<suraiyaislam30@gmail.com>
 * Email: suraiyaislam30@gmail.com
 * Do not edit file without permission of author
 * All right reserved by Suraya Islam Mim<suraiyaislam30@gmail.com>
 * Created on: 25/04/2020 8:34 PM
 */

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property SysModel $sysModel Description
 * @property Datatables $datatables Description
 */
class Report extends TQ_Controller
{
    public $viewPath = "report/";
    public $modalPath = "report/";

    public $userMail = 'personmysterious29@gmail.com';
    public $userPass = 'put password here';

    public function __construct()
    {
        parent:: __construct();
        $this->load->model('sysModel');
        $this->ifNotLogin();
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => $this->userMail,
            'smtp_pass' => $this->userPass,
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
    }

    public function index()
    {
        $this->report();
    }

    public function report()
    {
        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => "Customer Report", "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => sysUrl("customers"), "page" => "Customer"],
            ["url" => "", "page" => "Report"]
        )];
        $this->viewPath('inDetails');
    }

    public function getReport()
    {
        $cus = $this->input->post('cus');
        $out = $this->sysModel->executeCustom('select cus.cusName, pay.payMonth, pay.payAmount from `payment` as pay INNER JOIN `connections` as con on con.conID = pay.payConID INNER JOIN `customers` as cus on cus.cusID = con.conCusID where cus.cusID = ' . $cus);
        $o = [];
        if ($out) {
            foreach ($out as $it) {
                array_push($o, ["month" => $it->payMonth, "amount" => $it->payAmount]);
            }
        } else {
            $this->setAlertMsg("No history for this daterange!!", WARNING);
        }
        echo json_encode($o);
    }

    public function notifyCustomer($cus)
    {
        $cusInfo = $this->sysModel->getById(TABLE_CUSTOMERS, ['cusID' => $cus, 'cusDeleted' => 0]);
        $this->form_validation->set_rules('mailSub', 'Mail Subject', 'required');
        if ($this->form_validation->run()) {
            $data['due'] = $this->input->post('due');
            $data['lateFee'] = $this->input->post('lateFee');
            $data['custID'] = $cus;
            $data['emplID'] = currentUserID();
            $mailTo = $this->input->post('mailTo');
            $mailSub = $this->input->post('mailSub');
            $mail = '<p> Dear <strong>' . $cusInfo->cusName . '</strong>,<br>';
            $mail .= 'Greetings From ' . systemName() . '. ';
            $mail .= 'This is formal mail of notification.';
            if (is_numeric($data['lateFee'])) {
                $mail .= 'We are sorry to inform you that your <strong>LATE FEE</strong> is- ' . $data['lateFee'];
            }
            $mail .= '<br>' . $this->input->post("mail") . '<br><br>';
            $mail .= 'Regards, <br>' . currentUserName() . '<br>' . systemName() . ' <br>' . SYSTEM_ADDRESS . '</p>';

            $data['mail'] = json_encode(array('mailTo' => $mailTo, 'mailSub' => $mailSub, 'body' => base64_encode($mail)));
            if ($this->sysModel->insertData(TABLE_BILLING, $data)) {
                $res = $this->email
                    ->from($this->userMail)
                    ->reply_to($this->userMail)
                    ->to($mailTo)
                    ->subject($mailSub)
                    ->message($this->emailBody($mailSub, $mail))
                    ->send();
                if ($res)
                    return $this->goToUrl(reportUrl('notify'), 'Mail Sent!!', SUCCESS);
                else
                    return $this->goToReference('Failed to send email!!', DANGER);
            } else
                return $this->goToReference('Failed to add to database!!', DANGER);
        }
        $this->data['cusInfo'] = $cusInfo;
        $this->modalPath(__FUNCTION__);
    }

    public function notify()
    {
        $this->navMeta = ["active" => __FUNCTION__, "pageTitle" => "Notification History", "bc" => array(
            ["url" => sysUrl(), "page" => currentUserName()], ["url" => reportUrl(), "page" => "Notification"],
            ["url" => "", "page" => "Report"]
        )];
        $this->viewPath(__FUNCTION__);
    }

    public function getNotifications()
    {
        $this->datatables->select('b.billID as billID, c.cusName, e.eName, b.mail, b.addTime')
            ->from(TABLE_BILLING . '  as b')
            ->join(TABLE_CUSTOMERS . ' as c', 'c.cusID = b.custID')
            ->join(TABLE_EMPLOYEES . ' as e', 'e.eID = b.emplID')
            ->generate();
        return true;
    }
}