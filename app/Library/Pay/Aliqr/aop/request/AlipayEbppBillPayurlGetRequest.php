<?php
class AlipayEbppBillPayurlGetRequest { private $alipayOrderNo; private $callbackUrl; private $merchantOrderNo; private $orderType; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setAlipayOrderNo($sp3c6bc0) { $this->alipayOrderNo = $sp3c6bc0; $this->apiParas['alipay_order_no'] = $sp3c6bc0; } public function getAlipayOrderNo() { return $this->alipayOrderNo; } public function setCallbackUrl($sp7944fd) { $this->callbackUrl = $sp7944fd; $this->apiParas['callback_url'] = $sp7944fd; } public function getCallbackUrl() { return $this->callbackUrl; } public function setMerchantOrderNo($sp828837) { $this->merchantOrderNo = $sp828837; $this->apiParas['merchant_order_no'] = $sp828837; } public function getMerchantOrderNo() { return $this->merchantOrderNo; } public function setOrderType($sp30ba31) { $this->orderType = $sp30ba31; $this->apiParas['order_type'] = $sp30ba31; } public function getOrderType() { return $this->orderType; } public function getApiMethodName() { return 'alipay.ebpp.bill.payurl.get'; } public function setNotifyUrl($sp9f70c8) { $this->notifyUrl = $sp9f70c8; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp16ae99) { $this->returnUrl = $sp16ae99; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp3fbe16) { $this->terminalType = $sp3fbe16; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($sp130e84) { $this->terminalInfo = $sp130e84; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp031480) { $this->prodCode = $sp031480; } public function setApiVersion($spad1878) { $this->apiVersion = $spad1878; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp6c9cdb) { $this->needEncrypt = $sp6c9cdb; } public function getNeedEncrypt() { return $this->needEncrypt; } }