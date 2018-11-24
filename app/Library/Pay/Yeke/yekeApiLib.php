<?php
class yekeAPI { function __construct() { } public static function getPayGate() { $sp50fc45 = array('action' => 'getPayType', 'userid' => yeke_USER_ID, 'sign' => md5(yeke_USER_ID . yeke_USER_KEY)); $spc4a98e = HttpClient::quickPost(yeke_API_GATE, $sp50fc45); return $spc4a98e; } public static function getPayType() { $spec1114 = json_decode(self::getPayGate(), true); $sp151100 = array(); if ($spec1114['status']) { foreach ($spec1114['list'] as $spfcd1b0 => $sp1f05d8) { $sp151100[] = array('paytype' => $sp1f05d8['paytype'], 'channelname' => $sp1f05d8['channelname']); } } return $sp151100; } public static function getChannel($spd9e979) { $spec1114 = json_decode(self::getPayGate(), true); $sp151100 = array(); if ($spd9e979 == 'card') { if ($spec1114['status'] && $spec1114['list']) { foreach ($spec1114['list'] as $sp1f05d8) { if ($sp1f05d8['paytype'] == $spd9e979) { foreach ($sp1f05d8['datalist'] as $spfcd1b0 => $spb1bdc9) { $sp151100[] = array('channelid' => $spb1bdc9['channelid'], 'channelname' => $spb1bdc9['channelname'], 'imgurl' => $spb1bdc9['imgurl']); } } } } } else { if ($spec1114['status'] && $spec1114['list']) { foreach ($spec1114['list'] as $sp1f05d8) { if ($sp1f05d8['paytype'] == $spd9e979) { foreach ($sp1f05d8['datalist'] as $spfcd1b0 => $spb1bdc9) { $sp151100[] = array('bankcode' => $spb1bdc9['bankcode'], 'bankname' => $spb1bdc9['bankname'], 'imgurl' => $spb1bdc9['imgurl']); } } } } } return $sp151100; } public static function getCardValue() { $spec1114 = json_decode(self::getPayGate(), true); $sp151100 = array(); if ($spec1114['status'] && $spec1114['list']) { foreach ($spec1114['list'] as $sp1f05d8) { if ($sp1f05d8['paytype'] == 'card') { foreach ($sp1f05d8['datalist'] as $spfcd1b0 => $sp1f05d8) { $sp151100[] = array('channelid' => $sp1f05d8['channelid'], 'channelname' => $sp1f05d8['channelname'], 'cardvalue' => $sp1f05d8['cardvalue'], 'cardlength' => $sp1f05d8['cardlength']); } } } } return $sp151100; } public static function getOrderID() { return date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . rand(100000, 999999); } public function payGate($sp50fc45) { $sp50fc45 = array_merge(array('P_userid' => yeke_USER_ID), $sp50fc45); $sp26d1d6 = $this->makeSign($sp50fc45); $sp50fc45 = array_merge($sp50fc45, array('P_sign' => $sp26d1d6, 'action' => 'payGate')); switch ($sp50fc45['P_paytype']) { case 'bank': case 'alipay': case 'tenpay': case 'weixin': case 'wxwap': case 'sqzf': return $this->payGateBank($sp50fc45); break; case 'card': return $this->payGateCard($sp50fc45); break; default: return 'error,支付方式错误'; } } public function payGateBank($sp50fc45) { $spdeb044 = '<html><head><meta http-equiv="content-type" content="text/html;charset=utf-8"><title>请稍候，正在跳转...</title></head>'; $spdeb044 .= '<body onload="document.pay.submit()">'; $spdeb044 .= '请稍候，正在跳转...'; $spdeb044 .= '<form name="pay" action=' . yeke_API_GATE . ' method="post">'; foreach ($sp50fc45 as $spfcd1b0 => $sp1f05d8) { $spdeb044 .= '<input type="hidden" name="' . $spfcd1b0 . '" value="' . $sp1f05d8 . '">'; } $spdeb044 .= '</body></html>'; return $spdeb044; } public function payGateCard($sp50fc45) { if ($sp50fc45['P_cardnum'] == '' || $sp50fc45['P_cardpwd'] == '' || $sp50fc45['P_cardvalue'] == '') { return 'error,卡信息不完整'; } $spc4a98e = HttpClient::quickPost(yeke_API_GATE, $sp50fc45); return $spc4a98e; } public function makeSign($sp50fc45) { $spdeb044 = ''; foreach ($sp50fc45 as $spfcd1b0 => $sp1f05d8) { $spdeb044 .= $spdeb044 ? '&' : ''; $spdeb044 .= $spfcd1b0 . '=' . $sp1f05d8; } $sp26d1d6 = md5($spdeb044 . yeke_USER_KEY); return $sp26d1d6; } public function verifyNotify() { if (empty($_POST)) { return false; } $_POST['P_productname'] = urlencode($_POST['P_productname']); $_POST['P_productinfo'] = urlencode($_POST['P_productinfo']); $_POST['P_remark'] = urlencode($_POST['P_remark']); $_POST['P_custom_1'] = urlencode($_POST['P_custom_1']); $_POST['P_custom_2'] = urlencode($_POST['P_custom_2']); $_POST['P_contact'] = urlencode($_POST['P_contact']); $sp58283b = $_POST['P_sign']; foreach ($_POST as $spfcd1b0 => $sp1f05d8) { if ($spfcd1b0 == 'P_sign') { unset($_POST['P_sign']); } } $spe7522d = $this->makeSign($_POST); $this->logs($_POST['P_api_orderid'], $_POST, $sp58283b . '=' . $spe7522d); if ($sp58283b == $spe7522d) { return true; } else { return false; } } public function verifyReturn() { if (empty($_GET)) { return false; } $_GET['P_productname'] = urlencode($_GET['P_productname']); $_GET['P_productinfo'] = urlencode($_GET['P_productinfo']); $_GET['P_remark'] = urlencode($_GET['P_remark']); $_GET['P_custom_1'] = urlencode($_GET['P_custom_1']); $_GET['P_custom_2'] = urlencode($_GET['P_custom_2']); $_GET['P_contact'] = urlencode($_GET['P_contact']); $sp58283b = $_GET['P_sign']; foreach ($_GET as $spfcd1b0 => $sp1f05d8) { if ($spfcd1b0 == 'P_sign') { unset($_GET['P_sign']); } } $spe7522d = $this->makeSign($_GET); if ($sp58283b == $spe7522d) { return true; } else { return false; } } public function logs($sp51f7b9, $sp50fc45, $spe7522d) { date_default_timezone_set('PRC'); if (!empty($sp50fc45)) { $spdeb044 = ''; foreach ($sp50fc45 as $spfcd1b0 => $sp1f05d8) { $spdeb044 .= $spdeb044 ? '&' : ''; $spdeb044 .= $spfcd1b0 . '=' . $sp1f05d8; } $sp05263d = date('Y-m-d H:i:s') . '
' . $sp51f7b9 . '
' . $spdeb044 . '
' . $spe7522d . '

........................................

'; $spaf8c2a = 'log'; if (!file_exists($spaf8c2a)) { mkdir($spaf8c2a, 511, true); } $spefa4a1 = yeke_USER_LOG_PREFIX . '-' . date('Y-m-d') . '.txt'; $sp92610b = fopen($spaf8c2a . '/' . $spefa4a1, 'ab'); fwrite($sp92610b, $sp05263d); fclose($sp92610b); } } }