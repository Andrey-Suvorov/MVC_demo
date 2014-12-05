<?php
Class model_save{
    
    public $description;
    public $fileType;
    public $fileName;

    
    
    public function save($description,$fileType,$fileName){
        global $dbObject;
       	$sql = "SELECT * FROM `extension` WHERE `name` = '$fileType' ";
	$stmt = $dbObject->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if (!$row) {
		$sql = "INSERT INTO `extension` (`name`) VALUES (:fileType)";
		$q = $dbObject->prepare($sql);
		$q->execute(array(':fileType' => $fileType));
		$extensionId = $dbObject->lastInsertId();
	} else {
		$extensionId = $row['id'];			
	}
	
	$sql = "INSERT INTO `file`(`name` , `description` , `extension_id`) VALUES (:fileName, :description, :extensionId)";
	$q = $dbObject->prepare($sql);
	$q->execute(array(
		':fileName' => $fileName,
		':description' => $description,
		':extensionId' => $extensionId
		));
    }
    
}