<?php

class model_post {
                
    public function post() {
        global $dbObject;
        $sql = "SELECT file.id AS file_id,file.name AS file_name, extension.id AS ext_id, extension.name AS ext_name
                FROM `file`
                LEFT JOIN `extension` ON file.extension_id = extension.id
                ORDER by file_id DESC";
        $stmt = $dbObject->prepare($sql);
        $stmt->execute();
        $rows = array();
       
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $row;
        }
       return $rows;  
    }
}





