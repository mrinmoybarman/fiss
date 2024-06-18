<?php

class master {

	function fetch_Branches() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM branch;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['bname'] = $r->bname;
				$a[$i]['name'] = $r->name;
				$a[$i]['email'] = $r->email;
				$a[$i]['phone'] = $r->phone;
				$a[$i]['location'] = $r->location;
				$a[$i]['img'] = $r->dp;
				$i++;
			}
		}
		return $a;
	}

	function fetch_FiledVisit() {  //had to added in sidebar
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM `field_visit`;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['institution'] = $r->institution;
				$a[$i]['person'] = $r->person;
				$a[$i]['location'] = $r->location;
				$a[$i]['date'] = $r->date;
				$a[$i]['photo'] = $r->photo;
				$a[$i]['cp_id'] = $r->cp_id;
				$i++;
			}
		}
		return $a;
	}

	function fetch_job_application_by_cp($id) {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM jobapply WHERE `cp`='$id';";
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

	

	function fetch_Client() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM enquiry;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->e_id;
				$a[$i]['name'] = $r->e_name;
				$a[$i]['mail'] = $r->e_mail;
				$a[$i]['phone'] = $r->e_phone;
				$a[$i]['msg'] = $r->e_msg;
				$a[$i]['date'] = $r->e_date;
				$a[$i]['service'] = $r->service;
				$a[$i]['cp'] = $r->cp;
				$i++;
			}
		}
		return $a;
	}

	function find_CP_ID($username) {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM cp WHERE `email` = '$username';";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['name'] = $r->name;
				$a[$i]['email'] = $r->email;
				$a[$i]['phone'] = $r->phone;
				$a[$i]['img'] = $r->dp;
				$a[$i]['branch'] = $r->branch;
				$i++;
			}
		}
		return $a;
	}

	function fetch_CP() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM cp;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['name'] = $r->name;
				$a[$i]['email'] = $r->email;
				$a[$i]['phone'] = $r->phone;
				$a[$i]['img'] = $r->dp;
				$a[$i]['branch'] = $r->branch;
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
				$i++;
			}
		}
		return $a;
	}

	function fetch_clients() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM client;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['name'] = $r->name;
				$a[$i]['thumbnail'] = $r->image;
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
				$i++;
			}
		}
		return $a;
	}
	

	
	function fetch_certificates() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM certificates;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->id;
				$a[$i]['name'] = $r->caption;
				$a[$i]['thumbnail'] = $r->image;
				$i++;
			}
		}
		return $a;
	}

	function fetch_gallery() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM gallery;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->g_id;
				$a[$i]['name'] = $r->caption;
				$a[$i]['thumbnail'] = $r->image;
				$i++;
			}
		}
		return $a;
	}


	function fetch_enquiry() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM enquiry;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->e_id;
				$a[$i]['name'] = $r->e_name;
				$a[$i]['mail'] = $r->e_mail;
				$a[$i]['phone'] = $r->e_phone;
				$a[$i]['msg'] = $r->e_msg;
				$a[$i]['date'] = $r->e_date;
				$a[$i]['service'] = $r->service;
				$i++;
			}
		}
		return $a;
	}


	function fetch_enquiry_by_id($id) {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM enquiry WHERE `e_id` = '$id';";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->e_id;
				$a[$i]['name'] = $r->e_name;
				$a[$i]['mail'] = $r->e_mail;
				$a[$i]['phone'] = $r->e_phone;
				$a[$i]['msg'] = $r->e_msg;
				$a[$i]['date'] = $r->e_date;
				$a[$i]['service'] = $r->service;
				$i++;
			}
		}
		return $a;
	}


	function fetch_Services() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM services;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->s_id;
				$a[$i]['name'] = $r->s_name;
				$a[$i]['details'] = $r->s_details;
				$a[$i]['img'] = $r->s_img;
				$a[$i]['link'] = $r->page_link;
				$i++;
			}
		}
		return $a;
	}
	
	function fetch_Testimoniels() {
		$core=core::getInstance();
		$a=array();
		$i=0;
		$q="SELECT * FROM testimoniels;";
		$stmt=$core->dbh->prepare($q);
		if(!$stmt->execute())print_r($stmt->errorInfo());
		if($stmt->rowCount()>0){
			while($r = $stmt->fetchObject()){
				$a[$i]['id'] = $r->t_id;
				$a[$i]['name'] = $r->t_name;
				$a[$i]['details'] = $r->t_desc;
				$a[$i]['img'] = $r->t_avatar;
				$a[$i]['position'] = $r->t_position;
				$i++;
			}
		}
		return $a;
	}

	
}

?>