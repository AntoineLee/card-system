<?php
require_once '../lib/WxPay.Api.php'; class MicroPay { public function pay($spfce6ca) { $spc4a98e = WxPayApi::micropay($spfce6ca, 5); if (!array_key_exists('return_code', $spc4a98e) || !array_key_exists('out_trade_no', $spc4a98e) || !array_key_exists('result_code', $spc4a98e)) { echo '接口调用失败,请确认是否输入是否有误！'; throw new WxPayException('接口调用失败！'); } $sp2714cc = $spfce6ca->GetOut_trade_no(); if ($spc4a98e['return_code'] == 'SUCCESS' && $spc4a98e['result_code'] == 'FAIL' && $spc4a98e['err_code'] != 'USERPAYING' && $spc4a98e['err_code'] != 'SYSTEMERROR') { return false; } $spf47fa1 = 10; while ($spf47fa1 > 0) { $sp95ee8d = 0; $sp5cc245 = $this->query($sp2714cc, $sp95ee8d); if ($sp95ee8d == 2) { sleep(2); continue; } else { if ($sp95ee8d == 1) { return $sp5cc245; } else { return false; } } } if (!$this->cancel($sp2714cc)) { throw new WxpayException('撤销单失败！'); } return false; } public function query($sp2714cc, &$sp29bf3b) { $spd29518 = new WxPayOrderQuery(); $spd29518->SetOut_trade_no($sp2714cc); $spc4a98e = WxPayApi::orderQuery($spd29518); if ($spc4a98e['return_code'] == 'SUCCESS' && $spc4a98e['result_code'] == 'SUCCESS') { if ($spc4a98e['trade_state'] == 'SUCCESS') { $sp29bf3b = 1; return $spc4a98e; } else { if ($spc4a98e['trade_state'] == 'USERPAYING') { $sp29bf3b = 2; return false; } } } if ($spc4a98e['err_code'] == 'ORDERNOTEXIST') { $sp29bf3b = 0; } else { $sp29bf3b = 2; } return false; } public function cancel($sp2714cc, $spaacaeb = 0) { if ($spaacaeb > 10) { return false; } $sp0e9a38 = new WxPayReverse(); $sp0e9a38->SetOut_trade_no($sp2714cc); $spc4a98e = WxPayApi::reverse($sp0e9a38); if ($spc4a98e['return_code'] != 'SUCCESS') { return false; } if ($spc4a98e['result_code'] != 'SUCCESS' && $spc4a98e['recall'] == 'N') { return true; } else { if ($spc4a98e['recall'] == 'Y') { return $this->cancel($sp2714cc, ++$spaacaeb); } } return false; } }