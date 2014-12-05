<?php
Class model_edit{
    
    public $id;
    public $newExtension;
    
    
    public function edit_ext($id, $newExtension){
        global $dbObject;
        $sql = "SELECT * FROM `extension` WHERE `name` = :newExtension";
        $stmt = $dbObject->prepare($sql);
        $stmt->bindparam(':newExtension', $newExtension, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
                $sql = "INSERT INTO `extension` (`name`) VALUES (:newExtension)";
                $stmt = $dbObject->prepare($sql);
                $stmt->bindparam(':newExtension', $newExtension, PDO::PARAM_STR);
                $stmt->execute();
                $extensionId = $dbObject->lastInsertId();
        } else {
                $extensionId = $row['id'];			
        }
        
        $sql = "UPDATE `file` SET `extension_id` = :newExtensionId WHERE `id` = :id";				
        $stmt = $dbObject->prepare($sql);
        $stmt->bindparam(':newExtensionId', $extensionId, PDO::PARAM_INT);
        $stmt->bindparam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
}