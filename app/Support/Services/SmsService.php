<?php
namespace App\Support\Services;

use GuzzleHttp\Client;

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class SmsService{

    private static function ApiClient(){

        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', env('SMS_GATEWAYME_TOKEN'));
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        return $messageClient;
    }

    public static function sendMessage($number, $message){
        try{

            $prepareMessage = new SendMessageRequest([
                'phoneNumber' => $number,
                'message' => $message,
                'deviceId' => (integer) env('SMS_GATEWAYME_DEVICE_ID')
            ]);

            self::ApiClient()->sendMessages([$prepareMessage]);

            return true;
        }catch (Exception $e){
            report($e);
            return false;
        }
    }
}
