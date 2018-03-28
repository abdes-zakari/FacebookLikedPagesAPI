<?php 

 /**
 * 
 */
 class Likes 
 {
   
    private $links=array();
    
    public function getAllLikedPages($access_token) {

       $link='https://graph.facebook.com/me/likes?limit=100&access_token='.$access_token;
       
       $ids=array();

       $allLinks=$this->getLinksRecursive($link);

       $allLinks[]=$link;

       $countLinks=count($allLinks);
       
       for ($i=0; $i <$countLinks ; $i++) { 

           $datas=$this->curl_helper($allLinks[$i]);

           if (isset($datas->data)) {
            
              $datas=$datas->data;
  
               foreach ($datas as $d) {
  
                 $response=array();
  
                 $response[] = $d->id;
  
                 $response[] = $d->name;
  
                 $ids[]    = $response;
             }
           }
       }
       return $ids; 
    }

    public function getLinksRecursive($link) {

       $likes = $this->curl_helper($link);

       if (isset($likes->paging->next)) {

           $this->links[]=$likes->paging->next;

           $this->getLinksRecursive($likes->paging->next);
       }

       return $this->links;
    }


    public function curl_helper($url) {

       $ch = curl_init();

       $timeout = 5;

       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

       curl_setopt($ch, CURLOPT_URL, $url);

       $data = curl_exec($ch);

       curl_close($ch);

       return json_decode($data);
    }
 }