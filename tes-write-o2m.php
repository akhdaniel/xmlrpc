<?php
require_once('ripcord/ripcord.php');

$url 	= "http://127.0.0.1:8088";
$db 	= "retail";
$username = "admin";
$password = "1";

/* khusus untuk login, masuk ke /xmlrpc/2/common */

$common = ripcord::client("$url/xmlrpc/2/common");

/* method authenticate utk proses login, return value=user id
jika gagal, return -1 */

$uid = $common->authenticate($db, $username, $password, array());
if ($uid==-1)
	die("gagal koneksi ke ODoo");

var_dump($uid);


$models = ripcord::client($url . '/xmlrpc/2/object');
$name='Odoo Tech';
$res = $models->execute_kw( 
	$db, $uid, $password, 
	'academic.course',  /* object / tabel di odoo */
	'search' ,      /* method yg mau di execusi */
	array(array(array('name','ilike',$name)))
);
echo "<pre>";
// $res adalah [2] atau [1,2,3,4]
$id_course = $res[0];




//[(0,0,{'name':'s1'}),
// (0,0,{'name':'s2'}),
// (0,0,{'name':'s3'})]

$array_sessions = array(
	array(0,0,array('name'=>'8990')),
	array(0,0,array('name'=>'8982')),
	array(0,0,array('name'=>'sfhgfgh3')),
);


$res = $models->execute_kw( 
	$db, $uid, $password, 
	'academic.course',  /* object / tabel di odoo */
	'write' ,       /* method yg mau di execusi */
	array(
		array($id_course), 
		array(
			'responsible_id'=>5,
			'session_ids' => $array_sessions
		)
	)
);

var_dump($res);









