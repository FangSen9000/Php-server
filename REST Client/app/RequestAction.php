<?php
require __DIR__."/../vendor/autoload.php";
use GuzzleHttp\Client;
class RequestAction{
    var $client;
    public function __construct(){
        $this->client = new Client(['base_uri'=>
        'http://localhost/server/']);

    }
    function index(){
        $uri = '';
        $response = $this->client->get($uri);
        // $records = json_decode($response->getBody()->
        // getContents(),true);
        // echo "<h1>welcome to client</h1>";
    }
    function viewRecords(){
        $uri = 'ebookings';
        $response= $this->client->get($uri);
        
        return json_decode($response->getBody()->getContents(),true);
        
        }
    function searchRecords($keyword){
        $uri = "ebookings/keyword/$keyword"; 
        include_once 'app\view\searchRecords.php';
        $response= $this->client->get($uri);
        $records= json_decode($response->getBody()->getContents(),true);   
        return $records;
       
    }
    function addRecord($list)

    {   
        $uri = 'ebookings';
        $record = json_encode($list);
        $request = $this->client->post(
            $uri,
            [
                'content-type' => 'application/json',
                'json' => $record,
            ],
        );
       
      
       
    }
    function editRecord($list,$id)
    {
        $uri = "ebookings/$id";
        $record = json_encode($list);
        $response = $this->client->put(
            $uri,
            [
                'content-type' => 'application/json',
                'json' => $record,
            ],
        );
    }
    function deleteRecord($id)
    {
        $uri = "ebookings/$id";
        $response= $this->client->delete($uri);
    }
    

    
}