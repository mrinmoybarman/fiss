<?php

class master {
    
    function fetch_training_application(){
        $core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM training_apply;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['firstname'] = $r->firstname;
				$a[$i]['middlename'] = $r->middlename;
				$a[$i]['lastname'] = $r->lastname;
				$a[$i]['fathersname'] = $r->fathersname;
				$a[$i]['mothersname'] = $r->mothersname;
				$a[$i]['gender'] = $r->gender;
				$a[$i]['meritalstatus'] = $r->meritalstatus;
				$a[$i]['dob'] = $r->dob;
				$a[$i]['vill1'] = $r->vill1;
				$a[$i]['po1'] = $r->po1;
				$a[$i]['ps1'] = $r->ps1;
				$a[$i]['dist1'] = $r->dist1;
				$a[$i]['state1'] = $r->state1;
				$a[$i]['pin1'] = $r->pin1;
				$a[$i]['vill2'] = $r->vill2;
				$a[$i]['po2'] = $r->po2;
				$a[$i]['ps2'] = $r->ps2;
				$a[$i]['dist2'] = $r->dist2;
				$a[$i]['state2'] = $r->state2;
				$a[$i]['pin2'] = $r->pin2;
				$a[$i]['phone1'] = $r->phone1;
				$a[$i]['phone2'] = $r->whatsapp;
				$a[$i]['email'] = $r->email;
				$a[$i]['cv'] = $r->cv;
				$a[$i]['date'] = $r->date;
				$a[$i]['cp'] = $r->cp;
				$a[$i]['remarks'] = $r->remarks;
				$i++;
			}
		}
		return $a;
    }
	
	function fetch_job_application() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM jobapply;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['postname'] = $r->postname;
				$a[$i]['firstname'] = $r->firstname;
				$a[$i]['middlename'] = $r->middlename;
				$a[$i]['lastname'] = $r->lastname;
				$a[$i]['fathersname'] = $r->fathersname;
				$a[$i]['mothersname'] = $r->mothersname;
				$a[$i]['gender'] = $r->gender;
				$a[$i]['meritalstatus'] = $r->meritalstatus;
				$a[$i]['dob'] = $r->dob;
				$a[$i]['vill1'] = $r->vill1;
				$a[$i]['po1'] = $r->po1;
				$a[$i]['ps1'] = $r->ps1;
				$a[$i]['dist1'] = $r->dist1;
				$a[$i]['state1'] = $r->state1;
				$a[$i]['pin1'] = $r->pin1;
				$a[$i]['vill2'] = $r->vill2;
				$a[$i]['po2'] = $r->po2;
				$a[$i]['ps2'] = $r->ps2;
				$a[$i]['dist2'] = $r->dist2;
				$a[$i]['state2'] = $r->state2;
				$a[$i]['pin2'] = $r->pin2;
				$a[$i]['phone1'] = $r->phone1;
				$a[$i]['phone2'] = $r->whatsapp;
				$a[$i]['email'] = $r->email;
				$a[$i]['cv'] = $r->cv;
				$a[$i]['date'] = $r->date;
				$a[$i]['cp'] = $r->cp;
				$a[$i]['remarks'] = $r->remarks;
				$i++;
			}
		}
		return $a;
	}
	
	function fetch_job_application_by_id($id) {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM jobapply WHERE `id`='$id';";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['postname'] = $r->postname;
				$a[$i]['firstname'] = $r->firstname;
				$a[$i]['middlename'] = $r->middlename;
				$a[$i]['lastname'] = $r->lastname;
				$a[$i]['fathersname'] = $r->fathersname;
				$a[$i]['mothersname'] = $r->mothersname;
				$a[$i]['gender'] = $r->gender;
				$a[$i]['meritalstatus'] = $r->meritalstatus;
				$a[$i]['dob'] = $r->dob;
				$a[$i]['vill1'] = $r->vill1;
				$a[$i]['po1'] = $r->po1;
				$a[$i]['ps1'] = $r->ps1;
				$a[$i]['dist1'] = $r->dist1;
				$a[$i]['state1'] = $r->state1;
				$a[$i]['pin1'] = $r->pin1;
				$a[$i]['vill2'] = $r->vill2;
				$a[$i]['po2'] = $r->po2;
				$a[$i]['ps2'] = $r->ps2;
				$a[$i]['dist2'] = $r->dist2;
				$a[$i]['state2'] = $r->state2;
				$a[$i]['pin2'] = $r->pin2;
				$a[$i]['phone1'] = $r->phone1;
				$a[$i]['phone2'] = $r->whatsapp;
				$a[$i]['email'] = $r->email;
				$a[$i]['cv'] = $r->cv;
				$a[$i]['date'] = $r->date;
				$i++;
			}
		}
		return $a;
	}


	function fetch_remark($id) {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM jobapply WHERE id = '$id';";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['remarks'] = $r->remarks;
				$i++;
			}
		}
		return $a;
	}

	function fetch_Visitors() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM visitors;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
		  while($r = $stmt->fetchObject()){
			$a[$i]['id'] = $r->id;
			$a[$i]['name'] = $r->name;
			$a[$i]['phone'] = $r->phone;
			$a[$i]['email'] = $r->email;
			$a[$i]['date'] = date("d-m-Y",strtotime($r->timestamp));
			$a[$i]['time'] = date("h:i:sa",strtotime($r->timestamp));
			$a[$i]['remark'] = $r->remark;
			$i++;
		  }
		}
		return $a;
	}

	function fetch_Visitor($id) {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM visitors;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
		  while($r = $stmt->fetchObject()){
			$a[$i]['id'] = $r->id;
			$a[$i]['name'] = $r->name;
			$a[$i]['phone'] = $r->phone;
			$a[$i]['email'] = $r->email;
			$a[$i]['date'] = date("d-m-Y",strtotime($r->timestamp));
			$a[$i]['time'] = date("h:i:sa",strtotime($r->timestamp));
			$a[$i]['remark'] = $r->remark;
			$i++;
		  }
		}
		return $a;
	}
	
	function fetch_CP_by_id($id) {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM cp WHERE `id` = $id;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['name'] = $r->name;
				$a[$i]['email'] = $r->email;
				$a[$i]['phone'] = $r->phone;
				$a[$i]['img'] = $r->dp;
				$a[$i]['active'] = $r->active;
				$i++;
			}
		}
		return $a;
	}



}

?>