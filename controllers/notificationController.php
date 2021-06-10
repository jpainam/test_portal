<?php

/**
 * 307 : Envoi de SMS
 * 308 : Suivi de SMS
 */
class notificationController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->loadModel("repertoire");
        $this->loadModel("personnel");
        $this->loadModel("classe");
        $this->loadModel("responsableeleve");
        $this->loadModel("messageeleve");
        $this->loadModel("message");
        $this->loadModel("inscription");
        $this->loadModel("eleve");
        $this->loadModel("etablissement");
    }

    public function suivi() {
        if (!isAuth(308)) {
            return;
        }
        $this->view->clientsJS("notification" . DS . "suivi");
        $view = new View();
        $destinataires = $this->Repertoire->getDestinataires();
        $comboDestinataires = new Combobox($destinataires, "comboDestinataires", "PORTABLE", ["NOM", "PORTABLE"]);
        $comboDestinataires->first = "Tous les destinataires";
        $view->Assign("comboDestinataires", $comboDestinataires->view());

        $messages = $this->Notification->selectAll();
        $view->Assign("messages", $messages);
        $tableMessages = $view->Render("notification" . DS . "ajax" . DS . "suivi", false);
        $view->Assign("tableMessages", $tableMessages);
        $content = $view->Render("notification" . DS . "suivi", false);
        $this->Assign("content", $content);
    }

    public function ajaxsuivi() {
        $action = $this->request->action;
        $view = new View();
        $json = array();
        switch ($action) {
            case "supprimerMessageEnvoye":
                $this->Notification->delete($this->request->idmessage);
                $messages = $this->Notification->selectAll();
                break;
            case "filterParDestinataire":
                $destinataire = $this->request->destinataire;
                $datedebut = parseDate($this->request->datedebut);
                $datefin = parseDate($this->request->datefin);
                if (empty($destinataire) && empty($datedebut) && empty($datefin)) {
                    $messages = $this->Notification->selectAll();
                } elseif (!empty($destinataire) && empty($datedebut) && empty($datefin)) {
                    $messages = $this->Notification->findBy(["DESTINATAIRE" => $destinataire]);
                } else {
                    # Obtenir les messages par utilisateurs et pour une duree donnee
                    $messages = $this->Notification->getMessagesBy($destinataire, $datedebut, $datefin);
                }
                break;
        }
        $view->Assign("messages", $messages);
        $json[0] = $view->Render("notification" . DS . "ajax" . DS . "suivi", false);
        echo json_encode($json);
    }

    public function envoi() {
        if (!isAuth(307)) {
            return;
        }
        if (!empty($this->request->message)) {
            $retval = $this->envoiIndividuel();
        } elseif (!empty($this->request->messageparclasse)) {
            $retval = $this->envoiParclasse();
        } elseif (!empty($this->request->messagecollectif)) {
            $retval = $this->envoiCollectif();
        }
        $this->view->clientsJS("notification" . DS . "envoi");
        $view = new View();
        if (isset($retval)) {
            $view->Assign("errors", !$retval);
        }
        $destinataires = $this->Repertoire->getDestinataires();
        $view->Assign("destinataires", $destinataires);

        $parclasse = $this->Classe->selectAll();
        $comboParclasse = new Combobox($parclasse, "parclasse", "IDCLASSE", ["LIBELLE", "NIVEAUSELECT"]);
        $comboParclasse->first = " ";
        $view->Assign("comboParclasse", $comboParclasse->view());

        $content = $view->Render("notification" . DS . "envoi", false);
        $this->Assign("content", $content);
    }

    public function ajaxenvoi() {
        $action = $this->request->action;
        $json = array();
        $view = new View();
        switch ($action) {
            case "envoiIndividuel":
                $this->envoiIndividuel();
                break;
            case "envoiCollectif":
                $this->envoiCollectif();
                break;
            case "envoiClasse":
                $this->envoiParclasse();
                break;
        }
        $json[0] = "Message envoy&eacute; avec succ&egrave;s";
        echo json_encode($json);
    }

    public function envoiIndividuel() {
        if (!empty($this->request->message)) {
            # Envoyer le SMS et rediriger vers la page de suivi de SMS
            $personnel = $this->Personnel->getBy(["USER" => $this->session->iduser]);
            $phone_number = getPhoneNumber($this->request->destinataire);
            if(!empty($phone_number)){
                $message = $this->request->message;
                $params = array(
                    "dateenvoi" => date("Y-m-d H:i:s", time()),
                    "destinataire" => $phone_number,
                    "expediteur" => $personnel['IDPERSONNEL'],
                    "message" => $message,
                    "type" => ENVOIINDIVIDUEL,
                    "subjet" => $this->request->sujet,
                    "last_sync" => null,
                    "anneeacademique" => $this->session->anneeacademique
                );
                //$this->send_notification(array($phone_number), $message, $this->request->sujet);
                $this->Notification->insert($params);
            }
        }
    }

    private function send_notification($phone_numbers, $message, $sujet = "") {
        $firebase = new EdisFirestore();
        $personnel = $this->Personnel->getBy(["USER" => $this->session->iduser]);
        $firebase->db->collection("messages")->add(array(
            "body" => addslashes($message),
            "receivers" => $phone_numbers,
            "sender" => $personnel['NOM'] . ' ' . $personnel['PRENOM'],
            "subject" => addslashes($sujet),
            "created_at" => time() . ""
        ));
        foreach($phone_numbers as $pn){
           $firebase->sendNotifications(
                $personnel['NOM'] . ' ' . $personnel['PRENOM'], addslashes($sujet), addslashes($message), "Message", $pn);
        }
        /* $url =  REMOTE_SERVER . "notif.php";

          $ch = curl_init($url);
          curl_setopt_array($ch, array(
          CURLOPT_HEADER => true,
          CURLOPT_FRESH_CONNECT => true,
          CURLOPT_POST => true,
          //CURLOPT_CONNECTTIMEOUT => 0
          CURLOPT_POSTFIELDS => array(
          "phone_number" => $phone_number,
          "body" =>  $message,
          "type" => "Message personnel",
          "titre" => $sujet
          )
          ));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          $results[] = curl_exec($ch);
          curl_close($ch); */
    }

    public function envoiParclasse() {
        //$this->loadModel("inscription");
        if (!empty($this->request->messageparclasse)) {
            $message = $this->request->messageparclasse;
            $params = array(
                "dateenvoi" => date("Y-m-d H:i:s", time()),
                "expediteur" => $this->getConnectedUser()["IDPERSONNEL"],
                "message" => $message,
                "type" => ENVOIPARCLASSE,
                "subjet" => $this->request->sujet,
                 "anneeacademique" => $this->session->anneeacademique,
            );
            # Get an unique parent if both have numsms
            /*$eleves = $this->Inscription->getInscrits($this->request->parclasse, $this->session->anneeacademique);
            $phone_numbers = array();
            foreach ($eleves as $el) {
                $responsables = $this->Eleve->getResponsables($el['IDELEVE']);
                foreach ($responsables as $resp) {
                    $portable = getPhoneNumber($resp['PORTABLE']);
                    if (!empty($portable)) {
                        $phone_numbers[] = $portable;
                    }
                }
            }*/
            //if(!empty($phone_numbers)){
                $params["destinataire"] = $this->request->parclasse;
                $this->Notification->insert($params);
                //$this->send_notification($phone_numbers, $message, $this->request->sujet);
            //}
        }
        //header("Location:" . Router::url("notification", "suivi"));
    }

    public function envoiCollectif() {
        if (!empty($this->request->messagecollectif)) {
            # Envoyer le SMS et rediriger vers la page de suivi de SMS
            $collectif = $this->request->collectif;
            $collectif_str = "Parent d'eleves";
            # Parent d'eleve
            /*if($collectif == 1){
                $destinataires = $this->Responsableeleve->getResponsablesForCurrentStudent($this->session->anneeacademique);
                $collectif_str = "Parent d'eleves";
            }elseif($collectif == 2){ // Enseignant
                $destinataires = $this->Etablissement->getEnseignants($this->session->anneeacademique);
                 $collectif_str = "Enseignants";
            }elseif($collectif == 3){ // Personnell non enseignant
                $destinataires = $this->Etablissement->getStaffNonEnseignant();
                 $collectif_str = "Non enseignant";
            }
            $phone_numbers = array();
            foreach ($destinataires as $des) {
                 $portable = getPhoneNumber($des['PORTABLE']);
                if (!empty($portable)) {
                    $phone_numbers[] = $portable;
                }
            }*/
            //if(!empty($phone_numbers)){
            //    $this->send_notification($phone_numbers, $this->request->messagecollectif, $this->request->sujet);
                    # Inserer dans la table message envoyes
                $personnel = $this->Personnel->getBy(["USER" => $this->session->iduser]);
                $params = [
                    "dateenvoi" => date("Y-m-d H:i:s", time()),
                    "destinataire" => $collectif_str,
                    "expediteur" => $personnel['IDPERSONNEL'],
                    "type" => ENVOICOLLECTIF,
                    "last_sync" => null,
                     "subjet" => $this->request->sujet,
                    "message" => $this->request->messagecollectif,
                      "anneeacademique" => $this->session->anneeacademique
                ];
                $this->Notification->insert($params);
            }
            
        }
        //header("Location:" . Router::url("notification", "suivi"));
    //}

}
