<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
class Admin{
	private $db;
	private $fm;
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function getAdminData($data){
		$adminUser = $this->fm->validation($data['adminUser']);
		$adminPass = $this->fm->validation($data['adminPass']);
		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, md5($adminPass));				

		// $query = "select * from tbl_admin where adminUser = '$adminUser' and adminPass = '$adminPass'";
		// $result = $this->db->select($query);
		// if($result !=false){
		// 	$value = $result->fetch_assoc();
		// 	Session::init();
		// 	Session::set("adminLogin",true);
		// 	Session::init("adminUser",$value['adminUser']);
		// 	Session::init("adminId",$value['adminId']);
		// 	header("Location:index.php");
			
		// }else{
		// 	$msg = "<span class='error'>Username/Password Not Matched!!!!</span>";
		// 	return $msg;
		// }
		$stmt = $this->db->prepare("SELECT * FROM tbl_admin WHERE adminUser = ? AND adminPass = ?");
		$stmt->bind_param("ss", $adminUser, $adminPass);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$value = $result->fetch_assoc();
			Session::init();
			Session::set("adminLogin", true);
			Session::set("adminUser", $value['adminUser']);
			Session::set("adminId", $value['adminId']);
			header("Location: index.php");
		} else {
			$msg = "<span class='error'>Username/Password Not Matched!!!!</span>";
			return $msg;
		}
		$stmt->close();		
	}
}
?>
<html>
	<head>
	<title>Online Exam System: The Ultimate Test-Taking Solution for Students</title>
	</head>
</html>
