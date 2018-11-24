<?php
include 'AlipayMobilePublicMultiMediaExecute.php'; class AlipayMobilePublicMultiMediaClient { private $DEFAULT_CHARSET = 'UTF-8'; private $METHOD_POST = 'POST'; private $METHOD_GET = 'GET'; private $SIGN = 'sign'; private $timeout = 10; private $serverUrl; private $appId; private $privateKey; private $prodCode; private $format = 'json'; private $sign_type = 'RSA'; private $charset; private $apiVersion = '1.0'; private $apiMethodName = 'alipay.mobile.public.multimedia.download'; private $media_id = 'L21pZnMvVDFQV3hYWGJKWFhYYUNucHJYP3Q9YW13ZiZ4c2lnPTU0MzRhYjg1ZTZjNWJmZTMxZGJiNjIzNDdjMzFkNzkw575'; private $connectTimeout = 3000; private $readTimeout = 15000; function __construct($spacdcbb = '', $sp10881a = '', $sp162fe7 = '', $sp002bbb = '', $spa7721b = 'GBK') { $this->serverUrl = $spacdcbb; $this->appId = $sp10881a; $this->privateKey = $sp162fe7; $this->format = $sp002bbb; $this->charset = $spa7721b; } public function getContents() { $sp1e71ba = array('app_id' => $this->appId, 'method' => $this->METHOD_POST, 'sign_type' => $this->sign_type, 'version' => $this->apiVersion, 'timestamp' => date('Y-m-d H:i:s'), 'biz_content' => '{"mediaId":"' . $this->media_id . '"}', 'charset' => $this->charset); $sp9e4fea = $this->buildGetUrl($sp1e71ba); $spbdf5cf = $sp9e4fea; $sp7a336f = curl_init(); curl_setopt($sp7a336f, CURLOPT_URL, $this->serverUrl); curl_setopt($sp7a336f, CURLOPT_HEADER, TRUE); curl_setopt($sp7a336f, CURLOPT_RETURNTRANSFER, 1); curl_setopt($sp7a336f, CURLOPT_TIMEOUT, $this->timeout); if ($this->METHOD_POST == 'POST') { curl_setopt($sp7a336f, CURLOPT_POST, 1); curl_setopt($sp7a336f, CURLOPT_POSTFIELDS, $spbdf5cf); } $spa55325 = curl_exec($sp7a336f); $spa28cbd = curl_getinfo($sp7a336f, CURLINFO_HTTP_CODE); curl_close($sp7a336f); echo $spa55325; $sp1e71ba = explode('

', $spa55325, 2); $sp74b5a4 = $sp1e71ba[0]; if ($spa28cbd == '200') { $sp5b5e88 = $sp1e71ba[1]; } else { $sp5b5e88 = ''; } return $this->execute($sp74b5a4, $sp5b5e88, $spa28cbd); } public function execute($sp74b5a4 = '', $sp5b5e88 = '', $spa28cbd = '') { $sp20dd88 = new AlipayMobilePublicMultiMediaExecute($sp74b5a4, $sp5b5e88, $spa28cbd); return $sp20dd88; } public function buildGetUrl($sp26c3c2 = array()) { if (!is_array($sp26c3c2)) { } $sp151100 = $this->buildQuery($sp26c3c2); $sp71f730 = ''; $sp13bdb9 = 64; $sp8661d0 = $this->privateKey; $sp57f673 = array(); if (!stripos($sp8661d0, '
')) { $spfae064 = 0; while ($sp80113d = substr($sp8661d0, $spfae064 * $sp13bdb9, $sp13bdb9)) { $sp57f673[] = $sp80113d; $spfae064++; } } else { } $sp8661d0 = '-----BEGIN RSA PRIVATE KEY-----
' . implode('
', $sp57f673); $sp8661d0 = $sp8661d0 . '
-----END RSA PRIVATE KEY-----'; $spd938f4 = openssl_pkey_get_private($sp8661d0, $sp71f730); $spb7f9c9 = ''; if ('RSA2' == $this->sign_type) { openssl_sign($sp151100, $spb7f9c9, $spd938f4, OPENSSL_ALGO_SHA256); } else { openssl_sign($sp151100, $spb7f9c9, $spd938f4, OPENSSL_ALGO_SHA1); } openssl_free_key($spd938f4); $spb7f9c9 = base64_encode($spb7f9c9); $spb7f9c9 = urlencode($spb7f9c9); $sp3cf98d = $sp151100 . '&' . $this->SIGN . '=' . $spb7f9c9; return $sp3cf98d; } public function buildQuery($sp26c3c2) { if (!$sp26c3c2) { return null; } ksort($sp26c3c2); $sp50fc45 = array(); foreach ($sp26c3c2 as $spfcd1b0 => $spd0bf21) { $sp50fc45[] = $spfcd1b0 . '=' . $spd0bf21; } $sp151100 = implode('&', $sp50fc45); return $sp151100; } }