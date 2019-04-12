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
$name='lia';
$res = $models->execute_kw( 
	$db, $uid, $password, 
	'res.partner',  /* object / tabel di odoo */
	'search_read' , /* method yg mau di execusi */
	array(array(array('name','ilike',$name)))
);
echo "<pre>";
// var_dump($res);

foreach ($res as $key => $value) {
	echo "Nama   : " . $value['name'] . "<br/>\n";
	echo "Alamat : " . $value['street'];
	echo "<br/>\n";
}




