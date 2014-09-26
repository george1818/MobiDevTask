<?php
class GitHubCurl implements GitHubHttpClient {

    public $user;
    public $pass;
    public $authType;

    public $response;
    public $headers;
    public $errorNumber;
    public $errorMessage;
    public $httpCode;

    public function request($requestType, $url, $params) {
        $query = utf8_encode(http_build_query($params, '', '&'));

        $set = array();

        if($requestType == 'GET') {
            $url = $url . ($query ? '?' . $query : "");
        } else {
            $set += array(CURLOPT_POSTFIELDS => json_encode($params));
        }

        $set += array(
            CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CUSTOMREQUEST => $requestType,
        );

        switch($this->authType) {
            case GitHubApi::AUTH_HTTP:
                $set += array(CURLOPT_USERPWD => $this -> user . ':' . $this -> pass);
                break;
            case GitHubApi::AUTH_OAUTH:
                $set += array(CURLOPT_HTTPHEADER => array('Authorization: token ' . $this -> user));
                break;
        }

        $url = self::API_URL . $url;
        $curl = curl_init($url);

        curl_setopt_array($curl, $set);

        $this -> response = json_decode(curl_exec($curl));
        $this -> headers = curl_getinfo($curl);
        $this -> errorNumber = curl_errno($curl);
        $this -> errorMessage = curl_error($curl);
        $this -> httpCode = $this -> headers['http_code'];

        curl_close($curl);

        switch($this -> httpCode) {
            case 200:
            case 201:
                return $this -> response;
                break;
            case 401:
                throw new GitHubCommonException('Bad credentials');
                break;
            case 422:
            default:
                throw new GitHubCommonException(json_encode($this -> response));
                break;
        }
    }

}