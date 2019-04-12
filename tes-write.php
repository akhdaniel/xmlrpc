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


/* khusus untuk login, masuk ke /xmlrpc/2/object */

$models = ripcord::client($url . '/xmlrpc/2/object');
$name='julia';
$res = $models->execute_kw( 
	$db, $uid, $password, 
	'res.partner',  /* object / tabel di odoo */
	'search' ,      /* method yg mau di execusi */
	array(array(array('name','ilike',$name)))
);
echo "<pre>";
// $res adalah [2] atau [1,2,3,4]
$id_partner = $res[0];

$res = $models->execute_kw( 
	$db, $uid, $password, 
	'res.partner',  /* object / tabel di odoo */
	'write' ,       /* method yg mau di execusi */
	array(
		array($id_partner), 
		array(
			'email' =>'julia@gmail.com',
			'phone' =>'09808329832',
			'street'=>'Surapati Core',
		)
	)
);

var_dump($res);









