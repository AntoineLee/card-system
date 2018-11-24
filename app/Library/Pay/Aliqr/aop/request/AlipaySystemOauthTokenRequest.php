<?php
class AlipaySystemOauthTokenRequest { private $code; private $grantType; private $refreshToken; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setCode($sp14e657) { $this->code = $sp14e657; $this->apiParas['code'] = $sp14e657; } public function getCode() { return $this->code; } public function setGrantType($spc57fe5) { $this->grantType = $spc57fe5; $this->apiParas['grant_type'] = $spc57fe5; } public function getGrantType() { return $this->grantType; } public function setRefreshToken($sp88bd1e) { $this->refreshToken = $sp88bd1e; $this->apiParas['refresh_token'] = $sp88bd1e; } public function getRefreshToken() { return $this->refreshToken; } public function getApiMethodName() { return 'alipay.system.oauth.token'; } public function setNotifyUrl($sp9f70c8) { $this->notifyUrl = $sp9f70c8; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp16ae99) { $this->returnUrl = $sp16ae99; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp3fbe16) { $this->terminalType = $sp3fbe16; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($sp130e84) { $this->terminalInfo = $sp130e84; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp031480) { $this->prodCode = $sp031480; } public function setApiVersion($spad1878) { $this->apiVersion = $spad1878; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp6c9cdb) { $this->needEncrypt = $sp6c9cdb; } public function getNeedEncrypt() { return $this->needEncrypt; } }