<?php
class AlipayPointOrderGetRequest { private $merchantOrderNo; private $userSymbol; private $userSymbolType; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setMerchantOrderNo($sp828837) { $this->merchantOrderNo = $sp828837; $this->apiParas['merchant_order_no'] = $sp828837; } public function getMerchantOrderNo() { return $this->merchantOrderNo; } public function setUserSymbol($sp7e0dc0) { $this->userSymbol = $sp7e0dc0; $this->apiParas['user_symbol'] = $sp7e0dc0; } public function getUserSymbol() { return $this->userSymbol; } public function setUserSymbolType($sp1ffdeb) { $this->userSymbolType = $sp1ffdeb; $this->apiParas['user_symbol_type'] = $sp1ffdeb; } public function getUserSymbolType() { return $this->userSymbolType; } public function getApiMethodName() { return 'alipay.point.order.get'; } public function setNotifyUrl($sp9f70c8) { $this->notifyUrl = $sp9f70c8; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp16ae99) { $this->returnUrl = $sp16ae99; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp3fbe16) { $this->terminalType = $sp3fbe16; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($sp130e84) { $this->terminalInfo = $sp130e84; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp031480) { $this->prodCode = $sp031480; } public function setApiVersion($spad1878) { $this->apiVersion = $spad1878; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp6c9cdb) { $this->needEncrypt = $sp6c9cdb; } public function getNeedEncrypt() { return $this->needEncrypt; } }