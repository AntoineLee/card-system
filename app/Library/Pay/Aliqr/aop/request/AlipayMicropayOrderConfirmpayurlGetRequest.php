<?php
class AlipayMicropayOrderConfirmpayurlGetRequest { private $alipayOrderNo; private $amount; private $memo; private $receiveUserId; private $transferOutOrderNo; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setAlipayOrderNo($sp3c6bc0) { $this->alipayOrderNo = $sp3c6bc0; $this->apiParas['alipay_order_no'] = $sp3c6bc0; } public function getAlipayOrderNo() { return $this->alipayOrderNo; } public function setAmount($sp6246a9) { $this->amount = $sp6246a9; $this->apiParas['amount'] = $sp6246a9; } public function getAmount() { return $this->amount; } public function setMemo($sp9e5120) { $this->memo = $sp9e5120; $this->apiParas['memo'] = $sp9e5120; } public function getMemo() { return $this->memo; } public function setReceiveUserId($sp9b1d9a) { $this->receiveUserId = $sp9b1d9a; $this->apiParas['receive_user_id'] = $sp9b1d9a; } public function getReceiveUserId() { return $this->receiveUserId; } public function setTransferOutOrderNo($sp5157af) { $this->transferOutOrderNo = $sp5157af; $this->apiParas['transfer_out_order_no'] = $sp5157af; } public function getTransferOutOrderNo() { return $this->transferOutOrderNo; } public function getApiMethodName() { return 'alipay.micropay.order.confirmpayurl.get'; } public function setNotifyUrl($sp9f70c8) { $this->notifyUrl = $sp9f70c8; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp16ae99) { $this->returnUrl = $sp16ae99; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp3fbe16) { $this->terminalType = $sp3fbe16; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($sp130e84) { $this->terminalInfo = $sp130e84; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp031480) { $this->prodCode = $sp031480; } public function setApiVersion($spad1878) { $this->apiVersion = $spad1878; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp6c9cdb) { $this->needEncrypt = $sp6c9cdb; } public function getNeedEncrypt() { return $this->needEncrypt; } }