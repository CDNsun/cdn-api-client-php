# Client library for CDNsun CDN API

SYSTEM REQUIREMENTS

* PHP >=5.4
* PHP curl

USAGE

```
require_once '/path-to-the-library/CDNsunCdnApiClient.php';

$client = new CDNsunCdnApiClient([
                                    'username' => 'YOUR_API_USERNAME', 
                                    'password' => 'YOUR_API_PASSWORD',
                                 ]);

$response = $client->get([   
                            'url'   => 'cdns/ID/reports',
                            'data'  => [
                                            'type'      =>  'GB',
                                            'period'    =>  '4h',
                                       ],
                         ]);

$response = $client->post([   
                            'url'   => 'cdns/ID/purge',
                            'data'  => [
                                            'purge_paths'      =>  [ 
                                                                        '/path1.img',
                                                                        '/path2.img', 
                                                                   ]        
                                       ],
                         ]);
```

NOTES

* The ID stands for a CDN service ID, it is an integer number, eg. 123

API DOCUMENTATION

https://cdnsun.com/knowledgebase/api

CONTACT

* W: https://cdnsun.com
* E: info@cdnsun.com  