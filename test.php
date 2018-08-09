<?php

require_once './cdn-api-client.php';

$username   = 'YOUR_API_USERNAME';
$password   = 'YOUR_API_PASSWORD';
$id         = 'YOUR_CDN_SERVICE_ID';

$client = new CDNsunCdnApiClient([
                                    'username' => $username, 
                                    'password' => $password,
                                 ]);

$response = $client->get([   
                            'url'   => 'cdns',                            
                         ]);
var_dump($response);

$response = $client->get([   
                            'url'   => 'cdns/' . $id . '/reports',
                            'data'  => [
                                            'type'      =>  'GB',
                                            'period'    =>  '4h',
                                       ],
                         ]);
var_dump($response);   

$response = $client->post([   
                            'url'   => 'cdns/' . $id . '/purge',
                            'data'  => [
                                            'purge_paths'      =>  [ 
                                                                        '/path1.img',
                                                                        '/path2.img', 
                                                                   ]        
                                       ],
                         ]);
var_dump($response); 
                 


       