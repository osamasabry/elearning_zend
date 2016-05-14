<?php

class Application_Model_DbTable_Comments extends Zend_Db_Table_Abstract
{

    protected $_name = 'comments';
	

	function listComments(){
		return $this->fetchAll()->toArray();
	}
	
	
	function getCommentById($id_comt){
		return $this->find($id_comt)->toArray();
	}
	function getCommentByMaterialId($id_mat){
		
		return $this->fetchAll($this->select()->where('id_mat=?',$id_mat))->toArray();
	}

	function updateComment($comtInfo,$id_comt){
		return $this->update($comtInfo,'id_comt='.$id_comt);


	}
	function getCommentOfUser($id_mat,$id_user){
		
		return $this->fetchAll($this->select()->where('id_mat=?',$id_mat)->where('id_user=?',$id_user))->toArray();
	}

	function deleteComment($id_comt){
		return $this->delete('id_comt='.$id_comt);
	}


	function addComment($comtInfo){
		$row = $this->createRow();
		$row->contain_comt = $comtInfo['contain_comt'];
		$row->id_user = $comtInfo[0];
		$row->id_mat = $comtInfo[1];
		$row->id_cours = 0;
		return $row->save();
	}

	function getUser($id_comt){
		return $this->find($id_comt)->toArray();
	}


}
