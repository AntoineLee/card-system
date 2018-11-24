<?php
class AlipayAssetAccountUnbindRequest { private $providerId; private $providerUserId; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setProviderId($sp3997a4) { $this->providerId = $sp3997a4; $this->apiParas['provider_id'] = $sp3997a4; } public function getProviderId() { return $this->providerId; } public function setProviderUserId($spd3d2f7) { $this->providerUserId = $spd3d2f7; $this->apiParas['provider_user_id'] = $spd3d2f7; } public function getProviderUserId() { return $this->providerUserId; } public function getApiMethodName() { return 'alipay.asset.account.unbind'; } public function setNotifyUrl($sp9f70c8) { $this->notifyUrl = $sp9f70c8; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp16ae99) { $this->returnUrl = $sp16ae99; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp3fbe16) { $this->terminalType = $sp3fbe16; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($sp130e84) { $this->terminalInfo = $sp130e84; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp031480) { $this->prodCode = $sp031480; } public function setApiVersion($spad1878) { $this->apiVersion = $spad1878; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp6c9cdb) { $this->needEncrypt = $sp6c9cdb; } public function getNeedEncrypt() { return $this->needEncrypt; } }