<?php

/**
 *
 * @ Author kiwitech India
 * @ Created date 11 July 2015
 * @ Modified date 11 July 2015
 * */

class LogsComponent extends Component {
    
    
    /*
     * Name: saveLogs
     * Description: This function used to add the logs into database. 
     * Params: @array
     * Return: @boolean
     * created By: Ravi kumar
     * Created Date: 11 July 2016
     * Modified By:
     * Modified Date:
     */
    
    public function saveLogs($logDetails = array()){
        $auditLogs = ClassRegistry::init('AuditLog');
        $result = false;
        
        $data['severity'] = isset($logDetails[0]) ? $logDetails[0] : '';
        $data['module'] = isset($logDetails[1]) ? $logDetails[1] : '';
        $data['source'] = isset($logDetails[2]) ? $logDetails[2] : '';
        $data['user'] = isset($logDetails[3]) ? $logDetails[3] : '';
        $data['instanceId'] = isset($logDetails[4]) ? $logDetails[4] : '';
        $data['status'] = isset($logDetails[5]) ? $logDetails[5] : '';
        $data['message'] = isset($logDetails[6]) ? $logDetails[6] : '';
        $data['query'] = isset($logDetails[7]) ? $logDetails[7] : '';
        $data['object'] = isset($logDetails[8]) ? $logDetails[8] : '';
                
        if($auditLogs->save($data)){
            $result = true;
        }
        return $result;
    }
    
    /*
     * Name: getAllLogs
     * Description: This function used to get the all logs.
     * Params: @array
     * Return: @boolean
     * created By: Ravi kumar
     * Created Date: 11 July 2016
     * Modified By:
     * Modified Date:
     */
    
    public function getAllLogs(){
        $auditLogs = ClassRegistry::init('AuditLog');
        return $auditLogs->find('all');
    }


    /*public function test(){
        $this->saveLogs(array('INFO', 'EMR', 'contoller', 'Ravi kumar', '12364564AJSJSJ', 'Active', 'Hello this is new record for test', '{"name":ravi}', 'select * from auditlogs'));
    }*/
}
