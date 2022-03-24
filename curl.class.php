<?php
class MoyskladPhp {
	protected $BasicToken = null;
	public function __construct() {
		$loginName = 'loginName:loginPassword';
		$this->BasicToken = base64_encode($loginName);
	}
  
  public function getAccessToken() {
		$headers = array(
		   "Authorization: Basic $this->BasicToken",
		   "Content-Length: 0",
		);
		$url = "https://online.moysklad.ru/api/remap/1.2/security/token";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$resp = curl_exec($curl);
		curl_close($curl);
		$token = json_decode($resp, true);
		return $token['access_token'];
	}
}  
