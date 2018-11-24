<?php
class HttpClient { var $host; var $port; var $path; var $method; var $postdata = ''; var $cookies = array(); var $referer; var $accept = 'text/xml,application/xml,application/xhtml+xml,text/html,text/plain,image/png,image/jpeg,image/gif,*/*'; var $accept_encoding = 'gzip'; var $accept_language = 'en-us'; var $user_agent = 'Incutio HttpClient v0.9'; var $timeout = 20; var $use_gzip = true; var $persist_cookies = true; var $persist_referers = true; var $debug = false; var $handle_redirects = true; var $max_redirects = 5; var $headers_only = false; var $username; var $password; var $status; var $headers = array(); var $content = ''; var $errormsg; var $redirect_count = 0; var $cookie_host = ''; function __construct($sp8ab91b, $spfc0606 = 80) { $this->host = $sp8ab91b; $this->port = $spfc0606; } function get($sp78ff39, $sp151100 = false) { $this->path = $sp78ff39; $this->method = 'GET'; if ($sp151100) { $this->path .= '?' . $this->buildQueryString($sp151100); } return $this->doRequest(); } function post($sp78ff39, $sp151100) { $this->path = $sp78ff39; $this->method = 'POST'; $this->postdata = $this->buildQueryString($sp151100); return $this->doRequest(); } function buildQueryString($sp151100) { $sp0a92f2 = ''; if (is_array($sp151100)) { foreach ($sp151100 as $spfcd1b0 => $sp1f05d8) { if (is_array($sp1f05d8)) { foreach ($sp1f05d8 as $spb1bdc9) { $sp0a92f2 .= urlencode($spfcd1b0) . '=' . $spb1bdc9 . '&'; } } else { $sp0a92f2 .= urlencode($spfcd1b0) . '=' . $sp1f05d8 . '&'; } } $sp0a92f2 = substr($sp0a92f2, 0, -1); } else { $sp0a92f2 = $sp151100; } return $sp0a92f2; } function doRequest() { if (!($sp92610b = @fsockopen($this->host, $this->port, $spa747b3, $speeef5e, $this->timeout))) { switch ($spa747b3) { case -3: $this->errormsg = 'Socket creation failed (-3)'; break; case -4: $this->errormsg = 'DNS lookup failure (-4)'; break; case -5: $this->errormsg = 'Connection refused or timed out (-5)'; break; default: $this->errormsg = 'Connection failed (' . $spa747b3 . ')'; $this->errormsg .= ' ' . $speeef5e; $this->debug($this->errormsg); } return false; } socket_set_timeout($sp92610b, $this->timeout); $spdd9f33 = $this->buildRequest(); $this->debug('Request', $spdd9f33); fwrite($sp92610b, $spdd9f33); $this->headers = array(); $this->content = ''; $this->errormsg = ''; $spfd5804 = true; $spdcbae0 = true; while (!feof($sp92610b)) { $spcb1023 = fgets($sp92610b, 4096); if ($spdcbae0) { $spdcbae0 = false; if (!preg_match('/HTTP\\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $spcb1023, $sp34b113)) { $this->errormsg = 'Status code line invalid: ' . htmlentities($spcb1023); $this->debug($this->errormsg); return false; } $this->status = $sp34b113[2]; $this->debug(trim($spcb1023)); continue; } if ($spfd5804) { if (trim($spcb1023) == '') { $spfd5804 = false; $this->debug('Received Headers', $this->headers); if ($this->headers_only) { break; } continue; } if (!preg_match('/([^:]+):\\s*(.*)/', $spcb1023, $sp34b113)) { continue; } $spfcd1b0 = strtolower(trim($sp34b113[1])); $sp1f05d8 = trim($sp34b113[2]); if (isset($this->headers[$spfcd1b0])) { if (is_array($this->headers[$spfcd1b0])) { $this->headers[$spfcd1b0][] = $sp1f05d8; } else { $this->headers[$spfcd1b0] = array($this->headers[$spfcd1b0], $sp1f05d8); } } else { $this->headers[$spfcd1b0] = $sp1f05d8; } continue; } $this->content .= $spcb1023; } fclose($sp92610b); if (isset($this->headers['content-encoding']) && $this->headers['content-encoding'] == 'gzip') { $this->debug('Content is gzip encoded, unzipping it'); $this->content = substr($this->content, 10); $this->content = gzinflate($this->content); } if ($this->persist_cookies && isset($this->headers['set-cookie']) && $this->host == $this->cookie_host) { $sp6ae7ca = $this->headers['set-cookie']; if (!is_array($sp6ae7ca)) { $sp6ae7ca = array($sp6ae7ca); } foreach ($sp6ae7ca as $sp2aa970) { if (preg_match('/([^=]+)=([^;]+);/', $sp2aa970, $sp34b113)) { $this->cookies[$sp34b113[1]] = $sp34b113[2]; } } $this->cookie_host = $this->host; } if ($this->persist_referers) { $this->debug('Persisting referer: ' . $this->getRequestURL()); $this->referer = $this->getRequestURL(); } if ($this->handle_redirects) { if (++$this->redirect_count >= $this->max_redirects) { $this->errormsg = 'Number of redirects exceeded maximum (' . $this->max_redirects . ')'; $this->debug($this->errormsg); $this->redirect_count = 0; return false; } $sp0b7091 = isset($this->headers['location']) ? $this->headers['location'] : ''; $sp54298b = isset($this->headers['uri']) ? $this->headers['uri'] : ''; if ($sp0b7091 || $sp54298b) { $sp78f833 = parse_url($sp0b7091 . $sp54298b); return $this->get($sp78f833['path']); } } return true; } function buildRequest() { $sp8298e9 = array(); $sp8298e9[] = "{$this->method} {$this->path} HTTP/1.0"; $sp8298e9[] = "Host: {$this->host}"; $sp8298e9[] = "User-Agent: {$this->user_agent}"; $sp8298e9[] = "Accept: {$this->accept}"; if ($this->use_gzip) { $sp8298e9[] = "Accept-encoding: {$this->accept_encoding}"; } $sp8298e9[] = "Accept-language: {$this->accept_language}"; if ($this->referer) { $sp8298e9[] = "Referer: {$this->referer}"; } if ($this->cookies) { $sp2aa970 = 'Cookie: '; foreach ($this->cookies as $spfcd1b0 => $spd0bf21) { $sp2aa970 .= "{$spfcd1b0}={$spd0bf21}; "; } $sp8298e9[] = $sp2aa970; } if ($this->username && $this->password) { $sp8298e9[] = 'Authorization: BASIC ' . base64_encode($this->username . ':' . $this->password); } if ($this->postdata) { $sp8298e9[] = 'Content-Type: application/x-www-form-urlencoded'; $sp8298e9[] = 'Content-Length: ' . strlen($this->postdata); } $spdd9f33 = implode('
', $sp8298e9) . '

' . $this->postdata; return $spdd9f33; } function getStatus() { return $this->status; } function getContent() { return $this->content; } function getHeaders() { return $this->headers; } function getHeader($sp74b5a4) { $sp74b5a4 = strtolower($sp74b5a4); if (isset($this->headers[$sp74b5a4])) { return $this->headers[$sp74b5a4]; } else { return false; } } function getError() { return $this->errormsg; } function getCookies() { return $this->cookies; } function getRequestURL() { $sp78f833 = 'http://' . $this->host; if ($this->port != 80) { $sp78f833 .= ':' . $this->port; } $sp78f833 .= $this->path; return $sp78f833; } function setUserAgent($sp227000) { $this->user_agent = $sp227000; } function setAuthorization($sp0c9ffa, $sp1659fb) { $this->username = $sp0c9ffa; $this->password = $sp1659fb; } function setCookies($sp5764c5) { $this->cookies = $sp5764c5; } function useGzip($sp9a0384) { $this->use_gzip = $sp9a0384; } function setPersistCookies($sp9a0384) { $this->persist_cookies = $sp9a0384; } function setPersistReferers($sp9a0384) { $this->persist_referers = $sp9a0384; } function setHandleRedirects($sp9a0384) { $this->handle_redirects = $sp9a0384; } function setMaxRedirects($sp05f3c8) { $this->max_redirects = $sp05f3c8; } function setHeadersOnly($sp9a0384) { $this->headers_only = $sp9a0384; } function setDebug($sp9a0384) { $this->debug = $sp9a0384; } function quickGet($sp78f833) { $sp5456df = parse_url($sp78f833); $sp8ab91b = $sp5456df['host']; $spfc0606 = isset($sp5456df['port']) ? $sp5456df['port'] : 80; $sp78ff39 = isset($sp5456df['path']) ? $sp5456df['path'] : '/'; if (isset($sp5456df['query'])) { $sp78ff39 .= '?' . $sp5456df['query']; } $sp6684ba = new HttpClient($sp8ab91b, $spfc0606); if (!$sp6684ba->get($sp78ff39)) { return false; } else { return $sp6684ba->getContent(); } } static function quickPost($sp78f833, $sp151100) { $sp5456df = parse_url($sp78f833); $sp8ab91b = $sp5456df['host']; $spfc0606 = isset($sp5456df['port']) ? $sp5456df['port'] : 80; $sp78ff39 = isset($sp5456df['path']) ? $sp5456df['path'] : '/'; $sp6684ba = new HttpClient($sp8ab91b, $spfc0606); if (!$sp6684ba->post($sp78ff39, $sp151100)) { return false; } else { return $sp6684ba->getContent(); } } function debug($sp55c6db, $spb7a0b4 = false) { if ($this->debug) { print '<div style="border: 1px solid red; padding: 0.5em; margin: 0.5em;"><strong>HttpClient Debug:</strong> ' . $sp55c6db; if ($spb7a0b4) { ob_start(); print_r($spb7a0b4); $sp05263d = htmlentities(ob_get_contents()); ob_end_clean(); print '<pre>' . $sp05263d . '</pre>'; } print '</div>'; } } }