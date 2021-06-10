<?php

require '../vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

class EdisFirestore {

    public $db;

    public $docRef;

    public $data;

    public function __construct() {
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.dirname(__FILE__).'/eschool-f2dc1-9087aadf9eea.json');
        $this->db = new FirestoreClient();
    }


    /**
     * Sent content notifications online (in firebase)
     *
     * @param $senderPhoneNumber
     * @param $created_at
     * @param $notificationTitle
     * @param $notificationMessage
     * @param $notificationType
     * @param bool $read
     */
    public function sendNotifications($senderPhoneNumber, $notificationTitle, $notificationMessage, $notificationType, $receiverPhone)
    {
        $data = [
            'created_at' => time() . "",
            'notificationId' => null,
            'notificationMessage' => $notificationMessage,
            'notificationTitle' => $notificationTitle,
            'senderPhoneNumber' => trim($senderPhoneNumber, ' '),
            'notificationType' => $notificationType,
            'read' => false
        ];
        $this->data = $data;
        $docRef = $this->db->collection('notifications')
            ->document($receiverPhone)
            ->collection('userNotifications');
        $this->docRef = $docRef;
        $this->docRef->add($data);
    }

    /**
     * Add on student online
     *
     * @param $studentId
     * @param $firstname
     * @param $lastname
     * @param $sex
     * @param $form
     * @param $formId
     * @param $responsables
     */
    public function addStudent($studentId, $firstname, $lastname, $sex, $form, $formId, $responsables)
    {
        $data = [
            'firstName' => $firstname,
            'form' => $form,
            'formId' => $formId,
            'institution' => 'Institut Polyvalent WAGUE',
            'lastName' => $lastname,
            'responsables' => $responsables,
            'sex' => $sex,
            'studentId' => $studentId
        ];

        $this->data = $data;
        $this->docRef = $this->db->collection("students")
                ->document($studentId);
        $this->docRef->set($this->data);
    }

    public function writeData($type = 'add'){
        if ($type === 'add' || $type == '') {
            $this->docRef->add($this->data);
        }else{
            $this->docRef->set($this->data);
        }
    }
    private function loadEntity($name)
    {
        $nameEntity = $name . 'Entity';
        $entiy = '\\App\\' . $nameEntity;
        $this->$name = new $entiy();
    }

}
