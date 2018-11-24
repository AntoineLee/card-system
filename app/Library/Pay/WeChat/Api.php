<?php
namespace App\Library\Pay\WeChat; use App\Library\Helper; use App\Library\Pay\ApiInterface; use Illuminate\Support\Facades\Log; class Api implements ApiInterface { private $url_notify = ''; private $url_return = ''; public function __construct($sp403bd7) { $this->url_notify = SYS_URL_API . '/pay/notify/' . $sp403bd7; $this->url_return = SYS_URL . '/pay/return/' . $sp403bd7; } function goPay($sp4d5cc2, $sp2714cc, $spc644e5, $sp5b5e88, $sp9d9f48) { $sp6246a9 = $sp9d9f48; $sp486342 = strtoupper($sp4d5cc2['payway']); $this->defineWxConfig($sp4d5cc2); require_once __DIR__ . '/lib/WxPay.Api.php'; require_once 'WxPay.NativePay.php'; require_once 'wxLog.php'; $sp572401 = new \NativePay(); $sp02dbf9 = new \WxPayUnifiedOrder(); $sp02dbf9->SetBody($spc644e5); $sp02dbf9->SetAttach($sp2714cc); $sp02dbf9->SetOut_trade_no($sp2714cc); $sp02dbf9->SetTotal_fee($sp6246a9); $sp02dbf9->SetTime_start(date('YmdHis')); $sp02dbf9->SetTime_expire(date('YmdHis', time() + 600)); $sp02dbf9->SetGoods_tag('pay'); $sp02dbf9->SetNotify_url($this->url_notify); $sp02dbf9->SetTrade_type($sp486342); if ($sp486342 === 'MWEB') { $sp02dbf9->SetScene_info('{"h5_info": {"type":"Wap","wap_url": "' . SYS_URL . '","wap_name": "发卡平台"}}'); } $sp02dbf9->SetProduct_id($sp2714cc); $sp02dbf9->SetSpbill_create_ip(Helper::getIP()); function getResultUrl($sp2714cc, $spc4a98e, $spfcd1b0) { if (!isset($spc4a98e[$spfcd1b0])) { Log::error('Pay.WeChat.goPay, order_no:' . $sp2714cc . ', error:' . json_encode($spc4a98e)); if (isset($spc4a98e['err_code_des'])) { throw new \Exception($spc4a98e['err_code_des']); } if (isset($spc4a98e['return_msg'])) { throw new \Exception($spc4a98e['return_msg']); } throw new \Exception('获取支付数据失败'); } return $spc4a98e[$spfcd1b0]; } if ($sp486342 === 'NATIVE') { $spc4a98e = $sp572401->GetPayUrl($sp02dbf9); $sp78f833 = getResultUrl($sp2714cc, $spc4a98e, 'code_url'); header('location: /qrcode/pay/' . $sp2714cc . '/wechat?url=' . urlencode($sp78f833)); } elseif ($sp486342 === 'MWEB') { $spc4a98e = $sp572401->GetH5PayUrl($sp02dbf9); $sp78f833 = getResultUrl($sp2714cc, $spc4a98e, 'mweb_url'); echo view('utils.redirect', array('url' => $sp78f833)); } die; } private function defineWxConfig($sp4d5cc2) { if (!defined('wx_APPID')) { define('wx_APPID', $sp4d5cc2['APPID']); } if (!defined('wx_MCHID')) { define('wx_MCHID', $sp4d5cc2['MCHID']); } if (!defined('wx_KEY')) { define('wx_KEY', $sp4d5cc2['KEY']); } if (!defined('wx_APPSECRET')) { define('wx_APPSECRET', $sp4d5cc2['APPSECRET']); } } function verify($sp4d5cc2, $spae1cf8) { $sp5c532f = isset($sp4d5cc2['isNotify']) && $sp4d5cc2['isNotify']; $this->defineWxConfig($sp4d5cc2); require_once __DIR__ . '/lib/WxPay.Api.php'; require_once 'wxLog.php'; if ($sp5c532f) { return (new PayNotifyCallBack($spae1cf8))->Handle(false); } else { $sp2714cc = @$sp4d5cc2['out_trade_no']; $sp02dbf9 = new \WxPayOrderQuery(); $sp02dbf9->SetOut_trade_no($sp2714cc); $spc4a98e = \WxPayApi::orderQuery($sp02dbf9); if (array_key_exists('trade_state', $spc4a98e) && $spc4a98e['trade_state'] == 'SUCCESS') { call_user_func_array($spae1cf8, array($spc4a98e['out_trade_no'], $spc4a98e['total_fee'], $spc4a98e['transaction_id'])); return true; } else { return false; } } } }