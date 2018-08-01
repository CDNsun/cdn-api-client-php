<?php

require_once './cdn-api-client.php';

$username   = 'u8809648490718';
$password   = '6BfDyH8F2ZNW';
$id         = 91;

$client = new CDNsunCdnApiClient([
                                    'username' => $username, 
                                    'password' => $password,
                                 ]);

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
                 


       