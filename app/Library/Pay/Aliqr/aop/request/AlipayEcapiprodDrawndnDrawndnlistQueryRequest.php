<?php
class AlipayEcapiprodDrawndnDrawndnlistQueryRequest { private $creditNo; private $entityCode; private $entityName; private $isvCode; private $orgCode; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setCreditNo($sp5a81cb) { $this->creditNo = $sp5a81cb; $this->apiParas['credit_no'] = $sp5a81cb; } public function getCreditNo() { return $this->creditNo; } public function setEntityCode($spe72c88) { $this->entityCode = $spe72c88; $this->apiParas['entity_code'] = $spe72c88; } public function getEntityCode() { return $this->entityCode; } public function setEntityName($sp7fe3b7) { $this->entityName = $sp7fe3b7; $this->apiParas['entity_name'] = $sp7fe3b7; } public function getEntityName() { return $this->entityName; } public function setIsvCode($sp21ed7a) { $this->isvCode = $sp21ed7a; $this->apiParas['isv_code'] = $sp21ed7a; } public function getIsvCode() { return $this->isvCode; } public function setOrgCode($spb5ddce) { $this->orgCode = $spb5ddce; $this->apiParas['org_code'] = $spb5ddce; } public function getOrgCode() { return $this->orgCode; } public function getApiMethodName() { return 'alipay.ecapiprod.drawndn.drawndnlist.query'; } public function setNotifyUrl($sp9f70c8) { $this->notifyUrl = $sp9f70c8; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp16ae99) { $this->returnUrl = $sp16ae99; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp3fbe16) { $this->terminalType = $sp3fbe16; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($sp130e84) { $this->terminalInfo = $sp130e84; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp031480) { $this->prodCode = $sp031480; } public function setApiVersion($spad1878) { $this->apiVersion = $spad1878; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp6c9cdb) { $this->needEncrypt = $sp6c9cdb; } public function getNeedEncrypt() { return $this->needEncrypt; } }