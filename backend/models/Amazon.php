<?php
/**
 * Created by PhpStorm.
 * User: vladyslavdzyhar
 * Date: 30.10.17
 * Time: 21:57
 */

namespace backend\models;


class Amazon
{

    function getProductByASIN($asin){
        date_default_timezone_set('UTC');

        $url = 'http://webservices.amazon.de/onca/xml?';
        $ch = curl_init();
        $secret = 'AKIAIN4I5FALO4URFNSA';

        $data = array(
            'Service' => 'AWSECommerceService',
            'AssociateTag' => 'bridge-rating-21',
            'AWSAccessKeyId' => $secret,
            'Operation' => 'ItemLookup',
            'ItemId' => $asin,
            'ResponseGroup' => 'Large',
            'Version' => '2013-08-01',
            'Timestamp' => date(\DateTime::ISO8601)."Z", //'[YYYY-MM-DDThh:mm:ssZ]',
        );

        ksort($data);

        $string = http_build_query($data);
        $string = "GET\nwebservices.amazon.de\n/onca/xml\n".$string;
        $sig = hash_hmac('sha256', $string, 'rlysJT49Xo1QjTCWIjh2wvmUh5+1ECpA1/ovMtMZ', true);
        $sig = base64_encode($sig);
        $data['Signature'] = $sig;

        curl_setopt($ch, CURLOPT_URL, $url . http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        $response = curl_exec($ch);
        //$xml=simplexml_load_string($response);

        return $response;
    }

}