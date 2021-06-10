<?php
require '../vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;


class EdisStorage {
    public $storage;
    public $bucket;
    
    
   public function __construct() {
       putenv('GOOGLE_APPLICATION_CREDENTIALS='.dirname(__FILE__).'/eschool-f2dc1-9087aadf9eea.json');
       $this->storage = new StorageClient();
       $this->bucket = $this->storage->bucket('eschool-f2dc1.appspot.com');
   }
   
   public function upload($data, $options = array()){
       $this->bucket->upload($data, $options);
   }
}
