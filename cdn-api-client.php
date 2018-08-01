<?php

// version 1.0.0
        
class CDNsunCdnApiClient
{    
    private $username   = null;
    private $password   = null;            
    
    public function __construct(array $options = null) 
    {
        if(empty($options))
        {
            throw new Exception('$options empty');
        }               
        if(empty($options['username']))
        {
            throw new Exception('$options[username] empty');
        }
        if(empty($options['password']))
        {
            throw new Exception('$options[password] empty');
        }  
        
        $this->username = $options['username'];
        $this->password = $options['password'];
    }
    
    public function get(array $options = null)
    {
        if(empty($options))
        {
            throw new Exception('$options empty');
        }               
        $options['method'] = 'GET';
        return $this->request($options);                
    } 
    
    public function post(array $options = null)
    {
        if(empty($options))
        {
            throw new Exception('$options empty');
        }               
        $options['method'] = 'POST';
        return $this->request($options);                
    }
    
    public function put(array $options = null)
    {
        if(empty($options))
        {
            throw new Exception('$options empty');
        }               
        $options['method'] = 'PUT';
        return $this->request($options);                
    }    
    
    public function delete(array $options = null)
    {
        if(empty($options))
        {
            throw new Exception('$options empty');
        }               
        $options['method'] = 'DELETE';
        return $this->request($options);                
    }
    
    private function request(array $options = null)
    {
        if(empty($options))
        {
            throw new Exception('$options empty');
        }
        if(empty($options['url']))
        {
            throw new Exception('$options[url] empty');
        }
        if(empty($options['method']))
        {
            throw new Exception('$options[method] empty');
        }
        
        $curl = curl_init();
        
        switch($options['method'])
        {                        
            case 'POST':
            case 'post':    
                curl_setopt($curl, CURLOPT_POST, 1);
                if(!empty($options['data']))
                {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($options['data']));
                }
                break;
            case 'PUT':
            case 'put':    
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT'); 
                if(!empty($options['data']))
                {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($options['data']));		
                }
                break;
            case 'DELETE':
            case 'delete':    
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE'); 
                if(!empty($options['data']))
                {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($options['data']));		
                }
                break;    
            case 'GET':
            case 'get':    
                if(!empty($options['data']))
                {
                    $options['url'] = sprintf('%s?%s', $options['url'], http_build_query($options['data']));
                }
                break;
            default: throw new Exception('Unsupported method: ' . $options['method']); 
        }
        
        // exchange format JSON
        $headers = array(
                            'Accept: application/json',
                            'Content-Type: application/json',
                        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->username . ':' . $this->password);

        // API endpoint
        $url_beginning = 'https://cdnsun.com/api/';
        if(substr($options['url'], 0, strlen($url_beginning)) !== $url_beginning)
        {
            $options['url'] = $url_beginning . $options['url'];
        }
        curl_setopt($curl, CURLOPT_URL, $options['url']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);

        // API call
        $response_body      = curl_exec($curl);
        $response_info      = curl_getinfo($curl);
        $response_error     = curl_error($curl);
	curl_close($curl);         
        
        if(empty($response_body) || !empty($response_error))
        {
            throw new Exception('curl error. response_body: ' . $response_body . 
                                          ', response_info: ' . $response_info . 
                                          ', response_error: ' . $response_error);
        }
        
        $response_body_decoded = json_decode($response_body, true);        
        if(json_last_error() !== JSON_ERROR_NONE)
        {
            throw new Exception('json_decode response_body error. response_body: ' . $response_body . 
                                                               ', response_info: ' . $response_info . 
                                                               ', response_error: ' . $response_error);
        }
        
        return $response_body_decoded;
    }            
}

                 


       