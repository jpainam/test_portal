<?php


class TimetableEntity {
    public $color;
    public $fromTime;
    public $subject;
    public $teacher;
    public $toTime;
    
    public $id;
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

        public function __construct() {
        
    }
    public function getColor() {
        return $this->color;
    }

    public function getFromTime() {
        return $this->fromTime;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getTeacher() {
        return $this->teacher;
    }

    public function getToTime() {
        return $this->toTime;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setFromTime($fromTime) {
        $this->fromTime = $fromTime;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function setTeacher($teacher) {
        $this->teacher = $teacher;
    }

    public function setToTime($toTime) {
        $this->toTime = $toTime;
    }


}
