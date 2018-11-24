<?php
class AlipayMobilePublicAccountResetRequest { private $agreementId; private $bindAccountNo; private $bizContent; private $displayName; private $fromUserId; private $realName; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setAgreementId($sp4c9717) { $this->agreementId = $sp4c9717; $this->apiParas['agreement_id'] = $sp4c9717; } public function getAgreementId() { return $this->agreementId; } public function setBindAccountNo($spfdd88d) { $this->bindAccountNo = $spfdd88d; $this->apiParas['bind_account_no'] = $spfdd88d; } public function getBindAccountNo() { return $this->bindAccountNo; } public function setBizContent($spd4f863) { $this->bizContent = $spd4f863; $this->apiParas['biz_content'] = $spd4f863; } public function getBizContent() { return $this->bizContent; } public function setDisplayName($sp69ddae) { $this->displayName = $sp69ddae; $this->apiParas['display_name'] = $sp69ddae; } public function getDisplayName() { return $this->displayName; } public function setFromUserId($sp29f90c) { $this->fromUserId = $sp29f90c; $this->apiParas['from_user_id'] = $sp29f90c; } public function getFromUserId() { return $this->fromUserId; } public function setRealName($spbac9fd) { $this->realName = $spbac9fd; $this->apiParas['real_name'] = $spbac9fd; } public function getRealName() { return $this->realName; } public function getApiMethodName() { return 'alipay.mobile.public.account.reset'; } public function setNotifyUrl($sp9f70c8) { $this->notifyUrl = $sp9f70c8; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp16ae99) { $this->returnUrl = $sp16ae99; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp3fbe16) { $this->terminalType = $sp3fbe16; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($sp130e84) { $this->terminalInfo = $sp130e84; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp031480) { $this->prodCode = $sp031480; } public function setApiVersion($spad1878) { $this->apiVersion = $spad1878; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp6c9cdb) { $this->needEncrypt = $sp6c9cdb; } public function getNeedEncrypt() { return $this->needEncrypt; } }