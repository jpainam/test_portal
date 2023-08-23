<?php

class responsableController extends Controller {

    private $comboCivilite;

    public function __construct() {
        parent::__construct();
        $this->loadModel("civilite");
        $data = $this->Civilite->selectAll();
        $this->comboCivilite = new Combobox($data, "comboCivilite", $this->Civilite->getKey(), $this->Civilite->getLibelle());
    }

    public function index() {
        $view = new View();
        $this->view->clientsJS("responsable" . DS . "index");
        $responsables = $this->Responsable->selectAll();
        $view->Assign("responsables", $responsables);
        $content = $view->Render("responsable" . DS . "index", false);
        $this->Assign("content", $content);
    }

    public function ajaxindex() {
        $json = array();
        $view = new View();

        $r = $this->Responsable->get($this->request->idresponsable);
        $action = $this->request->action;
        switch ($action) {
            case "detail":
                $view->Assign("r", $r);
                $eleves = $this->Responsable->getEleves($this->request->idresponsable);
                $view->Assign("eleves", $eleves);
                $json[0] = $view->Render("responsable" . DS . "ajax" . DS . "detail", false);
                break;
            case "sync":
                $portable = getPhoneNumber($r['PORTABLE']);
                $eleves = $this->Responsable->getEleves($this->request->idresponsable);
                if (!is_null($portable)) {
                    $firebase = new EdisFirestore();
                    $anciens = $firebase->db->collection("users")->document($portable)->collection("students")->documents();
                    foreach ($anciens as $a) {
                        $firebase->db->collection("users")->document($portable)
                                ->collection("students")->document($a->id())->delete();
                    }
                    foreach ($eleves as $el) {
                        $data = array("firstName" => $el['NOM'],
                            "lastName" => $el['PRENOM'],
                            "studentId" => $el['IDELEVE'] . "",
                            "institution" => INSTITUTION_CODE);
                        $firebase->db->collection("users")->document($portable)->collection("students")
                                ->document($el['IDELEVE'] . "")->set($data, ["merge" => true]);
                    }
                    $firebase->db->collection("users")->document($portable)->set(
                            array("phoneNumber" => $portable,
                        "email" => $r['EMAIL']), ["merge" => true]);

                    foreach ($eleves as $el) {
                        if(!is_null($el['IDCLASSE']) && !empty($el['IDCLASSE'])){
                            $data = array("firstName" => $el['NOM'],
                                "lastName" => $el['PRENOM'] . "",
                                "studentId" => $el['IDELEVE'] . "",
                                "institution" => INSTITUTION_CODE . "",
                                'formId' => $el['IDCLASSE'] . "",
                                'form' => strip_tags($el['NIVEAUHTML'])."",
                                "responsables" => array($portable));

                            $firebase->db->collection("students")->document(INSTITUTION_CODE . "")->collection("studentLists")
                                    ->document($el['IDELEVE'] . "")->set($data, ["merge" => true]);
                        }
                    }
                    $json[0] = 1;
                } else {
                    $json[0] = 1;
                }

                break;
            case "delete":
                $this->Responsable->delete($this->request->idresponsable);
                $responsables = $this->Responsable->selectAll();
                $view->Assign("responsables", $responsables);
                $json[0] = $view->Render("responsable" . DS . "ajax" . DS . "liste", false);
                break;
        }

        echo json_encode($json);
    }

    public function delete($id) {
        $this->Responsable->delete($id);
        header("Location:" . Router::url("responsable"));
    }

    public function saisie() {
        //var_dump($this->request); //die();
        if (!empty($this->request->nom)) {
            $acceptsms = (isset($this->request->acceptesms) ? "1" : "0");
            $params = ["civilite" => $this->request->comboCivilite,
                "nom" => $this->request->nom,
                "prenom" => $this->request->prenom,
                "adresse" => $this->request->adresse,
                "bp" => $this->request->bp,
                "portable" => $this->request->portable,
                "telephone" => $this->request->telephone,
                "email" => $this->request->email,
                "profession" => $this->request->profession,
                "acceptesms" => $acceptsms,
                "numsms" => $this->request->numsms,
                "last_sync" => null,
            ];
            $this->Responsable->insert($params);
            header("Location:" . Router::url("responsable"));
        }
        $view = new View();
        $view->Assign("comboCivilite", $this->comboCivilite->view());
        $content = $view->Render("responsable" . DS . "saisie", false);
        $this->Assign("content", $content);
    }

    public function edit($id) {
        if (!empty($this->request->idresponsable)) {
            $acceptsms = (isset($this->request->acceptesms) ? "1" : "0");
            $params = ["civilite" => $this->request->comboCivilite,
                "nom" => $this->request->nom,
                "prenom" => $this->request->prenom,
                "adresse" => $this->request->adresse,
                "bp" => $this->request->bp,
                "portable" => $this->request->portable,
                "telephone" => $this->request->telephone,
                "email" => $this->request->email,
                "profession" => $this->request->profession,
                "acceptesms" => $acceptsms,
                "numsms" => $this->request->numsms,
                "last_sync" => null,
            ];
            $this->Responsable->update($params, ["IDRESPONSABLE" => $this->request->idresponsable]);
            header("Location:" . Router::url("responsable"));
        }
        $view = new View();
        $resp = $this->Responsable->findSingleRowBy(['IDRESPONSABLE' => $id]);
        $this->comboCivilite->selectedid = $resp['CIVILITE'];
        $view->Assign("comboCivilite", $this->comboCivilite->view());
        $view->Assign("resp", $resp);
        $content = $view->Render("responsable" . DS . "edit", false);
        $this->Assign("content", $content);
    }

}
