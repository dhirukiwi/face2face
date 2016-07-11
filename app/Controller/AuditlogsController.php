<?php

class AuditlogsController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
    
    public function saveLogs($logDetails = array()) {
        $this->loadModel('AuditLog');
        $result = false;
        $data['severity'] = isset($logDetails[0]) ? $logDetails[0] : '';
        $data['module'] = isset($logDetails[1]) ? $logDetails[1] : '';
        $data['source'] = isset($logDetails[2]) ? $logDetails[2] : '';
        $data['user'] = isset($logDetails[3]) ? $logDetails[3] : '';
        $data['instanceId'] = isset($logDetails[4]) ? $logDetails[4] : '';
        $data['status'] = isset($logDetails[5]) ? $logDetails[5] : '';
        $data['message'] = isset($logDetails[6]) ? $logDetails[6] : '';
        $data['object'] = isset($logDetails[7]) ? $logDetails[7] : '';
        if($this->AuditLog->save($data)){
            $result = true;
        }
        return $result;
    }
    
    public function test(){
        $this->saveLogs(array('INFO', 'EMR', 'contoller', 'Ravi kumar', '12364564AJSJSJ', 'Active', 'Hello this is new record for test', '{"name":ravi}'));
    }
}

?>
