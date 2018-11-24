<?php
require_once 'WxPay.Config.php'; require_once 'WxPay.Exception.php'; class WxPayDataBase { protected $values = array(); public function SetSign() { $sp26d1d6 = $this->MakeSign(); $this->values['sign'] = $sp26d1d6; return $sp26d1d6; } public function GetSign() { return $this->values['sign']; } public function IsSignSet() { return array_key_exists('sign', $this->values); } public function ToXml() { if (!is_array($this->values) || count($this->values) <= 0) { throw new WxPayException('数组数据异常！'); } $sp1eeb26 = '<xml>'; foreach ($this->values as $spfcd1b0 => $sp1f05d8) { if (is_numeric($sp1f05d8)) { $sp1eeb26 .= '<' . $spfcd1b0 . '>' . $sp1f05d8 . '</' . $spfcd1b0 . '>'; } else { $sp1eeb26 .= '<' . $spfcd1b0 . '><![CDATA[' . $sp1f05d8 . ']]></' . $spfcd1b0 . '>'; } } $sp1eeb26 .= '</xml>'; return $sp1eeb26; } public function FromXml($sp1eeb26) { if (!$sp1eeb26) { throw new WxPayException('xml数据异常！'); } libxml_disable_entity_loader(true); $this->values = json_decode(json_encode(simplexml_load_string($sp1eeb26, 'SimpleXMLElement', LIBXML_NOCDATA)), true); return $this->values; } public function ToUrlParams() { $spd48832 = ''; foreach ($this->values as $sp08a7aa => $sp99652d) { if ($sp08a7aa != 'sign' && $sp99652d != '' && !is_array($sp99652d)) { $spd48832 .= $sp08a7aa . '=' . $sp99652d . '&'; } } $spd48832 = trim($spd48832, '&'); return $spd48832; } public function MakeSign() { ksort($this->values); $sp227000 = $this->ToUrlParams(); $sp227000 = $sp227000 . '&key=' . WxPayConfig::KEY; $sp227000 = md5($sp227000); $spc4a98e = strtoupper($sp227000); return $spc4a98e; } public function GetValues() { return $this->values; } } class WxPayResults extends WxPayDataBase { public function CheckSign() { if (!$this->IsSignSet()) { throw new WxPayException('签名错误！'); } $sp26d1d6 = $this->MakeSign(); if ($this->GetSign() == $sp26d1d6) { return true; } throw new WxPayException('签名错误！'); } public function FromArray($sp5764c5) { $this->values = $sp5764c5; } public static function InitFromArray($sp5764c5, $sp9fd932 = false) { $sp20319f = new self(); $sp20319f->FromArray($sp5764c5); if ($sp9fd932 == false) { $sp20319f->CheckSign(); } return $sp20319f; } public function SetData($spfcd1b0, $spd0bf21) { $this->values[$spfcd1b0] = $spd0bf21; } public static function Init($sp1eeb26) { $sp20319f = new self(); $sp20319f->FromXml($sp1eeb26); if ($sp20319f->values['return_code'] != 'SUCCESS') { return $sp20319f->GetValues(); } $sp20319f->CheckSign(); return $sp20319f->GetValues(); } } class WxPayNotifyReply extends WxPayDataBase { public function SetReturn_code($spc248b6) { $this->values['return_code'] = $spc248b6; } public function GetReturn_code() { return $this->values['return_code']; } public function SetReturn_msg($sp82b74d) { $this->values['return_msg'] = $sp82b74d; } public function GetReturn_msg() { return $this->values['return_msg']; } public function SetData($spfcd1b0, $spd0bf21) { $this->values[$spfcd1b0] = $spd0bf21; } } class WxPayUnifiedOrder extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetDevice_info($spd0bf21) { $this->values['device_info'] = $spd0bf21; } public function GetDevice_info() { return $this->values['device_info']; } public function IsDevice_infoSet() { return array_key_exists('device_info', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } public function SetBody($spd0bf21) { $this->values['body'] = $spd0bf21; } public function GetBody() { return $this->values['body']; } public function IsBodySet() { return array_key_exists('body', $this->values); } public function SetDetail($spd0bf21) { $this->values['detail'] = $spd0bf21; } public function GetDetail() { return $this->values['detail']; } public function IsDetailSet() { return array_key_exists('detail', $this->values); } public function SetAttach($spd0bf21) { $this->values['attach'] = $spd0bf21; } public function GetAttach() { return $this->values['attach']; } public function IsAttachSet() { return array_key_exists('attach', $this->values); } public function SetOut_trade_no($spd0bf21) { $this->values['out_trade_no'] = $spd0bf21; } public function GetOut_trade_no() { return $this->values['out_trade_no']; } public function IsOut_trade_noSet() { return array_key_exists('out_trade_no', $this->values); } public function SetFee_type($spd0bf21) { $this->values['fee_type'] = $spd0bf21; } public function GetFee_type() { return $this->values['fee_type']; } public function IsFee_typeSet() { return array_key_exists('fee_type', $this->values); } public function SetTotal_fee($spd0bf21) { $this->values['total_fee'] = $spd0bf21; } public function GetTotal_fee() { return $this->values['total_fee']; } public function IsTotal_feeSet() { return array_key_exists('total_fee', $this->values); } public function SetSpbill_create_ip($spd0bf21) { $this->values['spbill_create_ip'] = $spd0bf21; } public function GetSpbill_create_ip() { return $this->values['spbill_create_ip']; } public function IsSpbill_create_ipSet() { return array_key_exists('spbill_create_ip', $this->values); } public function SetTime_start($spd0bf21) { $this->values['time_start'] = $spd0bf21; } public function GetTime_start() { return $this->values['time_start']; } public function IsTime_startSet() { return array_key_exists('time_start', $this->values); } public function SetTime_expire($spd0bf21) { $this->values['time_expire'] = $spd0bf21; } public function GetTime_expire() { return $this->values['time_expire']; } public function IsTime_expireSet() { return array_key_exists('time_expire', $this->values); } public function SetGoods_tag($spd0bf21) { $this->values['goods_tag'] = $spd0bf21; } public function GetGoods_tag() { return $this->values['goods_tag']; } public function IsGoods_tagSet() { return array_key_exists('goods_tag', $this->values); } public function SetNotify_url($spd0bf21) { $this->values['notify_url'] = $spd0bf21; } public function GetNotify_url() { return $this->values['notify_url']; } public function IsNotify_urlSet() { return array_key_exists('notify_url', $this->values); } public function SetTrade_type($spd0bf21) { $this->values['trade_type'] = $spd0bf21; } public function GetTrade_type() { return $this->values['trade_type']; } public function IsTrade_typeSet() { return array_key_exists('trade_type', $this->values); } public function SetProduct_id($spd0bf21) { $this->values['product_id'] = $spd0bf21; } public function GetProduct_id() { return $this->values['product_id']; } public function IsProduct_idSet() { return array_key_exists('product_id', $this->values); } public function SetOpenid($spd0bf21) { $this->values['openid'] = $spd0bf21; } public function GetOpenid() { return $this->values['openid']; } public function IsOpenidSet() { return array_key_exists('openid', $this->values); } public function SetScene_info($spd0bf21) { $this->values['scene_info'] = $spd0bf21; } public function IsScene_info() { return array_key_exists('scene_info', $this->values); } } class WxPayOrderQuery extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetTransaction_id($spd0bf21) { $this->values['transaction_id'] = $spd0bf21; } public function GetTransaction_id() { return $this->values['transaction_id']; } public function IsTransaction_idSet() { return array_key_exists('transaction_id', $this->values); } public function SetOut_trade_no($spd0bf21) { $this->values['out_trade_no'] = $spd0bf21; } public function GetOut_trade_no() { return $this->values['out_trade_no']; } public function IsOut_trade_noSet() { return array_key_exists('out_trade_no', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } } class WxPayCloseOrder extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetOut_trade_no($spd0bf21) { $this->values['out_trade_no'] = $spd0bf21; } public function GetOut_trade_no() { return $this->values['out_trade_no']; } public function IsOut_trade_noSet() { return array_key_exists('out_trade_no', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } } class WxPayRefund extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetDevice_info($spd0bf21) { $this->values['device_info'] = $spd0bf21; } public function GetDevice_info() { return $this->values['device_info']; } public function IsDevice_infoSet() { return array_key_exists('device_info', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } public function SetTransaction_id($spd0bf21) { $this->values['transaction_id'] = $spd0bf21; } public function GetTransaction_id() { return $this->values['transaction_id']; } public function IsTransaction_idSet() { return array_key_exists('transaction_id', $this->values); } public function SetOut_trade_no($spd0bf21) { $this->values['out_trade_no'] = $spd0bf21; } public function GetOut_trade_no() { return $this->values['out_trade_no']; } public function IsOut_trade_noSet() { return array_key_exists('out_trade_no', $this->values); } public function SetOut_refund_no($spd0bf21) { $this->values['out_refund_no'] = $spd0bf21; } public function GetOut_refund_no() { return $this->values['out_refund_no']; } public function IsOut_refund_noSet() { return array_key_exists('out_refund_no', $this->values); } public function SetTotal_fee($spd0bf21) { $this->values['total_fee'] = $spd0bf21; } public function GetTotal_fee() { return $this->values['total_fee']; } public function IsTotal_feeSet() { return array_key_exists('total_fee', $this->values); } public function SetRefund_fee($spd0bf21) { $this->values['refund_fee'] = $spd0bf21; } public function GetRefund_fee() { return $this->values['refund_fee']; } public function IsRefund_feeSet() { return array_key_exists('refund_fee', $this->values); } public function SetRefund_fee_type($spd0bf21) { $this->values['refund_fee_type'] = $spd0bf21; } public function GetRefund_fee_type() { return $this->values['refund_fee_type']; } public function IsRefund_fee_typeSet() { return array_key_exists('refund_fee_type', $this->values); } public function SetOp_user_id($spd0bf21) { $this->values['op_user_id'] = $spd0bf21; } public function GetOp_user_id() { return $this->values['op_user_id']; } public function IsOp_user_idSet() { return array_key_exists('op_user_id', $this->values); } } class WxPayRefundQuery extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetDevice_info($spd0bf21) { $this->values['device_info'] = $spd0bf21; } public function GetDevice_info() { return $this->values['device_info']; } public function IsDevice_infoSet() { return array_key_exists('device_info', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } public function SetTransaction_id($spd0bf21) { $this->values['transaction_id'] = $spd0bf21; } public function GetTransaction_id() { return $this->values['transaction_id']; } public function IsTransaction_idSet() { return array_key_exists('transaction_id', $this->values); } public function SetOut_trade_no($spd0bf21) { $this->values['out_trade_no'] = $spd0bf21; } public function GetOut_trade_no() { return $this->values['out_trade_no']; } public function IsOut_trade_noSet() { return array_key_exists('out_trade_no', $this->values); } public function SetOut_refund_no($spd0bf21) { $this->values['out_refund_no'] = $spd0bf21; } public function GetOut_refund_no() { return $this->values['out_refund_no']; } public function IsOut_refund_noSet() { return array_key_exists('out_refund_no', $this->values); } public function SetRefund_id($spd0bf21) { $this->values['refund_id'] = $spd0bf21; } public function GetRefund_id() { return $this->values['refund_id']; } public function IsRefund_idSet() { return array_key_exists('refund_id', $this->values); } } class WxPayDownloadBill extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetDevice_info($spd0bf21) { $this->values['device_info'] = $spd0bf21; } public function GetDevice_info() { return $this->values['device_info']; } public function IsDevice_infoSet() { return array_key_exists('device_info', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } public function SetBill_date($spd0bf21) { $this->values['bill_date'] = $spd0bf21; } public function GetBill_date() { return $this->values['bill_date']; } public function IsBill_dateSet() { return array_key_exists('bill_date', $this->values); } public function SetBill_type($spd0bf21) { $this->values['bill_type'] = $spd0bf21; } public function GetBill_type() { return $this->values['bill_type']; } public function IsBill_typeSet() { return array_key_exists('bill_type', $this->values); } } class WxPayReport extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetDevice_info($spd0bf21) { $this->values['device_info'] = $spd0bf21; } public function GetDevice_info() { return $this->values['device_info']; } public function IsDevice_infoSet() { return array_key_exists('device_info', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } public function SetInterface_url($spd0bf21) { $this->values['interface_url'] = $spd0bf21; } public function GetInterface_url() { return $this->values['interface_url']; } public function IsInterface_urlSet() { return array_key_exists('interface_url', $this->values); } public function SetExecute_time_($spd0bf21) { $this->values['execute_time_'] = $spd0bf21; } public function GetExecute_time_() { return $this->values['execute_time_']; } public function IsExecute_time_Set() { return array_key_exists('execute_time_', $this->values); } public function SetReturn_code($spd0bf21) { $this->values['return_code'] = $spd0bf21; } public function GetReturn_code() { return $this->values['return_code']; } public function IsReturn_codeSet() { return array_key_exists('return_code', $this->values); } public function SetReturn_msg($spd0bf21) { $this->values['return_msg'] = $spd0bf21; } public function GetReturn_msg() { return $this->values['return_msg']; } public function IsReturn_msgSet() { return array_key_exists('return_msg', $this->values); } public function SetResult_code($spd0bf21) { $this->values['result_code'] = $spd0bf21; } public function GetResult_code() { return $this->values['result_code']; } public function IsResult_codeSet() { return array_key_exists('result_code', $this->values); } public function SetErr_code($spd0bf21) { $this->values['err_code'] = $spd0bf21; } public function GetErr_code() { return $this->values['err_code']; } public function IsErr_codeSet() { return array_key_exists('err_code', $this->values); } public function SetErr_code_des($spd0bf21) { $this->values['err_code_des'] = $spd0bf21; } public function GetErr_code_des() { return $this->values['err_code_des']; } public function IsErr_code_desSet() { return array_key_exists('err_code_des', $this->values); } public function SetOut_trade_no($spd0bf21) { $this->values['out_trade_no'] = $spd0bf21; } public function GetOut_trade_no() { return $this->values['out_trade_no']; } public function IsOut_trade_noSet() { return array_key_exists('out_trade_no', $this->values); } public function SetUser_ip($spd0bf21) { $this->values['user_ip'] = $spd0bf21; } public function GetUser_ip() { return $this->values['user_ip']; } public function IsUser_ipSet() { return array_key_exists('user_ip', $this->values); } public function SetTime($spd0bf21) { $this->values['time'] = $spd0bf21; } public function GetTime() { return $this->values['time']; } public function IsTimeSet() { return array_key_exists('time', $this->values); } } class WxPayShortUrl extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetLong_url($spd0bf21) { $this->values['long_url'] = $spd0bf21; } public function GetLong_url() { return $this->values['long_url']; } public function IsLong_urlSet() { return array_key_exists('long_url', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } } class WxPayMicroPay extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetDevice_info($spd0bf21) { $this->values['device_info'] = $spd0bf21; } public function GetDevice_info() { return $this->values['device_info']; } public function IsDevice_infoSet() { return array_key_exists('device_info', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } public function SetBody($spd0bf21) { $this->values['body'] = $spd0bf21; } public function GetBody() { return $this->values['body']; } public function IsBodySet() { return array_key_exists('body', $this->values); } public function SetDetail($spd0bf21) { $this->values['detail'] = $spd0bf21; } public function GetDetail() { return $this->values['detail']; } public function IsDetailSet() { return array_key_exists('detail', $this->values); } public function SetAttach($spd0bf21) { $this->values['attach'] = $spd0bf21; } public function GetAttach() { return $this->values['attach']; } public function IsAttachSet() { return array_key_exists('attach', $this->values); } public function SetOut_trade_no($spd0bf21) { $this->values['out_trade_no'] = $spd0bf21; } public function GetOut_trade_no() { return $this->values['out_trade_no']; } public function IsOut_trade_noSet() { return array_key_exists('out_trade_no', $this->values); } public function SetTotal_fee($spd0bf21) { $this->values['total_fee'] = $spd0bf21; } public function GetTotal_fee() { return $this->values['total_fee']; } public function IsTotal_feeSet() { return array_key_exists('total_fee', $this->values); } public function SetFee_type($spd0bf21) { $this->values['fee_type'] = $spd0bf21; } public function GetFee_type() { return $this->values['fee_type']; } public function IsFee_typeSet() { return array_key_exists('fee_type', $this->values); } public function SetSpbill_create_ip($spd0bf21) { $this->values['spbill_create_ip'] = $spd0bf21; } public function GetSpbill_create_ip() { return $this->values['spbill_create_ip']; } public function IsSpbill_create_ipSet() { return array_key_exists('spbill_create_ip', $this->values); } public function SetTime_start($spd0bf21) { $this->values['time_start'] = $spd0bf21; } public function GetTime_start() { return $this->values['time_start']; } public function IsTime_startSet() { return array_key_exists('time_start', $this->values); } public function SetTime_expire($spd0bf21) { $this->values['time_expire'] = $spd0bf21; } public function GetTime_expire() { return $this->values['time_expire']; } public function IsTime_expireSet() { return array_key_exists('time_expire', $this->values); } public function SetGoods_tag($spd0bf21) { $this->values['goods_tag'] = $spd0bf21; } public function GetGoods_tag() { return $this->values['goods_tag']; } public function IsGoods_tagSet() { return array_key_exists('goods_tag', $this->values); } public function SetAuth_code($spd0bf21) { $this->values['auth_code'] = $spd0bf21; } public function GetAuth_code() { return $this->values['auth_code']; } public function IsAuth_codeSet() { return array_key_exists('auth_code', $this->values); } } class WxPayReverse extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetTransaction_id($spd0bf21) { $this->values['transaction_id'] = $spd0bf21; } public function GetTransaction_id() { return $this->values['transaction_id']; } public function IsTransaction_idSet() { return array_key_exists('transaction_id', $this->values); } public function SetOut_trade_no($spd0bf21) { $this->values['out_trade_no'] = $spd0bf21; } public function GetOut_trade_no() { return $this->values['out_trade_no']; } public function IsOut_trade_noSet() { return array_key_exists('out_trade_no', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } } class WxPayJsApiPay extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appId'] = $spd0bf21; } public function GetAppid() { return $this->values['appId']; } public function IsAppidSet() { return array_key_exists('appId', $this->values); } public function SetTimeStamp($spd0bf21) { $this->values['timeStamp'] = $spd0bf21; } public function GetTimeStamp() { return $this->values['timeStamp']; } public function IsTimeStampSet() { return array_key_exists('timeStamp', $this->values); } public function SetNonceStr($spd0bf21) { $this->values['nonceStr'] = $spd0bf21; } public function GetReturn_code() { return $this->values['nonceStr']; } public function IsReturn_codeSet() { return array_key_exists('nonceStr', $this->values); } public function SetPackage($spd0bf21) { $this->values['package'] = $spd0bf21; } public function GetPackage() { return $this->values['package']; } public function IsPackageSet() { return array_key_exists('package', $this->values); } public function SetSignType($spd0bf21) { $this->values['signType'] = $spd0bf21; } public function GetSignType() { return $this->values['signType']; } public function IsSignTypeSet() { return array_key_exists('signType', $this->values); } public function SetPaySign($spd0bf21) { $this->values['paySign'] = $spd0bf21; } public function GetPaySign() { return $this->values['paySign']; } public function IsPaySignSet() { return array_key_exists('paySign', $this->values); } } class WxPayBizPayUrl extends WxPayDataBase { public function SetAppid($spd0bf21) { $this->values['appid'] = $spd0bf21; } public function GetAppid() { return $this->values['appid']; } public function IsAppidSet() { return array_key_exists('appid', $this->values); } public function SetMch_id($spd0bf21) { $this->values['mch_id'] = $spd0bf21; } public function GetMch_id() { return $this->values['mch_id']; } public function IsMch_idSet() { return array_key_exists('mch_id', $this->values); } public function SetTime_stamp($spd0bf21) { $this->values['time_stamp'] = $spd0bf21; } public function GetTime_stamp() { return $this->values['time_stamp']; } public function IsTime_stampSet() { return array_key_exists('time_stamp', $this->values); } public function SetNonce_str($spd0bf21) { $this->values['nonce_str'] = $spd0bf21; } public function GetNonce_str() { return $this->values['nonce_str']; } public function IsNonce_strSet() { return array_key_exists('nonce_str', $this->values); } public function SetProduct_id($spd0bf21) { $this->values['product_id'] = $spd0bf21; } public function GetProduct_id() { return $this->values['product_id']; } public function IsProduct_idSet() { return array_key_exists('product_id', $this->values); } }