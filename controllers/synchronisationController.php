<?php

class synchronisationController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->loadModel("punition");
        $this->loadModel("emplois");
        $this->loadModel("manuelscolaire");
        $this->loadModel("absenceperiodique");
        $this->loadModel("eleve");
        $this->loadModel("note");
        $this->loadModel("responsable");
    }

    public function index() {
        //$firestore->readData();
        $this->view->clientsJS("synchronisation" . DS . "index");
        $view = new View();
        $synchronisations = $this->Synchronisation->selectAll();
        $view->Assign("synchronisations", $synchronisations);
        $content = $view->Render("synchronisation" . DS . "index", false);
        $this->Assign("content", $content);
    }

    public function ajax() {
        $action = $this->request->action;
        $view = new View();
        $json = array();
        switch ($action) {
            case "manuels":
                
                break;
            case "synchronisation":
                /*$students = json_encode($this->Eleve->selectAllInscrit());
                $this->send_data_to_remote_server(array("students" => $students));
                
                $responsables = json_encode($this->Responsable->getResponsablesDesInscrits());
                $this->send_data_to_remote_server(array("responsables" => $responsables));
                */
                //$notes = json_encode($this->Note->getNotesAnneeEnCours());
                //$this->send_data_to_remote_server(array("notes" => $notes));
                
                //$manuels = json_encode($this->Manuelscolaire->getManuelAnneeAcademique());
                //$this->send_data_to_remote_server(array("manuels" => $manuels));
                
                //$absences = json_encode($this->Absenceperiodique->selectAll());
                //$bulletin = json_encode(array());

                //$punitions = json_encode($this->Punition->selectAll());
                //$finances = json_encode(array());

                //$emploisdutemps = json_encode($this->Emplois->selectAll());
                //$convocations = json_encode(array());

                
                //$this->send_data_to_remote_server(array("absences" => $absences));
                //$this->send_data_to_remote_server(array("bulletin" => $bulletin));
                //$this->send_data_to_remote_server(array("punitions" => $punitions));
                //$this->send_data_to_remote_server(array("finances" => $finances));
                //$this->send_data_to_remote_server(array("emplois" => $emploisdutemps));
                //$this->send_data_to_remote_server(array("convocations" => $convocations));
                //
                
                $this->Synchronisation->insert(array(
                    "datesynchronisation" => date("Y-m-d H:i:s", time()),
                    "realiserpar" => $this->getConnectedUser()['IDPERSONNEL']
                ));
                 $synchronisations = $this->Synchronisation->selectAll();
                $view->Assign("synchronisations", $synchronisations);
                $json[0] = $view->Render("synchronisation" . DS . "ajax" . DS . "index", false);
                break;
        }
        echo json_encode($json);
    }

    public function send_data_to_remote_server($data) {
        $url = REMOTE_SERVER . "synchronize.php";
        try{
            $ch = curl_init($url);
            if ($ch === false) {
                throw new Exception('failed to initialize curl');
            }
            curl_setopt_array($ch, array(
                CURLOPT_HEADER => true,
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_POST => true,
                //CURLOPT_CONNECTTIMEOUT => 0
                CURLOPT_POSTFIELDS => $data
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            $result = curl_exec($ch);
            if ($result === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }else{
                //var_dump($result);
            }
            curl_close($ch);
        } catch(Exception $e) {
            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);
        }
    }

}
