<?php
namespace App\Library\Geetest; use Illuminate\Support\Facades\Session; class API { private $geetest_conf = null; public function __construct($sp4d5cc2) { $this->geetest_conf = $sp4d5cc2; } public static function get() { $sp0b1598 = new Lib(config('services.geetest.id'), config('services.geetest.key')); $spc7622d = time() . rand(1, 10000); $spb55c72 = $sp0b1598->pre_process($spc7622d); $sp123706 = json_decode($sp0b1598->get_response_str()); Session::put('gt_server', $spb55c72); Session::put('gt_user_id', $spc7622d); return $sp123706; } public static function verify($sp159d2f, $sp0bec1e, $spc98bdb) { $sp0b1598 = new Lib(config('services.geetest.id'), config('services.geetest.key')); $spc7622d = Session::get('gt_user_id'); if (Session::get('gt_server') == 1) { $spc4a98e = $sp0b1598->success_validate($sp159d2f, $sp0bec1e, $spc98bdb, $spc7622d); if ($spc4a98e) { return true; } else { return false; } } else { if ($sp0b1598->fail_validate($sp159d2f, $sp0bec1e, $spc98bdb)) { return true; } else { return false; } } } }