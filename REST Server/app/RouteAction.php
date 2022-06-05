<?php
class RouteAction{
    var $dbtable;
    var $view;
    function __construct()
    {
        $this->dbtable = new PDOFactory();
    }
    function index($request,$response,$args){
        return $response->write("welcome");
    }

    function viewRecords($request,$response,$args){
        $records = $this->dbtable->viewRecords();
      
        $payload = json_encode($records);
       
      
        return $response->withHeader('Content-Type','application/json')->write($payload);

    }
    function SearchRecords($request,$response,$args){
      
        $records = $this->dbtable->searchRecords($args['keyword']);
      
        $payload = json_encode($records);
       
      
        return $response->withHeader('Content-Type','application/json')->write($payload);

    }
    function addRecord($request,$response,$args){
        $data = $request->getBody();
        $record = json_decode($data,1);
     
        $success = $this->dbtable->addRecord($record);
          
        

    }
    function editRecord($request,$response,$args){
        $id = $args['id'];
        $data = $request->getBody();
      
        $record = json_decode($data,1);
    
       
        $this->dbtable->editRecord($record,$id);  
   
      
        

    }
    function deleteRecord($request,$response,$args){
      
       $this->dbtable->deleteRecord($args['id']);
    

    }
   
}