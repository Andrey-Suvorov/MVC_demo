<?php
// контролер
Class Controller_Index Extends Controller_Base {
	
	// шаблон
	public $layouts = "first_layouts";
	// экшен
	public function index() {
		$class = new model_post();
		$rows = $class->post();
			
		$this->template->vars('rows', $rows);
		$this->template->view('index');
		
	}
	
		echo '<pre>'; print_r(); echo '</pre>'; exit;
		
	public function handler() {
		global $dbObject;
		$destinationPath = getcwd() . DS . 'files' . DS;
		
		if (!is_dir($destinationPath)) {
			exit('нет директории');
		}
		
		$newClass = new model_save();
				
		$newClass->description = $_POST['description'];
		$newClass->description = trim($newClass->description);
		$newClass->description = htmlspecialchars($newClass->description);
		$newClass->description = mysql_escape_string($newClass->description);
		
		$filePath = $_FILES['filename']['tmp_name'];
		$outName = $_FILES['filename']['name'];
		$newClass->fileName = reset(explode(".", $outName));
		$newClass->fileType = end(explode(".", $outName));
				
		$targetPath = $destinationPath . basename($outName);
		@move_uploaded_file($filePath, $targetPath);
		
		$newClass->save($newClass->description, $newClass->fileType, $newClass->fileName);
		
		$nextClass = new model_post();
		$rows = $nextClass->post();
		
		$this->template->vars('rows', $rows);
		$this->template->view('index');
		

		
			
	}
	
	public function edit() {
		global $dbObject; 
		if (isset($_POST['delete'])) {
			$id = $_POST['file_id'];
			$sql = "UPDATE `file` SET `extension_id` = NULL WHERE `id` = :id";
			$stmt = $dbObject->prepare($sql);
			$stmt->bindparam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
						
			header("Location:index.php");			
		} elseif (isset($_POST['edit'])) {
			if (!empty($_POST['new_extension'])) {
				$editClass = new model_edit();
				$editClass->id = $_POST['file_id'];
				$editClass->new_extension = $_POST['new_extension'];				
				$editClass->edit_ext($editClass->id, $editClass->new_extension);				
				
				header("Location:index.php");	
			}
		} else {
			echo '<pre>'; print_r('NO!!!'); echo '</pre>'; exit;
		}	
	}
}