<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
function getCountries($con){
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT distinct do_location FROM dos order by do_location asc";
            if ($result=$con->QUERY_RUN($con,$sql)){
                while($row = $result->fetch_object()){
                        $tempArray = $row;
                        array_push($resultArray, $row);
                    }
            }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}



function allcontent($con){
    $pid=$_GET['pid'];
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT *  FROM comment  where pid=$pid order by id desc";
            if ($result=$con->QUERY_RUN($con,$sql)){
                while($row = $result->fetch_object()){
                        $uid2=$row->uid;
                        $sqlUser="SELECT *  FROM users where user_id=$uid2";
                        $resultuser=$con->QUERY_RUN($con,$sqlUser);
                        $rowuser = $resultuser->fetch_object();
                        $row->user_name=$rowuser->user_name;
                        $tempArray = $row;
                        array_push($resultArray, $row);
                    }
            }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}
function insertcontent($con){
  $uid=$_GET['uid'];
  $content=$_GET['content'];
  $pid=$_GET['pid'];
  if(!$uid) $uid=1000;
  if(strcmp($uid,"null")==0) $uid=1000;  
  if(strcmp($uid,"undefined")==0) $uid=1000;   
  $comment_id=$con->GET_MAX_COL('comment','id');
  $date=date('l jS \of F Y h:i:s A');
  $sql = "insert into comment values ($comment_id,'$content', $uid,$pid)";

  if ($result=$con->QUERY_RUN($con,$sql)	)
        echo('[{"commited":"1"}]');
  else  echo('[{"commited":"0"}]');
}
  
function coinMarket($con){
    $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
    $parameters = [
    'start' => '1',
    'limit' => '5000',
    'convert' => 'USD'
    ];

    $headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: 9a2ef209-a620-4c05-b94f-e09bf3cb120f'
    ];
    $qs = http_build_query($parameters); // query string encode the parameters
    $request = "{$url}?{$qs}"; // create the request URL


    $curl = curl_init(); // Get cURL resource
    // Set cURL options
    curl_setopt_array($curl, array(
    CURLOPT_URL => $request,            // set the request URL
    CURLOPT_HTTPHEADER => $headers,     // set the headers 
    CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
    ));

    $response = curl_exec($curl); // Send the request, save the response
    print_r(json_decode($response)); // print json decoded response
    curl_close($curl); // Close request
}

function getPerfumer($con){
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT distinct perfumer FROM colors_dos order by perfumer asc";
            if ($result=$con->QUERY_RUN($con,$sql)){
                while($row = $result->fetch_object()){
                        $tempArray = $row;
                        array_push($resultArray, $row);
                    }
            }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}

function getScentGroup($con){
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT distinct scentGroup FROM colors_dos order by scentGroup asc";
            if ($result=$con->QUERY_RUN($con,$sql)){
                while($row = $result->fetch_object()){
                        $tempArray = $row;
                        array_push($resultArray, $row);
                    }
            }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}


function getScent($con){
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT distinct scent FROM `colors_dos` ORDER BY `colors_dos`.`scent` ASC";
        if ($result=$con->QUERY_RUN($con,$sql)){
            while($row = $result->fetch_object()){
                    $tempArray = $row;
                    array_push($resultArray, $row);
                }
        }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}

function getScentType($con){
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT distinct nature as scentType FROM dos order by nature asc";
            if ($result=$con->QUERY_RUN($con,$sql)){
                while($row = $result->fetch_object()){
                        $tempArray = $row;
                        array_push($resultArray, $row);
                    }
            }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}

function getsex($con){
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT distinct sex FROM colors_dos order by sex asc";
            if ($result=$con->QUERY_RUN($con,$sql)){
                while($row = $result->fetch_object()){
                        $tempArray = $row;
                        array_push($resultArray, $row);
                    }
            }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}

function fetchCountry($con){
    $resultArray = array();
    $tempArray = array();

    $sql="SELECT name FROM country";
    if ($result=$con->QUERY_RUN($con,$sql)){
    while($row = $result->fetch_object()){
                        
                        $tempArray = $row;
                        array_push($resultArray, $row);
    }
    }

    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}

function type_to_type_id($con,$type){
    $sql = "SELECT * from services_type where service_type_etitle='$type'";
    if ($result=$con->QUERY_RUN($con,$sql)){
    $row = $result->fetch_object();
    }
    return ($row->service_type_id);
    }

    function fn_resize($image_resource_id,$width,$height) {
    $target_width =200;
    $target_height =200;
    $target_layer=imagecreatetruecolor($target_width,$target_height);
    imagecopyresampled($target_layer,$image_resource_id,0,0,0,0,$target_width,$target_height, $width,$height);
    return $target_layer;
}

function imgUpload($con){
    $user_id=$_GET['user_id'];
    $do_id=$_GET['do_id'];    
    $folderPath = "../";
    $file_names = $_FILES["file"]["name"];
    $file=$file_names;
    for ($i = 0; $i < 4; $i++) {

        $file_name=$file_names[$i];
        $extension = end(explode(".", $file_name));
        $original_file_name = pathinfo($file_name, PATHINFO_FILENAME);
        $file_url = $original_file_name . "-" . date("YmdHis") . "." . $extension;
        $pathDir ="../users/".$user_id;
        if ( ! is_dir($pathDir)) {
            mkdir($pathDir);
        }
        $pathDir ="../users/".$user_id."/".$do_id;
        if ( ! is_dir($pathDir)) {
        mkdir($pathDir);
        }

        $folderPath=$pathDir."/".(1+$i).".jpg";echo $folderPath;
        move_uploaded_file($_FILES["file"]["tmp_name"][$i], $folderPath);
    }
  }
  

function intoDos($con){ 
$perfumer=$_GET['perfumer']; 
$scentBranch=$_GET['scentBranch']; 
$commentFa=$_GET['commentFA'];    
$comment=$_GET['comment'];  
$scentGroup=$_GET['scentGroup']; 
if(!$scentGroup)
$scentGroup=$_GET['sex'];  
$sex=$_GET['sex']; 
$type=$_GET['type']; 
$made=$_GET['made']; 
$subject=$_GET['subject']; 
$size=$_GET['size']; 
$scent=$_GET['scent'];   
$price=$_GET['price']; 
$certificate=$_GET['certificate'];
$brand=$_GET['brand'];
$comment=$_GET['comment'];
$count=$_GET['count']; 
$color="#".$_GET['color'];
$sx=$_GET['sex']; 
$type_id= type_to_type_id($con,$type);
$sql = "SELECT * from services where service_title='$subject'"; 
$result=$con->QUERY_RUN($con,$sql);	
$resultArray = array();
$tempArray = array();
if (!$row = $result->fetch_object()){
$service_id=$con->GET_MAX_COL('services','service_id');
$sql = "insert into services(service_id,service_title,service_etitle,service_type_id,service_active) values($service_id,'$subject','$subject',$type_id,1)";  
$result=$con->QUERY_RUN($con,$sql);
}
else{ 
$service_id=$row->service_id;
}
$do_id=$con->GET_MAX_COL('dos','do_id');
if(strcmp($city,"null")==0) $city=33000;
$sqlInsert = "insert into dos 
(do_id,user_id,service_id,do_price,do_location,do_type_comm,do_certificate,brands,do_active,sx,nature,do_look,do_attach,comment) 
values($do_id,1,$service_id,'$price','$made','$comment',$certificate,'$brand',1,'$sx','$scent',25,'$comment','$commentFa')";
$result=$con->QUERY_RUN($con,$sqlInsert);	
$color_dos_id=$con->GET_MAX_COL('colors_dos','color_dos_id');
$sqlInsert = "insert into colors_dos values($color_dos_id,$do_id,'$color','$size',$count,'$sex','$scentGroup','$perfumer','$scentBranch')";
$result=$con->QUERY_RUN($con,$sqlInsert);  
echo '[{"do_id":'.$do_id.'}]';
}
 

function getSizes($con){
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT distinct size FROM colors_dos order by size asc";
            if ($result=$con->QUERY_RUN($con,$sql)){
                while($row = $result->fetch_object()){
                        $tempArray = $row;
                        array_push($resultArray, $row);
                    }
            }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}


function limitPrd($con){
    $sort=$_GET['sort'];
    $limit=$_GET['limit'];
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT * FROM dos INNER JOIN services on dos.service_id=services.service_id order by $sort  limit 0,$limit";
    if ($result=$con->QUERY_RUN($con,$sql)){
        while($row = $result->fetch_object()){    
            $do_id=$row->do_id;
            $sql_size="SELECT * FROM colors_dos where do_id=$do_id";
            $result_size=$con->QUERY_RUN($con,$sql_size);
            $row_size = $result_size->fetch_object();
            $row->sizes=$row_size->size;
            $row->perfumer=$row_size->perfumer;
            $row->scentGroup=$row_size->scentGroup;
            $row->sex=$row_size->sex;
            if(strcmp($row->sizes,"1")==0)  $row->sizes="100 ml";
            if(strcmp($row->sizes,"2")==0)  $row->sizes="50 ml";
            if(strcmp($row->sizes,"3")==0)  $row->sizes="Tester";
            $row->price_after=$row->do_price-($row->do_price*$row->do_certificate/100);
            $row->AED=intval($row->do_price/6800);
            $row->AED_after=intval($row->price_after/6800);
            $row->USD=intval($row->do_price/24000);
            $row->USD_after=intval($row->price_after/24000);    
            $tempArray = $row;
            array_push($resultArray, $row);
        }
        }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}

function caroselPageOne($con){
    $sort=$_GET['sort'];
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT * FROM dos INNER JOIN services on dos.service_id=services.service_id order by $sort";
    if ($result=$con->QUERY_RUN($con,$sql)){
        while($row = $result->fetch_object()){    
            $do_id=$row->do_id;
            $sql_size="SELECT * FROM colors_dos where do_id=$do_id";
            $result_size=$con->QUERY_RUN($con,$sql_size);
            $row_size = $result_size->fetch_object();
            $row->sizes=$row_size->size;
            $row->perfumer=$row_size->perfumer;
            $row->scentGroup=$row_size->scentGroup;
            $row->sex=$row_size->sex;
            
            $row->dos_sizeEx=$row_size->size;
            if(strcmp($row->sizes,"1")==0)  $row->sizes="100 ml";
            if(strcmp($row->sizes,"2")==0)  $row->sizes="50 ml";
            if(strcmp($row->sizes,"3")==0)  $row->sizes="Tester";
            $row->price_after=$row->do_price-($row->do_price*$row->do_certificate/100);
            if(strcmp($row->sx,"SPORT")==0)
            $row->sx_new="MEN/WOMEN";
            else
            $row->sx_new=$row->sx;   
            $row->Eservice=$row->service_etitle;   
            
            $row->AED=intval($row->do_price/6800);
            $row->AED_after=intval($row->price_after/6800);
            $row->USD=intval($row->do_price/24000);
            $row->USD_after=intval($row->price_after/24000);                        
            $tempArray = $row;
            array_push($resultArray, $row);
            }
        }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}



function userEditNew($con){
    $uid=$_GET['user_id'];
    $name=$_GET['Name'];$adrs=$_GET['adrs'];$mobile=$_GET['Mobile'];$pass=$_GET['Password'];
    $sql = "update users set user_name='$name',user_adrs='$adrs',user_pass='$pass'
    ,user_phone='$mobile'where user_id=$uid"; 
    if ($result=$con->QUERY_RUN($con,$sql)	)
    echo('[{"userEdit":"1"}]');
    else
        echo('[{"userEdit":"0"}]');
}


function userWishlistCount($con){
    $uid=$_GET['uid'];
    $sql="SELECT count(*) as counts FROM wishlist where user_id=$uid";
    if ($result=$con->QUERY_RUN($con,$sql))    $row = $result->fetch_object();
    if($row->counts) echo('[{"count":"'. $row->counts.'"}]');
    else echo('[{"count":"0"}]');      
}
  
  
function Campaigns($con){
$uid=$_GET['uid']; 
$campId=$_GET['campId'];
if(strcmp($campId,"do_certificate")==0)
 $sql="SELECT * FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id where city_id!=3300 and do_active=1 
 order by do_certificate descin
 limit 0,10";
 else
 if(strcmp($campId,"simil")==0){
 $doid=$_GET['doid'];
 similDoid($doid,$con,0);
 }
   else
 if(strcmp($campId,"brand")==0){
 $doid=$_GET['doid'];
 similDoid($doid,$con,1);
 } 
   else
 if(strcmp($campId,"scent")==0){
 $doid=$_GET['doid'];
 similDoid($doid,$con,2);
 }  else
 if(strcmp($campId,"price")==0){
 $doid=$_GET['doid'];
 similDoid($doid,$con,4);
 }
  else
 if(strcmp($campId,"do_id")==0)
 $sql="SELECT * FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id where city_id!=3300 and do_active=1 
 order by do_id desc
 limit 0,10
 " ;
 else
 if(strcmp($campId,"do_look")==0)
 $sql="SELECT * FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id where city_id!=3300 and do_active=1 
 order by do_look desc
 limit 0,10
 " ;
 else
 $sql="SELECT * FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id where city_id!=3300 and do_active=1 and do_campaign=$campId
 limit 0,10
 " ;


if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $len=0;
    while($row = $result->fetch_object()){
      $row->AED=intval($row->price_after/6800);
      $row->AED_after=intval($row->do_price/6800);
      $row->USD=intval($row->price_after/24000);
      $row->USD_after=intval($row->price_after/24000);  
      $len++;
      $sId=$row->service_id;
      $uId=$row->user_id;
      $doId=$row->do_id;
      $row->dos_escent=$row->nature;
      if(strcmp($row->nature,"تند"))
      $row->dos_escent="Spicy";else
      if(strcmp($row->nature,"شیرین"))
      $row->dos_escent="Sweet";else
      if(strcmp($row->nature,"گرم"))
      $row->dos_escent="Warm";else
      if(strcmp($row->nature,"میوه ای"))
      $row->dos_escent="Fruit";else
      if(strcmp($row->nature,"جنگلی"))
      $row->dos_escent="Jungle";else    
      if(strcmp($row->nature,"تلخ"))
      $row->dos_escent="spicy";else
      if(strcmp($row->nature,"چوبی"))
      $row->dos_escent="Wood";else
      if(strcmp($row->nature,"خنک"))
      $row->dos_escent="Cold";else
      if(strcmp($row->nature,"ملایم"))
      $row->dos_escent="Soft";
      $row->Eservice=$row->service_etitle;   
      $sql_service = "select * from wishlist where do_id=$doId and user_id=$uid";//echo $sql_service;
      if ($result_service=$con->QUERY_RUN($con,$sql_service)){
        $rowwishlist = $result_service->fetch_object();
        $row->wishlist_exists =$rowwishlist->wishlist_id ;
        if(!$rowwishlist->wishlist_id)$row->wishlist_exists=0;
        else
        if($rowwishlist->wishlist_id)$row->wishlist_exists=1;
        
      }
    $colorString="00000000000000000000";
    $sql_service = "select * from colors_dos where do_id=$doId";
    if ($result_service=$con->QUERY_RUN($con,$sql_service))
    while($rowColors = $result_service->fetch_object()){  
      $index=$rowColors->color_id;
      $colorString[$index-1]='1';
      if($row->likesCount==0) $row->likesCount=1;
    }
    $sizeString="0000000";
    $sql_service = "select distinct size from colors_dos where do_id=$doId";
    $indexSize=0;
    if ($result_service=$con->QUERY_RUN($con,$sql_service))
    while($rowSizes = $result_service->fetch_object()){  
     $rsize=$rowSizes->size;
     if((strcmp($rsize,"1")==0))  $sizeString[0]=1;
     if((strcmp($rsize,"2")==0))  $sizeString[1]=1;
     if((strcmp($rsize,"3")==0))  $sizeString[2]=1;
     if((strcmp($rsize,"4")==0))  $sizeString[3]=1;
     if((strcmp($rsize,"5")==0))  $sizeString[4]=1;
     if((strcmp($rsize,"6")==0))  $sizeString[5]=1;
     if((strcmp($rsize,"7")==0))  $sizeString[6]=1;
    }
    $row->sizeString=$sizeString;
    $sql_service = "select count(*) as likesCount from likes where user_id1=$uId and service_id=$sId";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
		  $rowCountLike = $result_service->fetch_object();
		  $row->likesCount =$rowCountLike->likesCount ;
		  if($row->likesCount==0) $row->likesCount=1;
    }
    $sql_service = "select sum(like_rate) as likesRate from likes where user_id1=$uId and service_id=$sId";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
		  $rowSumRate = $result_service->fetch_object();
		  $row->likesRate =$rowSumRate->likesRate ;
		  if(!$rowSumRate->likesRate) $row->likesRate=1;
	  }
    $sql_service = "select avg(like_rate) as userRate from likes where user_id1=$uId";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
		$rowSumRate = $result_service->fetch_object();
		$row->user_rate =intval($rowSumRate->userRate);
		if($row->user_rate==0 ) $row->user_rate=1;
	    }
        $sql_service = "SELECT * FROM services where service_id='$sId'";
            if ($result_service=$con->QUERY_RUN($con,$sql_service)){
		$row_service = $result_service->fetch_object();
		$row->service=$row_service->service_title;
		$row->Eservice=$row_service->service_etitle;
		$TID=$row_service->service_type_id;
	    }
	    
	    $sql_service = "SELECT * FROM services_type where service_type_id=$TID";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $row_service = $result_service->fetch_object();
            $row->BRNID=$row_service->service_branch_id;
            $BRNID=$row_service->service_branch_id;
	    }
   	    $sId=$row->user_id;
        $sql_service = "SELECT * FROM users where user_id='$sId'";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $row_service = $result_service->fetch_object();
            $row->user=$row_service->user_name." ".$row_service->user_family;
            $row->userEcommerce=$row_service->user_name;
            $row->userEcommerceMalek=$row_service->user_family;
            $row->user_prof=$row_service->user_prof;
            $row->user_phone=$row_service->user_phone;
            $row->user_mobile=$row_service->user_mobile;
            $row->user_year=$row_service->user_year;
            $row->user_comm=$row_service->user_comm;
            $row->user_age=$row_service->user_age;
            $row->user_email=$row_service->user_email	;
            $row->user_sex=$row_service->user_sx;
            $row->user_adrs=$row_service->user_adrs;
            $row->user_meli=$row_service->user_meli;
            $row->user_pic=$row_service->user_pic;
            $row->user_active=$row_service->user_active;
	    }
	   $row->rateLikeCount=$row->likesRate/$row->likesCount;
       $row->price_after=$row->do_price-($row->do_price*$row->do_certificate/100);
       $row->price_after=strval($row->price_after);
       $row->brands=$row->brands;
       $tempArray = $row;
       $row->colorString=$colorString;
       array_push($resultArray, $tempArray);
    }
    $finalArray = array();
    for($i=0;$i<$len;$i++){

    if((strcmp($picFilter,"undefined")==0)||($resultArray[$i]->user_pic=="1")){ 
    if((!$userAge)||($resultArray[$i]->user_age<=$userAge)){
            if((!$rateLikeCount)||($resultArray[$i]->user_rate>=$rateLikeCount)){
                if((!$userSex)||(strcmp($resultArray[$i]->user_sex,$userSex)==0)){
                if($resultArray[$i]->user_active==1){
        array_push($finalArray, $resultArray[$i]);
    }}}}}
    }
    $t=json_encode($finalArray);
    if(strlen($t)!=2)  echo $t;
    else echo('[{"do_id":"0"}]');
    }
   }


function SubmitGoogle($con){
  $email=$_GET['email'];
  $name=$_GET['name'];

  $sql = "SELECT * FROM users where user_email='$email'";  
  $result=$con->QUERY_RUN($con,$sql);	
  $resultArray = array();
  $tempArray = array();
  if (!$row = $result->fetch_object()){
        $id=$con->GET_MAX_COL('users','user_id');
        $sql="insert into users(user_id,`user_name`,`user_email`) values($id,'$name','$email')";
        if ($result=$con->QUERY_RUN($con,$sql)){
            $sql = "SELECT * FROM users where user_email='$email'";
            if ($result=$con->QUERY_RUN($con,$sql)){
                $resultArray = array();
                $tempArray = array();
                while($row = $result->fetch_object()){
                    $tempArray = $row;
                    array_push($resultArray, $tempArray);
                }
                $t=json_encode($resultArray);
                if(strlen($t)!=2)  echo $t;
            }        
        }
  }
  else { 
  $sql = "SELECT * FROM users where user_email='$email'";
  if ($result=$con->QUERY_RUN($con,$sql)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){ 
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    $t=json_encode($resultArray);
  }
   if(strlen($t)!=2)  {  echo $t;  } 
}
}

function getSizeByDoID($con,$doId){
$resultArray = array();
$tempArray = array();
$sql_b="SELECT *  FROM `colors_dos` WHERE do_id=".$doId;//echo $sql_b;
        if ($result_b=$con->QUERY_RUN($con,$sql_b)){
            while($row_b = $result_b->fetch_object()){    
                     return ($row_b->size);
                }
        }

}

function searchNgDos($con){
    $word=$_GET['word'];   
    $sql = "select * from services 
    inner JOIN dos
    on dos.service_id=services.service_id
    inner JOIN colors_dos
    ON colors_dos.do_id=dos.do_id
    where  
    `services`.`service_title` like '%$word%' or  `services`.`service_etitle` like '%$word%' or 
    `dos`.`do_location` like '%$word%' or `dos`.`brands` like '%$word%'  or 
    `dos`.`nature` like '%$word%' or `colors_dos`.`sex` like '%$word%' or
    `colors_dos`.`scentGroup` like '%$word%'";
    if ($result=$con->QUERY_RUN($con,$sql)	){
        $resultArray = array();
        $tempArray = array();
        while($row = $result->fetch_object()){
        $sid=$row->service_id;
        $sName=$row->service_title;
        $seName=$row->service_etitle;
        $row->size=getSizeByDoID($con,$row->do_id);
        $row->sName=$sName;
        $row->fullName=$row->service_etitle." ".$row->brands." ".$row->sex." ".$row->scentGroup." ".$row->size." M";
        $row->seName=$seName;  
        $row->price_after=$row->do_price-($row->do_certificate*$row->do_price/100);
        $row->AED=intval($row->do_price/6800);
        $row->AED_after=intval($row->price_after/6800);
        $row->USD=intval($row->do_price/24000);
        $row->USD_after=intval($row->price_after/24000);     
        $tempArray = $row;
        array_push($resultArray, $tempArray);
        }
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo $t;
}

function GroupList($con){
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT * FROM mag_group";
    if ($result=$con->QUERY_RUN($con,$sql)){
        while($row = $result->fetch_object()){    
                $tempArray = $row;
                array_push($resultArray, $row);
            }
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}

function magazineInsert($con){
    $title=$_GET['title'];
    $comment=$_GET['comment'];
    $refrence=$_GET['refrence'];
    $magazine_id=$con->GET_MAX_COL('magazine','magazine_id');
    $date=date('l jS \of F Y h:i:s A');
    $comment = str_replace("ي", "ی", $comment);  $comment = str_replace("ك ","ک",$comment);
    $title = str_replace("ي", "ی", $title);      $title = str_replace("ك ","ک",$title);
    $sql = "insert into magazine values ($magazine_id,$title, $comment,'$date',$refrence)";
    if ($result=$con->QUERY_RUN($con,$sql)	)
        echo('[{"commited":"1"}]');
    else  echo('[{"commited":"0"}]');
}
  
  
function magazineZoom($con){
    $word=$_GET['word'];
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT * FROM magazine where magazine_title like '%$word%' order by magazine_id desc";
    if ($result=$con->QUERY_RUN($con,$sql)){
        while($row = $result->fetch_object()){    
                    $row->magazine_comment = str_replace("<img ", "<img style='width:100% important'", $row->magazine_comment);
                    $row->magazine_comment = str_replace('<p', '<p style="text-align: justify !important;"', $row->magazine_comment);                     
            
                    $row->magazine_ecomment = str_replace("<img ", "<img style='width:100% important'", $row->magazine_ecomment);
                    $row->magazine_ecomment = str_replace('<p', '<p style="text-align: left !important;"', $row->magazine_ecomment);          
                    $tempArray = $row;
                    array_push($resultArray, $row);
            }
    }
    $sql="SELECT * FROM magazine where magazine_comment like '%$word%' order by magazine_id desc";
    if ($result=$con->QUERY_RUN($con,$sql)){
       while($row = $result->fetch_object()){    
                    $row->magazine_comment = str_replace("<img ", "<img style='width:100% important'", $row->magazine_comment); 
                    $row->magazine_comment = str_replace('<p', '<p style="text-align: justify !important;"', $row->magazine_comment);                     
                    $row->magazine_ecomment = str_replace("<img ", "<img style='width:100% important'", $row->magazine_ecomment); 
                    $row->magazine_ecomment = str_replace('<p', '<p style="text-align: left !important;"', $row->magazine_ecomment);    
                    $tempArray = $row;
                    array_push($resultArray, $row);
            }
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}


function magSearch($con){
$word=$_GET['word'];
$word = str_replace("ي", "ی", $word);      $word = str_replace("ك ","ک",$word);
$resultArray = array();
$tempArray = array();
$sql="SELECT * FROM magazine where magazine_title like '%$word%' or magazine_etitle like '%$word%'  order by magazine_id desc";
if ($result=$con->QUERY_RUN($con,$sql)){
     while($row = $result->fetch_object()){    
                $row->magazine_comment = str_replace("<img ", "<img style='width:100% important'", $row->magazine_comment);
                $row->magazine_ecomment = str_replace("<img ", "<img style='width:100% important'", $row->magazine_ecomment);
                $row->magazine_comment = str_replace('<p', '<p style="text-align: justify !important;"', $row->magazine_comment);                     
                $row->magazine_ecomment = str_replace('<p', '<p style="text-align: left !important;"', $row->magazine_ecomment);
                
                $tempArray = $row;
                array_push($resultArray, $row);
        }
}
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}



function magListLimit($con){
    $lim=$_GET['lim'];
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT * FROM magazine order by magazine_id desc";
    $c=0;
    if ($result=$con->QUERY_RUN($con,$sql)){
        while($row = $result->fetch_object()){    
                    $row->magazine_comment = str_replace("<img ", "<img style='width:100% important'", $row->magazine_comment);
                    $row->magazine_ecomment = str_replace("<img ", "<img style='width:100% important'", $row->magazine_ecomment);
                    $row->magazine_ecomment = str_replace('<p', '<p style="text-align: left !important;"', $row->magazine_ecomment);

                    //$row->magazine_comment = str_replace('<p', '<p style="text-align: justify !important;"', $row->magazine_comment);                     
                    $tempArray = $row;
                    $row->ht="";
                    if($c<$lim) array_push($resultArray, $row);
                    $c++;
            }
    }
        $t=json_encode($resultArray);
        if(strlen($t)!=2)   echo $t;
}



function magList($con){
$mag_id=$_GET['mag_id'];
$resultArray = array();
$tempArray = array();
$c=0;
$sql="SELECT * FROM magazine";
if($mag_id) $sql.=" where magazine_title='".$mag_id."'";
$sql.=" order by magazine_id desc";
if ($result=$con->QUERY_RUN($con,$sql)){
    while($row = $result->fetch_object()){    
        $row->magazine_comment = str_replace('<img ', '<img width="100%"  ', $row->magazine_comment);
        $row->magazine_comment = str_replace('<p', '<p align="justify" ', $row->magazine_comment);                     
        $row->magazine_ecomment = str_replace('<img ', '<img width="100%"  ', $row->magazine_ecomment);
        $row->magazine_ecomment = str_replace('<p', '<p align="left" ', $row->magazine_ecomment); 
        $row->magazine_comment = str_ireplace(array("\r","\n",'\r','\n'),'', $row->magazine_comment);
        $row->magazine_ecomment = str_ireplace(array("\r","\n",'\r','\n'),'', $row->magazine_ecomment);
        $tempArray = $row;
        $row->ht="";
        $row->brief=substr($row->magazine_refrence, 0, 30)."...";
        if($c<20) array_push($resultArray, $row);
     }
}
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}
function magListGroup($con){
    $group=$_GET['group'];
    $resultArray = array();
    $tempArray = array();
    $sql="SELECT * FROM magazine where mag_group_id=$group";
    $sql.=" order by magazine_id desc";
    if ($result=$con->QUERY_RUN($con,$sql)){
        while($row = $result->fetch_object()){    
                    $tempArray = $row;
                    //var_dump($row);
                    array_push($resultArray, $row);
            }
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;
}
function GetSizeExists($con){
    $doid=$_GET['do_id'];
    $resultArray = array();
    $tempArray = array();
    $sql_b="SELECT distinct size  FROM `colors_dos` WHERE do_id=".$doid;//echo $sql_b;
    if ($result_b=$con->QUERY_RUN($con,$sql_b)){
        while($row_b = $result_b->fetch_object()){    
                    $tempArray = $row_b;
                    array_push($resultArray, $row_b);
            }
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;                
}

function prdgetCount($con){
    $doid=$_GET['do_id'];
    $size=$_GET['size'];
    $color=$_GET['color'];
    $resultArray = array();
    $tempArray = array();
    $sql_b="SELECT count  FROM `colors_dos` WHERE do_id=".$doid." and size=".$size." and color_id=".$color;//echo $sql_b;
    if ($result_b=$con->QUERY_RUN($con,$sql_b)){
        while($row_b = $result_b->fetch_object()){    
                    $tempArray = $row_b;
                    array_push($resultArray, $row_b);
            }
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;        
        
}



function prdSizeToColor($con){
    $doid=$_GET['do_id'];
    $size=$_GET['size'];
    $resultArray = array();
    $tempArray = array();
    $sql_b="SELECT *  FROM `colors_dos` WHERE do_id=".$doid." and size=".$size;//echo $sql_b;
    if ($result_b=$con->QUERY_RUN($con,$sql_b)){
        while($row_b = $result_b->fetch_object()){    
                    $tempArray = $row_b;
                    array_push($resultArray, $row_b);
            }
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)   echo $t;                
}



function userPaymenttlist($con){
    $uid=$_GET['uid'];
    $DATE=date('Y/m/d');
    $resultArray = array();
    $tempArray = array();
    $len=0;
    $sql_b="SELECT distinct refid,postalcode FROM `basket` WHERE user_id=".$uid." and payment=1";
    if ($result_b=$con->QUERY_RUN($con,$sql_b)){
        while($row_b = $result_b->fetch_object()){
                $ref=$row_b->refid;
                $sql_c="SELECT * FROM `paySession` WHERE refid=".$ref;
                if ($result_c=$con->QUERY_RUN($con,$sql_c))
                while($row_c = $result_c->fetch_object()){
                        $row_b->price= $row_c->price;
                        $row_b->dates= $row_c->dates;
                        
                }                    
                $sql_c="SELECT user_id1 FROM `basket` WHERE refid=".$ref;
                if ($result_c=$con->QUERY_RUN($con,$sql_c))
                while($row_c = $result_c->fetch_object()){
                            $row_b->user= $row_c->user_id1;
                }
                $sql_c="SELECT distinct do_id FROM `basket` WHERE refid=".$ref;
                if ($result_c=$con->QUERY_RUN($con,$sql_c))
                while($row_c = $result_c->fetch_object()){
                        $row_b->prd.= $row_c->do_id."-";
        
                }
                $tempArray = $row_b;
                array_push($resultArray, $tempArray);
        }
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo $t; 
}

function ColorList($con){
    $sql="SELECT * FROM colors ";
    if ($result=$con->QUERY_RUN($con,$sql)	){
        $resultArray = array();
        $tempArray = array();
        $len=0;
        while($row = $result->fetch_object()){
            $tempArray = $row;
            array_push($resultArray, $tempArray);
        }

        $t=json_encode($resultArray);
        if(strlen($t)!=2)  echo $t;
    }
}

function sizeList($con){
    $sql="SELECT * FROM sizes ";
    if ($result=$con->QUERY_RUN($con,$sql)	){
        $resultArray = array();
        $tempArray = array();
        $len=0;
        while($row = $result->fetch_object()){
            $tempArray = $row;
            array_push($resultArray, $tempArray);
        }

        $t=json_encode($resultArray);
        if(strlen($t)!=2)  echo $t;
    }
}

function brands($con){
    $sort=$_GET['sort'];
    if($sort==1)
    $sql="SELECT brands as brand,count(brands) as count  FROM dos group by brands order by brand asc";
    else
    if($sort==2)
    $sql="SELECT brands as brand,count(brands) as count  FROM dos group by brands order by count desc";
    if ($result=$con->QUERY_RUN($con,$sql)	){
        $resultArray = array();
        $tempArray = array();
        $len=0;
        while($row = $result->fetch_object()){
            $tempArray = $row;
            array_push($resultArray, $tempArray);
        }

        $t=json_encode($resultArray);
        if(strlen($t)!=2)  echo $t;
    }
}

  
function deleteFromBasket($con){
  $basketId=$_GET['basketId'];
  $sql="delete FROM basket where basket_id=$basketId";
  if ($result=$con->QUERY_RUN($con,$sql)) echo('[{"deleted":"yes"}]');
}
  
function userBasketlistCount($con){
    $uid=$_GET['uid'];
    $sql="SELECT sum(basket_count) as counts FROM basket where user_id=$uid and payment=0";
    if ($result=$con->QUERY_RUN($con,$sql))  $row = $result->fetch_object();
    if($row->counts)  echo('[{"count":"'. $row->counts.'"}]');
    else    echo('[{"count":"0"}]');
}
  
function userBasketlist($con){
    $uid=$_GET['uid'];
    $DATE=date('Y/m/d');
    $sql="update basket set basket_date='$DATE' where user_id=$uid";
    $result=$con->QUERY_RUN($con,$sql);
    $sql="SELECT * FROM ( SELECT * FROM basket  where user_id=$uid and payment=0) AS A JOIN ( SELECT * FROM services where service_active=1) AS B on A.service_id=B.service_id ";
    if ($result=$con->QUERY_RUN($con,$sql)	){
        $resultArray = array();
        $tempArray = array();
        $len=0;
        while($row = $result->fetch_object()){
            $row->basket_count=$row->basket_count/1;
            $SERID=$row->service_id;
            $len++;
            $sId=$row->service_id;
            $uId=$row->user_id1;
            $ColorId=$row->color_id;
        $sqlcolor = "SELECT * FROM colors where color_id=$ColorId ";
        if ($resultColor=$con->QUERY_RUN($con,$sqlcolor)	){
            $rowColor = $resultColor->fetch_object();
            $row->color_id=$rowColor->color;
        } 
        if(!$row->basket_id) $row->wishlist_exists=0;
        else
        if($row->basket_id) $row->wishlist_exists=1;

            $sql_service = "select count(*) as likesCount from likes where user_id=$uId and service_id=$sId";
            if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $rowCountLike = $result_service->fetch_object();
            $row->likesCount =$rowCountLike->likesCount ;
            if($row->likesCount==0) $row->likesCount=1; 
    
            }

            $sql_service = "select sum(like_rate) as likesRate from likes where user_id=$uId and service_id=$sId";
            if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $rowSumRate = $result_service->fetch_object();
            $row->likesRate =$rowSumRate->likesRate ;
            if(!$rowSumRate->likesRate) $row->likesRate=1;
            }
            $sql_service = "select avg(like_rate) as userRate from likes where user_id1=$uId";
            if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $rowSumRate = $result_service->fetch_object();
            $row->user_rate =ceil($rowSumRate->userRate);
            if($row->user_Rate=="0" ) $row->user_rate=1;
            }
            $sql_service = "SELECT * FROM services where service_id='$sId'";
            if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $row_service = $result_service->fetch_object();
            $row->service=$row_service->service_title;
            }
            $sId=$row->user_id;
            $sql_service = "SELECT * FROM users where user_id='$sId'";
            if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $row_service = $result_service->fetch_object();
            $row->user=$row_service->user_name." ".$row_service->user_family;
            $row->user_prof=$row_service->user_prof;
            $row->user_phone=$row_service->user_phone;
            $row->user_mobile=$row_service->user_mobile;
            $row->userEcommerce=$row_service->user_name;
            $row->userEcommerceMalek=$row_service->user_family;
            $row->user_year=$row_service->user_year;
            $row->user_comm=$row_service->user_comm;
            $row->user_adrs=$row_service->user_adrs;
            $row->user_email=$row_service->user_email	;
            $row->user_sex=$row_service->user_sx;
            $row->user_pic=$row_service->user_pic;
        }
        $service_id=$row->service_id;
        $sId=$row->user_id1;
        $sql_service = "SELECT * FROM dos where user_id=$sId and service_id=$service_id";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $row_service = $result_service->fetch_object();
            $row->do_location= $row_service->do_location;
            $doId=$row->do_id;
            $row->nature =$row_service->nature;
            $row->do_price=$row_service->do_price;
            $row->brands=$row_service->brands;
            $row->do_look= $row_service->do_look;
            $row->do_type_comm= $row_service->do_type_comm;              
            $row->do_certificate= $row_service->do_certificate;
            $row->do_active= $row_service->do_active;
        }

            $colorString="00000000000000000000";
            $sql_service = "select * from colors_dos where do_id=$doId";
            if ($result_service=$con->QUERY_RUN($con,$sql_service))
            while($rowColors = $result_service->fetch_object()){
                $row->perfumer =$rowColors->perfumer;
                $row->scentGroup =$rowColors->scentGroup;
                $row->sex =$rowColors->sex;
                $row->colour =$rowColors->color;
                $index=$rowColors->color_id;
                $colorString[$index]='1';
                if($row->likesCount==0) $row->likesCount=1;
            }
                $row->colorString=$colorString;

                
    $row->rateLikeCount=$row->likesRate/$row->likesCount;
    $row->price_after=$row->do_price-($row->do_price*$row->do_certificate/100);
    $row->price_after=$row->price_after;
    $row->AED=intval($row->do_price/6800);
    $row->AED_after=intval($row->price_after/6800);
    $row->USD=intval($row->do_price/24000);
    $row->USD_after=intval($row->price_after/24000);  
    $tempArray = $row;
    array_push($resultArray, $tempArray);
    }
    $finalArray = array();
    $t=json_encode($resultArray);
    echo $t;   
    }
}




function addtoBasket($con){
  $DATE=date('Y/m/d');
  $uid=$_GET['uid'];
  $color_id=$_GET['color_id'];
  $count=$_GET['count'];
  $Size=$_GET['Size'];
  $do_id=$_GET['do_id'];  
  $sql = "SELECT * FROM basket where user_id=$uid and do_id=$do_id and basket_size='$Size'  and payment=0";
  if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $row = $result->fetch_object();
    $tempArray = $row;
    $wid=$row->basket_id;
    if($wid)
	{
	   $sql=" SELECT * FROM dos where do_id=$do_id";
	   if ($result=$con->QUERY_RUN($con,$sql)){
          $wid=$con->GET_MAX_COL('basket','basket_id');
	      $row = $result->fetch_object();
          $destUid=$row->user_id;
	      $service_id=$row->service_id;
          $sql = "update  basket set basket_count=basket_count+$count ,basket_date='$DATE' where user_id=$uid and do_id=$do_id and basket_size='$Size'";
	      $result=$con->QUERY_RUN($con,$sql);
	    }
	    $sqlNewCount="update colors_dos set count=count-$count where  size='$Size' and do_id=$do_id";
	    $resultNewCount=$con->QUERY_RUN($con,$sqlNewCount);
         }
	else{
	   $sql=" SELECT * FROM dos where do_id=$do_id";        
	   if ($result=$con->QUERY_RUN($con,$sql)){
	      
            $wid=$con->GET_MAX_COL('basket','basket_id');
	    $row = $result->fetch_object();
            $destUid=$row->user_id;
	    $service_id=$row->service_id;
        $sql = "insert into basket values($wid,$count,'$Size','$DATE',$do_id,$uid,$service_id,$destUid,0,'0','0')";
	    $result=$con->QUERY_RUN($con,$sql);
	    $sqlNewCount="update colors_dos set count=count-$count where  size='$Size' and do_id=$do_id";
	    $resultNewCount=$con->QUERY_RUN($con,$sqlNewCount);
	    }
         }
    array_push($resultArray, $tempArray);    
    $t=json_encode($resultArray);
    if($result)             echo('[{"commited":"1"}]');
      else           echo('[{"commited":"0"}]');
}

}



function searchShop($con){
$word=$_GET['word'];
$sql=" SELECT user_name,user_family,user_id FROM users where user_name like '%$word%' or user_family like '%$word%'";
if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $len=0;
    while($row = $result->fetch_object()){
        $uid=$row->user_id;
        $sql="SELECT * FROM dos where user_id=$uid";
        $resultUser=$con->QUERY_RUN($con,$sql);
        $rowUser = $resultUser->fetch_object();
        if($rowUser->do_id){
          $tempArray = $row;
          array_push($resultArray, $tempArray);
        }
    }

    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo $t;
}
}


function userApplyColor($con){
  $sx=$_GET['sx']; 
  $scent=$_GET['scent'];   
  $prdExist=$_GET['prdExist'];  
  $i=0; $j=0;$k=0;
  $attach=$_GET['attach'];
  //echo $attach;
  $colors=$_GET['colors'];
  $peyk=$_GET['peyk'];
  $payloc=$_GET['payloc'];
  if($peyk=='1') $peyk="پیک  رایگان داریم";
  else if($peyk=='2') $peyk="پیک داریم اما رایگان نیست";
  else  $peyk="پیک ارسال کالا  نداریم";
  $sizes=$_GET['sizes'];$service_etitle=$_GET['eTitle']; 
  $certification=$_GET['certification'];
  $service_type_id=$_GET['service_type_id'];  $user_id=$_GET['user_id'];  $service_title=$_GET['service_title']; 
  $do_price=$_GET['do_price']; $do_location=$_GET['do_location'];  $brands=$_GET['brands'];   $do_free_time=$_GET['do_free_time'];  
  $do_type_comm=$_GET['do_type_comm'];  $do_look=$_GET['do_look'];$city=$_GET['city_id'];
  //$city_id= CITY_TO_CITY_ID($con,$city);

  $sql = "SELECT * from services where service_title='$service_title'";
  $result=$con->QUERY_RUN($con,$sql);	
  $resultArray = array();
  $tempArray = array();
  if (!$row = $result->fetch_object()){
        $service_id=$con->GET_MAX_COL('services','service_id');
        $sql = "insert into services(service_id,service_title,service_etitle,service_type_id,service_active) values($service_id,'$service_title','$service_etitle',$service_type_id,0)";
        $result=$con->QUERY_RUN($con,$sql);
  }
  else { 
       $service_id=$row->service_id;
  }
 $do_id=$con->GET_MAX_COL('dos','do_id');
 if(strcmp($city,"null")==0) $city=330;
 
 $sqlInsert = "insert into dos(do_id,user_id,service_id,do_price,do_location,do_free_time,brands,do_type_comm,do_look,city_id,do_active,do_certificate,do_peyk,do_payLoc,do_attach,do_campaign,sx,nature) 
 values($do_id,$user_id,$service_id,$do_price,'$do_location','$do_free_time','$brands','$do_type_comm',$do_look,$city,1,$certification,'$peyk','$payloc','$attach',0,'$sx','$scent')";
 //echo  $sqlInsert;
 $result=$con->QUERY_RUN($con,$sqlInsert);	



while(($prdExist[$i]!='K')){
      
      $t="";
      while(($prdExist[$j]!=',')&&($j<=strlen($prdExist))){
          $t=$t.$prdExist[$j];
          $j++; 
      }
     
      $j++;
      $count_New=$t%10;
      if($count_New>0){
      $color_New=intval($t/100);   
      $size_New=intval(($t%100)/10); 
      $count_New=$t%10; 
       
      $sqlInsert = "insert into colors_dos values($do_id,$color_New,$size_New,$count_New,'Bitter')";
      //echo $sqlInsert;
      $result=$con->QUERY_RUN($con,$sqlInsert);

      }
   $i++;
  }
  
  
  

   $sizes_id=$con->GET_MAX_COL('sizes','sizes_id');
   $sql = "insert into sizes(sizes_id,do_id,sizes)
   values($sizes_id,$do_id,'$sizes')";
   $result=$con->QUERY_RUN($con,$sql);


  $sqlSelectCheck = "SELECT * from dos where do_id=$do_id and user_id=$user_id and service_id=$service_id";
  $resultSelectCheck=$con->QUERY_RUN($con,$sqlSelectCheck);
  $rowSelectCheck = $resultSelectCheck->fetch_object();
  $CheckInsert=$rowSelectCheck->do_id;
  if ($CheckInsert>0){
	echo('[{"Applied":"'.$CheckInsert.'"}]');
    }
else{
	echo('[{"Applied":"0"}]');
}


}
 
//how =1 brand    
//=2 scent   
//=4 price
function SEARCH_HIV_SIMIL($TABLE,$TITLE,$con,$doIdMe,$brand,$scent,$sx,$price,$how){
 	  $resultArray = array();
  	  $tempArray = array();
      $service_id=$row->service_id;
      if(!$how) $how=0;
      $sqlDos="select * from dos where brands like '%$brand%' and do_id!=$doIdMe";
      $resultDos=$con->QUERY_RUN($con,$sqlDos);
      while($rowDos = $resultDos->fetch_object()){ 
        $DOID=$rowDos->do_id; 
        $SERVICE=$rowDos->service_id; 
        $rowDos->price_after=$rowDos->do_price-($rowDos->do_price*$rowDos->do_certificate/100);
        $SERV=$rowDos->service_id;
        $rowDos->price_after=$rowDos->do_price-($rowDos->do_price*$rowDos->do_certificate/100);
        $rowDos->AED_after=intval($rowDos->price_after/6800);
        $rowDos->AED=intval($rowDos->do_price/6800);
        $rowDos->USD_after=intval($rowDos->price_after/24000);
        $rowDos->USD=intval($rowDos->do_price/24000);         
        $rowDos->service_etitle=sidToenservtitle($con,$SERV);
        //
        $sqlColorDos="select * from colors_dos where do_id =$DOID";
        $resultColorDos=$con->QUERY_RUN($con,$sqlColorDos);
        $rowColorDos = $resultColorDos->fetch_object();
        $rowDos->sex=$rowColorDos->sex; 

        $sqlColorDos="select * from services where service_id =$SERVICE";
        $resultColorDos=$con->QUERY_RUN($con,$sqlColorDos);
        $rowColorDos = $resultColorDos->fetch_object();
        $rowDos->Eservice=$rowColorDos->service_etitle; 
        $tempArray = $rowDos;
        if($how==1 ) array_push($resultArray, $tempArray);
      }
      
      $sqlDos="select * from colors_dos inner join dos on dos.do_id=colors_dos.do_id where scent ='$scent' and dos.do_id!=$doIdMe";//echo $sqlDos;
      $resultDos=$con->QUERY_RUN($con,$sqlDos);
      while($rowDos = $resultDos->fetch_object()){
        $DOID=$rowDos->do_id; 
        $SERVICE=$rowDos->service_id;          
        $rowDos->price_after=$rowDos->do_price-($rowDos->do_price*$rowDos->do_certificate/100);
        $rowDos->AED_after=intval($rowDos->price_after/6800);
        $rowDos->AED=intval($rowDos->do_price/6800);
        $rowDos->USD_after=intval($rowDos->price_after/24000);
        $rowDos->USD=intval($rowDos->do_price/24000); 
        $SERV=$rowDos->service_id;
        $rowDos->service_etitle=sidToenservtitle($con,$SERV);
        $rowDos->Eservice=$rowDos->service_etitle; 
        $tempArray = $rowDos;
        if($how==2 ) array_push($resultArray, $tempArray);
          
      }    

      $sqlDos="select * from dos where ((do_price-(do_price*do_certificate/100)) <=($price*1.3)) and( (do_price-(do_price*do_certificate/100))>=($price*0.7)) and do_id!=$doIdMe";
      //echo $sqlDos;
      $resultDos=$con->QUERY_RUN($con,$sqlDos);
      while($rowDos = $resultDos->fetch_object()){
        $DOID=$rowDos->do_id; 
        $SERVICE=$rowDos->service_id;               
        $rowDos->price_after=$rowDos->do_price-($rowDos->do_price*$rowDos->do_certificate/100);
        $rowDos->AED_after=intval($rowDos->price_after/6800);
        $rowDos->AED=intval($rowDos->do_price/6800);
        $rowDos->USD_after=intval($rowDos->price_after/24000);
        $rowDos->USD=intval($rowDos->do_price/24000);  
        $SERV=$rowDos->service_id;
        $rowDos->service_etitle=sidToenservtitle($con,$SERV);
        $rowDos->Eservice=$rowDos->service_etitle;
        $rowDos->sx_new=$rowDos->sx;     
        //
        $do_id_size=$rowDos->do_id;
        $sql_size="SELECT * FROM colors_dos where do_id=$do_id_size";
        $result_size=$con->QUERY_RUN($con,$sql_size);
        $row_size = $result_size->fetch_object();
        $row->sizes=$row_size->size;
        $rowDos->dos_sizeEx=$row_size->size;
        //
        $tempArray = $rowDos;
        if($how==4)  array_push($resultArray, $tempArray);

      
      }   
      
      
  $t=json_encode($resultArray);
  if(strlen($t)!=2)  echo $t;

}

function sidToenservtitle($con,$sid){
      $sqlDos="select * from services where service_id=".$sid;
      $resultDos=$con->QUERY_RUN($con,$sqlDos);
      while($rowDos = $resultDos->fetch_object()){
          return ($rowDos->service_etitle);
      }
    
}


function SEARCH_HIV($TABLE,$idreserve,$con,$doIdMe){
 $cont=0; $finds1=0; $finds2=0;$FIND=0;
 $s=$idreserve;
 $s=explode(" ",$s);
 $s0=$s[0];$s1=$s[1];$s2=$s[2];
 $FIND=0; 
 if($s[2]!="")
 $sql="select * from $TABLE where service_title like '%$s0%' or service_title like '%$s1%' or
 service_title like '%$s2%' limit 0,2";
else
if($s[1]!="")
$sql="select * from $TABLE where service_title like '%$s0%' or service_title like '%$s1%' limit 0,2";

else
$sql="select * from $TABLE where service_title like '%$s0%' limit 0,2";



 if ($result=$con->QUERY_RUN($con,$sql)){
	$resultArray = array();
	$tempArray = array();
	while($row = $result->fetch_object())
	{
      $service_id=$row->service_id;
      $sqlDos="select * from dos where service_id=$service_id and do_id!=$doIdMe";
      $resultDos=$con->QUERY_RUN($con,$sqlDos);
      if($FIND<5)
      while($rowDos = $resultDos->fetch_object()){
        $row->do_id=$rowDos->do_id;
        $row->user_id=$rowDos->user_id;
        $row->price_after=$rowDos->do_price-($row->do_price*$rowDos->do_certificate/100);
        $FIND++;
        $tempArray = $row;
        if( $FIND<10)
           array_push($resultArray, $tempArray);
  
      }

	}



  $t=json_encode($resultArray);
  if(strlen($t)!=2)  echo $t;
}



return $FIND;
}

function similDoid($doId,$con,$how){
  $sql=" SELECT * FROM colors_dos where do_id=$doId";
  $result=$con->QUERY_RUN($con,$sql);
  $row = $result->fetch_object();
  $scent=$row->scent;
  
  $sql=" SELECT * FROM dos where do_id=$doId";
  $result=$con->QUERY_RUN($con,$sql);
  $row = $result->fetch_object();
  $service_id=$row->service_id;

  $sx=$row->sx;
  $price=$row->do_price;
  $certification=$row->do_certificate;
  $price=$price-($price*$certification/100);

  $brand=$row->brands;
  $sql=" SELECT * FROM services where service_id=$service_id";
  $result=$con->QUERY_RUN($con,$sql);
  $row = $result->fetch_object();
  $service_title=$row->service_title; 
  SEARCH_HIV_SIMIL("services",$service_title,$con,$doId,$brand,$scent,$sx,$price,$how);
  
  }
  
function simil($con){
  $doId=$_GET['doId'];
  $sql=" SELECT * FROM dos where do_id=$doId";
  $result=$con->QUERY_RUN($con,$sql);
  $row = $result->fetch_object();
  $service_id=$row->service_id;
  $sql=" SELECT * FROM services where service_id=$service_id";
  $result=$con->QUERY_RUN($con,$sql);
  $row = $result->fetch_object();
  $service_title=$row->service_title; 
  SEARCH_HIV("services",$service_title,$con,$doId);
  
  }
  
  

function deleteProfilePicture($con){
  $userId=$_GET['userId'];
  $index=$_GET['index'];
  unlink("../users/".$userId."/".$index.".jpg");
}


function deleteFromDashboard($con){
  $doid=$_GET['do_id'];
  $sql="delete FROM colors_dos where do_id=$doid";
  $result=$con->QUERY_RUN($con,$sql);

  $sql="SELECT * FROM dos where do_id=$doid";
  if ($result=$con->QUERY_RUN($con,$sql)){
     $result=$con->QUERY_RUN($con,$sql);
     $row = $result->fetch_object();
   }

  $uid=$row->user_id;
  $sid=$row->service_id;

  $sql=" delete from likes where user_id1=$uid and service_id=$sid";
  $result=$con->QUERY_RUN($con,$sql);

  $sql=" delete from wishlist where do_id=$doid";
  $result=$con->QUERY_RUN($con,$sql);

  $sql = "delete from dos  where do_id=$doid";
  if ($result=$con->QUERY_RUN($con,$sql)	)
         echo('[{"deleted":"yes"}]');
  }

function prdCount($con){
$table=$_GET['table'];
 $sql = "select count(*) as count from  $table";
if ($result=$con->QUERY_RUN($con,$sql)	)
   $row = $result->fetch_object();
       echo('[{"prdCount":"'. $row->count.'"}]');
}


function visitors($con){
$doId=$_GET['doId'];
$sql=" SELECT * FROM dos where do_id=$doId";
$result=$con->QUERY_RUN($con,$sql);
$row = $result->fetch_object();
$uid=$row->user_id;
$sql="SELECT  * FROM ( SELECT * FROM visit where user_id1=$uid order by visit_id desc) AS A JOIN ( SELECT * FROM users) AS B on A.user_id=B.user_id 
limit 0,9";
if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $len=0;
    while($row = $result->fetch_object()){
        $user_id=$row->user_id;
        $sql="SELECT * FROM dos where user_id=$user_id";
        $result_dos=$con->QUERY_RUN($con,$sql);
        $row_dos= $result_dos->fetch_object();
        
        $row->do_id=$row_dos->do_id;
	      $row->brands="(".$row->brands.")".$row->do_price;
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }

    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo $t;
  else {           
  }}
}




function visit($con){
  $uid=$_GET['uid'];
  $do_id=$_GET['DoId'];
  
  $sql=" SELECT * FROM dos where do_id=$do_id";
  if ($result=$con->QUERY_RUN($con,$sql)){
        $vidMax=$con->GET_MAX_COL('visit','visit_id');
	$row = $result->fetch_object();
        $user_id1=$row->user_id;
	$sql = "SELECT * FROM visit where user_id=$uid and user_id1=$user_id1 ";
	if ($result=$con->QUERY_RUN($con,$sql)	)
	{
	    $resultArray = array();
	    $tempArray = array();
	    $row = $result->fetch_object();
	    $tempArray = $row;
	    $vid=$row->visit_id;
	    if(!$vid)
	{
      $sql = "insert into visit values($vidMax,$uid,$user_id1)";
      if($uid!=$user_id1)
	      $result=$con->QUERY_RUN($con,$sql);
        }
    }
   }
  if ($result)
       echo('[{"visited":"1"}]');
  else           echo('[{"visited":"0"}]');
}


function rateADos($con){
  $userIdDest=$_GET['userId'];
  $userId=$_GET['userId'];
  $serviceId=$_GET['serviceId'];
  $rate=$_GET['rate'];

  $sql = "SELECT * FROM likes where  user_id=$userId and  service_id= $serviceId";
  $result=$con->QUERY_RUN($con,$sql);
  $row = $result->fetch_object();
  $rateExist=$row->like_rate;
  $date=date('l jS \of F Y h:i:s A');
  if($rateExist)
     $sql = "update likes set  like_rate=$rate ,like_date='$date' where user_id=$userId and user_id1=$userId and service_id= $serviceId";
  else
    $sql = "insert into likes values ($userId,$userIdDest, $serviceId,'$date',$rate)";

  if ($result=$con->QUERY_RUN($con,$sql)	)
       echo('[{"rateChanged":"1"}]');
  else           echo('[{"rateChanged":"0"}]');


  }




function increaseFieldOfTable($con){
  $field=$_GET['field'];
  $table=$_GET['table'];
  $columnCondition=$_GET['columnCondition'];
  $valueForColumnCondition=$_GET['valueForColumnCondition'];
  
  $sql = "update $table set  $field= $field+1 where $columnCondition=$valueForColumnCondition";

if ($result=$con->QUERY_RUN($con,$sql)	)
       echo('[{"isInWishlist":"1"}]');
      else           echo('[{"isInWishlist":"0"}]');


}




function isInWishlist($con){
  $uid=$_GET['uid'];
  $do_id=$_GET['do_id'];
  $sql = "SELECT * FROM wishlist where user_id=$uid and do_id=$do_id ";

if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $row = $result->fetch_object();
    $tempArray = $row;
    $wid=$row->wishlist_id;
    if($wid)       echo('[{"isInWishlist":"1"}]');
      else           echo('[{"isInWishlist":"0"}]');

}}

function userAddReWishlist($con){
  $uid=$_GET['uid'];
  $do_id=$_GET['do_id'];
  $sql = "SELECT * FROM wishlist where user_id=$uid and do_id=$do_id ";

if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $row = $result->fetch_object();
    $tempArray = $row;
    $wid=$row->wishlist_id;
    if($wid)
	{
	  $sql = "delete FROM wishlist where wishlist_id=$wid "; 
	  $result=$con->QUERY_RUN($con,$sql);
	}
	else
	{
	   $sql=" SELECT * FROM dos where do_id=$do_id";
	   if ($result=$con->QUERY_RUN($con,$sql)){
            $wid=$con->GET_MAX_COL('wishlist','wishlist_id');
	    $row = $result->fetch_object();
            $destUid=$row->user_id;
	    $service_id=$row->service_id;
	    $sql = "insert into  wishlist values($wid,$do_id,$uid,$destUid,$service_id)";
	    $result=$con->QUERY_RUN($con,$sql);
	    }
         }
    array_push($resultArray, $tempArray);    
    $t=json_encode($resultArray);
    if($result)             echo('[{"commited":"1"}]');
      else           echo('[{"commited":"0"}]');
}
}



function userWishlist($con){
$uid=$_GET['uid'];
$sql="SELECT * FROM ( SELECT * FROM wishlist where user_id=$uid) AS A JOIN ( SELECT * FROM services where service_active=1) AS B on A.service_id=B.service_id ";
if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $len=0;
    while($row = $result->fetch_object()){
	    $len++;
	    $sId=$row->service_id;
	    $uId=$row->user_id1;
	    $row->Eservice=$row->service_etitle;
        if(!$row->wishlist_id) $row->wishlist_exists=0;
        else
        if($row->wishlist_id) $row->wishlist_exists=1;
        $sql_service = "select count(*) as likesCount from likes where user_id=$uId and service_id=$sId";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $rowCountLike = $result_service->fetch_object();
            $row->likesCount =$rowCountLike->likesCount ;
            if($row->likesCount==0) $row->likesCount=1; 
	    }

        $sql_service = "select sum(like_rate) as likesRate from likes where user_id=$uId and service_id=$sId";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $rowSumRate = $result_service->fetch_object();
            $row->likesRate =$rowSumRate->likesRate ;
            if(!$rowSumRate->likesRate) $row->likesRate=1;
	    }
        $sql_service = "select avg(like_rate) as userRate from likes where user_id1=$uId";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $rowSumRate = $result_service->fetch_object();
            $row->user_rate =ceil($rowSumRate->userRate);
            if($row->user_Rate=="0" ) $row->user_rate=1;
	    }
        $sql_service = "SELECT * FROM services where service_id='$sId'";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $row_service = $result_service->fetch_object();
            $row->service=$row_service->service_title;
	    }
   	    $sId=$row->user_id1;
        $sql_service = "SELECT * FROM users where user_id='$sId'";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
            $row_service = $result_service->fetch_object();
            $row->user=$row_service->user_name." ".$row_service->user_family;
            $row->user_prof=$row_service->user_prof;
            $row->user_phone=$row_service->user_phone;
            $row->user_mobile=$row_service->user_mobile;
            $row->userEcommerce=$row_service->user_name;
            $row->userEcommerceMalek=$row_service->user_family;
            $row->user_year=$row_service->user_year;
            $row->user_comm=$row_service->user_comm;
            $row->user_age=$row_service->user_age;
            $row->user_email=$row_service->user_email	;
            $row->user_sex=$row_service->user_sx;
            $row->user_pic=$row_service->user_pic;
            $row->user_id=$row->user_id1;
      }
      $service_id=$row->service_id;
      $sql_service = "SELECT * FROM dos  where user_id=$sId and service_id=$service_id";
      if ($result_service=$con->QUERY_RUN($con,$sql_service)){
        $row_service = $result_service->fetch_object();
        if(strcmp($row_service->sx,"SPORT")==0)
        $row->sx_new="MEN/WOMEN";
        else
        $row->sx_new=$row_service->sx;  
        $row->sx=$row_service->sx;
        $row->do_location= $row_service->do_location;
        $doId=$row->do_id;
        $row->do_price=$row_service->do_price;
        $row->brands=$row_service->brands;
        $row->do_look= $row_service->do_look;
        $row->do_type_comm= $row_service->do_type_comm;              
        $row->do_certificate= $row_service->do_certificate;
        $row->do_active= $row_service->do_active;              
        $sql_service = "select * from colors_dos where do_id=$doId";
        if ($result_service=$con->QUERY_RUN($con,$sql_service))
        while($rowColors = $result_service->fetch_object()){  
            $row->dos_sizeEx=$rowColors->size;  
            $row->scentGroup=$rowColors->scentGroup; 
            $row->sex=$rowColors->sex; 
            $row->perfumer=$rowColors->perfumer; 
            $index=$rowColors->color_id;
        }
       }
        $colorString="00000000000000000000";
        $sql_service = "select * from colors_dos where do_id=$doId";
        if ($result_service=$con->QUERY_RUN($con,$sql_service))
        while($rowColors = $result_service->fetch_object()){
            $index=$rowColors->color_id;
            $colorString[$index]='1';
            if($row->likesCount==0) $row->likesCount=1;
        }
$row->colorString=$colorString;
$row->rateLikeCount=$row->likesRate/$row->likesCount;
$row->price_after=$row->do_price-($row->do_price*$row->do_certificate/100);
$row->price_after=strval($row->price_after);
$row->AED_after=intval($row->price_after/6800);
$row->AED=intval($row->do_price/6800);
$row->USD_after=intval($row->price_after/24000);
$row->USD=intval($row->do_price/24000);  
if($row->do_active=='1'){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
}
}
$finalArray = array();
$t=json_encode($resultArray);
echo $t;
}

}


function USER_INFO_FULL($con){
$uid=$_GET['uid'];
$sql = "SELECT * from users where user_id='$uid'";
if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $row = $result->fetch_object();
    {
        $sql_service = "select count(*) as likesCount from likes where user_id1=$uid";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
		$rowCountLike = $result_service->fetch_object();
		$row->likesCount =$rowCountLike->likesCount ;
		if($row->likesCount==0) $row->likesCount=1; 
 
	    }

        $sql_service = "select count(*) as wishList from wishList where user_id=$uid ";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
		$rowSumRate = $result_service->fetch_object();
		$row->wishList =$rowSumRate->wishList ;
		if(!$rowSumRate->likesRate) $row->likesRate=1;
	    }

        $sql_service = "select avg(like_rate) as userRate from likes where user_id1=$uid";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
		$rowSumRate = $result_service->fetch_object();
		$row->user_rate =intval($rowSumRate->userRate);
		if($row->user_rate==0) $row->user_rate=1;
	    }

        $sql_service = "SELECT count(*) as numberDos FROM dos where user_id=$uid";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
		$row_service = $result_service->fetch_object();
		$row->numberDos=$row_service->numberDos;
	    }
        $row->user_pass="ABCD";
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
$t=json_encode($resultArray);
if(strlen($t)!=2)  echo $t;
else { 
            echo('[{"user_id":"0"}]');
}
}

}


function RecoveryPass($con){
$mobile=$_GET['mobile'];
$sql = "SELECT user_pass FROM users where user_mobile='$mobile' ";
if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $row = $result->fetch_object();

        $tempArray = $row;
        array_push($resultArray, $tempArray);

    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo $t;
    else echo('[{"user_id":"0"}]');
}
}




function userEdit($con){
$uid=$_GET['uid'];
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}"); 
header("Access-Control-Allow-Credentials:true");
header("Set-Cookie:HttpOnly;Secure;SameSite=Strict");
header('Access-Control-Allow-Origin: *');
$selectImg="1";
$r="r";
$originalName = $_FILES['file']['name'];
$ext = '.'.pathinfo($originalName, PATHINFO_EXTENSION);
$generatedName = $selectImg.$ext;
$filePath = $generatedName;
$pathDir ="../users/".$uid;
if ( ! is_dir($pathDir)) {
    mkdir($pathDir);
}
if (move_uploaded_file($_FILES['file']['tmp_name'], "../users/".$uid."/".$filePath)) 
{}
$name=$_GET['name'];$family=$_GET['family'];$email=$_GET['email'];$sx=$_GET['sx'];
$age=$_GET['age'];$adrs=$_GET['adrs'];$educ=$_GET['educ'];$year=$_GET['year'];
$comm=$_GET['comm'];$melli=$_GET['melli'];$pass=$_GET['pass'];
$telegram=$_GET['telegram'];   $LinkedIn=$_GET['LinkedIn'];   $instagram=$_GET['instagram'];   $whatsApp=$_GET['whatsApp'];
$sql = "update users set user_family='$family',user_meli='$melli',user_sx='$sx',user_adrs='$adrs',
user_email='$email',user_pass='$pass'
,user_telegram='$telegram',user_linkedin='$LinkedIn',user_instagram='$instagram',user_whatsapp='$whatsApp'
where user_id=$uid"; 
if ($result=$con->QUERY_RUN($con,$sql)	)
   echo('[{"userEdit":"1"}]');
else
    echo('[{"userEdit":"0"}]');
}


function userPrds($con){
$uid=$_GET['uid'];
$sql="SELECT * FROM ( SELECT * FROM dos where user_id=$uid and do_active=1) AS A JOIN ( SELECT * FROM services) AS B on A.service_id=B.service_id ";
if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $len=0;
    while($row = $result->fetch_object()){
    $len++;
    $sId=$row->service_id;
    $uId=$row->user_id;
    $doId=$row->do_id;
    $sql_service = "select * from wishlist where do_id=$doId";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
        $rowwishlist = $result_service->fetch_object();
        $row->wishlist_exists =$rowwishlist->wishlist_id ;
        if(!$rowwishlist->wishlist_id)$row->wishlist_exists=0;
        else
        if($rowwishlist->wishlist_id)$row->wishlist_exists=1;
    }
    $colorString="00000000000000000000";
    $sql_service = "select * from colors_dos where do_id=$doId";
    if ($result_service=$con->QUERY_RUN($con,$sql_service))
    while($rowColors = $result_service->fetch_object()){
    $index=$rowColors->color_id;
    $colorString[$index]='1';
    if($row->likesCount==0) $row->likesCount=1;
    }
    $row->colorString=$colorString;
    $sql_service = "select count(*) as likesCount from likes where user_id1=$uId and service_id=$sId";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
    $rowCountLike = $result_service->fetch_object();
    $row->likesCount =$rowCountLike->likesCount ;
    if($row->likesCount==0) $row->likesCount=1; 
    }
    $sql_service = "select sum(like_rate) as likesRate from likes where user_id1=$uId and service_id=$sId";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
    $rowSumRate = $result_service->fetch_object();
    $row->likesRate =$rowSumRate->likesRate ;
    if(!$rowSumRate->likesRate) $row->likesRate=1;
    }
    $sql_service = "select avg(like_rate) as userRate from likes where user_id1=$uId";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
    $rowSumRate = $result_service->fetch_object();
    $row->user_rate =$rowSumRate->userRate;
    if(!$rowSumRate->user_Rate ) $row->user_rate=1;
    $row->user_rate =ceil($rowSumRate->userRate);
    if($row->user_Rate=="0" ) $row->user_rate=1;
    }
    $sql_service = "SELECT * FROM services where service_id='$sId'";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
    $row_service = $result_service->fetch_object();
    $row->service=$row_service->service_title;
    }
    $sId=$row->user_id;
    $sql_service = "SELECT * FROM users where user_id='$sId'";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
    $row_service = $result_service->fetch_object();
    $row->user=$row_service->user_name." ".$row_service->user_family;
    $row->user_prof=$row_service->user_prof;
    $row->user_phone=$row_service->user_phone;
    $row->userEcommerce=$row_service->user_name;
    $row->userEcommerceMalek=$row_service->user_family;
    $row->user_mobile=$row_service->user_mobile;
    $row->user_year=$row_service->user_year;
    $row->user_comm=$row_service->user_comm;
    $row->user_age=$row_service->user_age;
    $row->user_email=$row_service->user_email	;
    $row->user_sex=$row_service->user_sx;
    $row->user_pic=$row_service->user_pic; 
    $row->user_adrs=$row_service->user_adrs;

    $row->user_meli=$row_service->user_meli;
    $row->user_whatsapp=$row_service->user_whatsapp;
    $row->user_telegram=$row_service->user_telegram;
    $row->user_instagram=$row_service->user_instagram;
    $row->user_linkedin=$row_service->user_linkedin;
    }
    $row->rateLikeCount=$row->likesRate/$row->likesCount;
    $row->price_after=$row->do_price-($row->do_price*$row->do_certificate/100);
    $row->price_after=strval($row->price_after);

    $row->brands=$row->brands;
    $tempArray = $row;
    array_push($resultArray, $tempArray);

    }

    $finalArray = array();

    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo $t;
    else { 
        
    }
  }

}




function prdZoom($con){
$do_id=$_GET['do_id'];
$uid=$_GET['user_id'];
$sql="SELECT * FROM ( SELECT * FROM dos where do_id=$do_id) AS A JOIN ( SELECT * FROM services) AS B on A.service_id=B.service_id";
$pic1=file_exists("../users/1/8/1.jpg");
$pic2=file_exists("../users/1/8/3.jpg");
$pic3=file_exists("../users/1/8/4.jpg");
if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    $len=0;
    while($row = $result->fetch_object()){
	    $len++;
	    $sId=$row->service_id;
	    //
	    $row->do_attach=str_replace("IRANSans", "yekan", $row->do_attach);
	    $row->do_attach=str_replace("_", " ", $row->do_attach);
        $row->pic1=$pic1;
        $row->pic2=$pic2;
        $row->pic3=$pic3;        
	    $uId=$row->user_id;
        //$row->sx=$row->sx==1?"MEN":"WOMEN";
        if($row->do_free_time=='1') $row->do_free_time="ندارد";
        else $row->do_free_time.=" ماه ";
        
              if(strcmp($row->do_free_time,"دارد"))
        $row->Edo_free_time="Yes";else
           $row->Edo_free_time="No";
      

      if(strcmp($row->nature,"تند"))
      $row->dos_escent="Spicy";else
      if(strcmp($row->nature,"شیرین"))
      $row->dos_escent="Sweet";else
      if(strcmp($row->nature,"گرم"))
      $row->dos_escent="Warm";else
      if(strcmp($row->nature,"میوه ای"))
      $row->dos_escent="Fruit";else
      if(strcmp($row->nature,"جنگلی"))
      $row->dos_escent="Jungle";else    
      if(strcmp($row->nature,"تلخ"))
      $row->dos_escent="spicy";else
      if(strcmp($row->nature,"چوبی"))
      $row->dos_escent="Wood";else
      if(strcmp($row->nature,"خنک"))
      $row->dos_escent="Cold";else
      if(strcmp($row->nature,"ملایم"))
      $row->dos_escent="Soft";
                     if(strcmp($row->sx,"SPORT")==0)
                     $row->sx_new="MEN/WOMEN";
                     else
                     $row->sx_new=$row->sx;   
                     $row->Eservice=$row->service_etitle;   
        $sql_service = "select *  from sizes where do_id=$do_id";
        if ($result_service=$con->QUERY_RUN($con,$sql_service)){
	        	$rowSizesFetch = $result_service->fetch_object();
	       
	        	$row->Sizes =$rowSizesFetch->sizes ;
	    }
if(strcmp($row->Sizes,null)==0)
$row->Sizes="0";
$row->nextImage=0; 
if(file_exists("../users/1/".$do_id."/3.jpg")) 
  $row->nextImage=1;
$sql_service = "select * from colors_dos where do_id=$do_id";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
    $rowExists = $result_service->fetch_object();
    {
    $row->perfumer=$rowExists->perfumer;
    $row->sizeEx =$rowExists->size;
    $row->scentGroup =$rowExists->scentGroup;
    $row->sex =$rowExists->sex;
    $row->countEx =$rowExists->count;
    $color=$rowExists->color_id;
    $row->colour =$rowExists->color;
    $row->scentExact=$rowExists->scent;
    $sql_Color = "select * from colors where color_id=$color";
    if ($result_Color=$con->QUERY_RUN($con,$sql_Color)){
        $rowColor = $result_Color->fetch_object();
        $row->colorEx =$color;
        $row->colorStr =$rowColor->color;
    }
  }
}
	    
$sql_service = "select * from wishlist where do_id=$do_id and user_id=$uid";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$rowwishlist = $result_service->fetch_object();
$row->wishlist_exists =$rowwishlist->wishlist_id ;
if(!$rowwishlist->wishlist_id)$row->wishlist_exists=0;
else
if($rowwishlist->wishlist_id)$row->wishlist_exists=1;

}
	    
$sql_service = "select count(*) as likesCount from likes where user_id1=$uId";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$rowCountLike = $result_service->fetch_object();
$row->likesCount =$rowCountLike->likesCount ;
if($row->likesCount==0) $row->likesCount=1;

}

$sql_service = "select sum(like_rate) as likesRate from likes where user_id1=$uId and service_id=$do_id";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$rowSumRate = $result_service->fetch_object();
$row->likesRate =$rowSumRate->likesRate ;
if(!$rowSumRate->likesRate) $row->likesRate=1;
}

$sql_service = "select avg(like_rate) as userRate from likes where service_id=$do_id";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
    $rowSumRate = $result_service->fetch_object();
    $row->user_rate =intval($rowSumRate->userRate);
    if($row->user_rate==0) $row->user_rate=1;
}
$colorString="00000000000000000000";
$sql_service = "select * from colors_dos where do_id=$do_id";
if ($result_service=$con->QUERY_RUN($con,$sql_service))
while($rowColors = $result_service->fetch_object()){
    $index=$rowColors->color_id;
    $colorString[$index-1]='1';
    if($row->likesCount==0)  $row->likesCount=1;
}
$row->colorString=$colorString;
$sql_service = "SELECT * FROM services where service_id='$sId'";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$row_service = $result_service->fetch_object();
$row->service=$row_service->service_title;
$row->Eservice=$row_service->service_etitle;
}
$sId=$row->user_id;
$sql_service = "SELECT * FROM users where user_id='$sId'";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$row_service = $result_service->fetch_object();
$row->user=$row_service->user_name." ".$row_service->user_family;
$row->user_prof=$row_service->user_prof;
$row->user_phone=$row_service->user_phone;
$row->user_mobile=$row_service->user_mobile;
$row->user_meli=$row_service->user_meli;
$row->user_year=$row_service->user_year;
$row->userEcommerce=$row_service->user_name;
$row->userEcommerceMalek=$row_service->user_family;
$row->user_adrs=$row_service->user_adrs;
$row->user_comm=$row_service->user_comm;
$row->user_age=$row_service->user_age;
$row->user_email=$row_service->user_email	;
$row->user_sex=$row_service->user_sx;
$row->user_pic=$row_service->user_pic;
$row->user_whatsapp=$row_service->user_whatsapp;
$row->user_telegram=$row_service->user_telegram;
$row->user_instagram=$row_service->user_instagram;
$row->user_linkedin=$row_service->user_linkedin;

}
$row->rateLikeCount=$row->likesRate/$row->likesCount;
$row->price_after=$row->do_price-($row->do_price*$row->do_certificate/100);
$row->price_after=strval($row->price_after);
$row->AED_after=intval($row->price_after/6800);      
$row->AED=intval($row->do_price/6800);
$row->USD_after=intval($row->price_after/24000);
$row->USD=intval($row->do_price/24000); 
$tempArray = $row;
array_push($resultArray, $tempArray);
}
$t=json_encode($resultArray);
if(strlen($t)!=2)  echo $t;
}
}



function userRate($con){
$sql = "SELECT sum(like_rate) as score,user_id1 FROM `likes` group by user_id1"; 
$sql="SELECT * FROM ( SELECT sum(like_rate) as score,user_id1 FROM `likes` group by user_id1 order by score) 
AS A JOIN 
( SELECT distinct user_id FROM dos) AS B on A.user_id1=B.user_id ";

if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
	    $uId=$row->user_id;
            $sql_service = "select *  from users where user_id=$uId";
            if ($result_service=$con->QUERY_RUN($con,$sql_service)){
		$rowCountLike = $result_service->fetch_object();
		$row->user =$rowCountLike->user_name. " ".$rowCountLike->user_family ;
		$row->user_prof =$rowCountLike->user_prof;
		$row->user_year =$rowCountLike->user_year;
	    }
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo $t;
	else echo('[{"userrate":"0"}]');
  }
}


function userList($con){
$sort=$_GET['sort'];
$asc=$_GET['asc'];
$sql = "SELECT  * from users order by '$sort' $asc"; 
if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo $t;
    else echo('[{"users":"0"}]');
  }
}


function TakeLook($con){
$doid=$_GET['doid'];
$sql = "update dos set do_look=do_look+1 where do_id=$doid";
$q=$result=$con->QUERY_RUN($con,$sql);	
if ($q){
  echo('{"look":[{"look":"1"}]');
}
else if ($l==0){
  echo('{"look":[{"look":"0"}]');
}
}



function TakeLike($con){
$userid=$_GET['userid'];
$desid=$_GET['desid'];
$serviceid=$_GET['serviceid'];
$sql = "SELECT * from likes where user_id=$userid and user_id1=$desid and service_id=$serviceid"; 
if ($result=$con->QUERY_RUN($con,$sql)	){

    $row = $result->fetch_object();
    $l=2;
     if($row->service_id){
         $l=0;	$sql = "delete from likes where user_id=$userid and user_id1=$desid and service_id=$serviceid";
      }
     else
     {
         $l=1;	$sql = "insert into likes values($userid,$desid,$serviceid,'DATE')";
     }
}

$q=$result=$con->QUERY_RUN($con,$sql);	

if ($l==1){
  echo('{"like":[{"like":"1"}]');
}
else if ($l==0){
  echo('{"like":[{"like":"0"}]');
}
}

function MSGS_DEL($con){
$sender=$_GET['sender'];
$receiver=$_GET['receiver'];
$sql = "delete  from send_msg where user_id=$sender and dest_id=$receiver"; 
$del1=$result=$con->QUERY_RUN($con,$sql);	
$sql = "delete  from send_msg where dest_id=$sender and user_id=$receiver"; 
$del2=$result=$con->QUERY_RUN($con,$sql);
if ($del1||$del2){
  echo('{"msg_del":[{"MSGS_ZOOM":"1"}]');
}
  else { 
                echo('{"msg_del":[{"MSGS_ZOOM":"0"}]');
  }
}

function CITYS($con){
$word=$_GET['word'];
$nowCity=$_GET['nowCity'];
if(strcmp($nowCity,"null")==0) $nowCity=0;
$sql = "SELECT * from city where city like '%$word%' and city_id !=$nowCity";

    $resultArray = array();
    $tempArray = array();
    if ($result=$con->QUERY_RUN($con,$sql))
    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo $t;
}


function PROVS($con){
$sql = "SELECT * from province ";
if ($result=$con->QUERY_RUN($con,$sql)){
  $row = $result->fetch_object();
}
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2) echo $t;

}

function MSGS_ZOOM($con){
$msgId=$_GET['msgId'];
$sql = "SELECT * from send_msg where send_msg_id=$msgId"; 
if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
while($row = $result->fetch_object()){
    $sql_read = "update send_msg set send_msg_read=1 where send_msg_id=$msgId";
    $result_read=$con->QUERY_RUN($con,$sql_read);
    $tempArray = $row;
    array_push($resultArray, $tempArray);
}
$t=json_encode($resultArray);
if(strlen($t)!=2)  echo '{"msg_zoom":'.$t;
else echo('{"msg_zoom":[{"MSGS_ZOOM":"0"}]');
}
}
 
function Search_Service_Branch_List($con){
$word=$_GET['word'];
$sql = "SELECT * from services_branch where service_branch_title like '%$word%'and service_branch_id!=0";
if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
while($row = $result->fetch_object()){
    $branch_id=$row->service_branch_id;
    $sqlCount="SELECT *,count(*) as counts FROM `dos` INNER JOIN services on dos.service_id=services.service_id INNER JOIN services_type ON services_type.service_type_id=services.service_type_id inner JOIN services_branch on services_branch.service_branch_id=services_type.service_branch_id
    where services_type.service_branch_id=$branch_id";
    $resultCount=$con->QUERY_RUN($con,$sqlCount);
    $rowCount = $resultCount->fetch_object();
    $row->counts=$rowCount->counts;
    $tempArray = $row;
    array_push($resultArray, $tempArray);
}
$t=json_encode($resultArray);
if(strlen($t)!=2)  echo $t;
else echo('{ "service_branch":[{"user_id":"0"}]');
}}

function Search_Service_Type_List($con){
$bid=$_GET['bid'];
$service_branch_id=$_GET['bid'];
$b=intval($bid[0]);  
if(($b!=0)) ;
else {
$sql = "SELECT * from services_branch where service_branch_ename like '%$service_branch_id%' ";
$result=$con->QUERY_RUN($con,$sql);
$row = $result->fetch_object();
$bid=$row->service_branch_id;
$service_branch_id=$row->service_branch_id;
}


if($service_branch_id)
$sql = "SELECT * from services_type where service_branch_id=$service_branch_id and service_branch_id>0";
else 
$sql = "SELECT * from services_type where service_type_title like '%$word%'";

if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
while($row = $result->fetch_object()){
$branch_id=$row->service_type_id;
$sqlCount="SELECT *,count(*) as counts FROM `dos` INNER JOIN services on dos.service_id=services.service_id INNER JOIN services_type ON services_type.service_type_id=services.service_type_id 
where services.service_type_id=$branch_id";

$resultCount=$con->QUERY_RUN($con,$sqlCount);
$rowCount = $resultCount->fetch_object();
$row->counts=$rowCount->counts;

$tempArray = $row;
array_push($resultArray, $tempArray);
}

$t=json_encode($resultArray);
if(strlen($t)!=2)  echo $t;
else { 
        echo('{ "service_type":[{"user_id":"0"}]');
}}}

function Search_Service_List($con){
$word=$_GET['word'];
$service_type_id=$_GET['service_type_id'];
if($service_type_id)
    $sql = "SELECT * from services where  service_title like '%$word%' and service_type_id=$service_type_id";
else 
    $sql = "SELECT * from services where  service_title like '%$word%'";
    
if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
while($row = $result->fetch_object()){
    $tempArray = $row;
    array_push($resultArray, $tempArray);
}

$t=json_encode($resultArray);
if(strlen($t)!=2)  echo $t;
else { 
            echo('[{"service_title":""}]');
}
}
}

function USER_INFO_INNER($con,$uid){
$sql = "SELECT * from users where user_id=$uid";
if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
while($row = $result->fetch_object()){
    $tempArray = $row;
    array_push($resultArray, $tempArray);
}

$t=json_encode($resultArray);
if(strlen($t)!=2)  echo $t;
else { 
            echo('"user":[{"user_id":"0"}]');
}
}

}

function Zoom($con){
$do_id=$_GET['do_id'];
$sql = "SELECT  *  from dos where do_id=$do_id"; 
if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $row->city=CITY_ID_TO_CITY($con,$row->city_id);
	$row->province=PROV_ID_TO_PROV($con,$row->city_id);
	$S=SERV_ID_TO_SERV($con,$row->service_id);
	$row->service=$S[0];
	$row->service_type=$S[1];
        $row->service_branch=$S[2];
        $tempArray = $row;
	$Uid=$row->user_id;
        array_push($resultArray, $tempArray);
    }    
    $t=json_encode($resultArray);
    if(strlen($t)!=2) 
	{
	 echo $t;
	// USER_INFO_INNER($con,$Uid);
        }
  else { 
                echo('[{"zoom":"0"}]');
  }}}





function USER_INFO($con){
$uid=$_GET['uid'];
$sql = "SELECT * from users where user_id=$uid";//echo $sql;
if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
while($row = $result->fetch_object()){
    $tempArray = $row;
    array_push($resultArray, $tempArray);
}

$t=json_encode($resultArray);
if(strlen($t)!=2)  echo $t;
else { 
            echo('[{"user_id":"0"}]');
}
}

}

function CITY_ID_TO_CITY($con,$cityId){
$sql = "SELECT * from city where city_id=$cityId";
if ($result=$con->QUERY_RUN($con,$sql)){
  $row = $result->fetch_object();
}
return ($row->city);
}

function PROV_ID_TO_PROV($con,$cityId){
$sql = "SELECT * from province where province_id=$province_id";
if ($result=$con->QUERY_RUN($con,$sql)){
  $row = $result->fetch_object();
}
return ($row->province);
}

function SERV_ID_TO_SERV($con,$service_id){
$sql = "SELECT * from services where service_id=$service_id";//echo $sql;
if ($result=$con->QUERY_RUN($con,$sql)){
  $row = $result->fetch_object();
  $retArray[0]=$row->service_title;
  $service_type_id=$row->service_type_id;
}

$sql = "SELECT * from services_type where service_type_id=$service_type_id";//echo $sql;
if ($result=$con->QUERY_RUN($con,$sql)){
  $row = $result->fetch_object();
  $retArray[1]=$row->service_type_title;
  $service_branch_id=$row->service_branch_id;
}
$sql = "SELECT * from services_branch where service_branch_id=$service_branch_id";//echo $sql;
if ($result=$con->QUERY_RUN($con,$sql)){
  $row = $result->fetch_object();
  $retArray[2]=$row->service_branch_title;
}
return ($retArray);
}

function SERVTYPE_ID_TO_SSERVTYPE($con,$service_type_id){
$sql = "SELECT * from services_type where service_type_id=$service_type_id";//echo $sql;
if ($result=$con->QUERY_RUN($con,$sql)){
  $row = $result->fetch_object();
}
return ($row->service_type_title);
}

function SERVBANCH_ID_TO_SERVBANCH($con,$service_branch_id){
$sql = "SELECT * from services_branch where service_branch_id=$service_branch_id";//echo $sql;
if ($result=$con->QUERY_RUN($con,$sql)){
  $row = $result->fetch_object();
}
return ($row->service_branch_title);
}

function CITY_TO_CITY_ID($con,$city){
$sql = "SELECT * from city where city='$city'";
if ($result=$con->QUERY_RUN($con,$sql)){
  $row = $result->fetch_object();
}
return ($row->city_id);
}

function PRDS($con){
$madeinFiltered=$_GET['madeinFiltered'];    
$scentGroup=$_GET['scentGroup'];
$scentDiff=$_GET['scentExactFiltered'];
$scentTypeFiltered=$_GET['scentTypeFiltered'];
$perfumer=$_GET['perfumer'];  
$sex=$_GET['sex'];    
$priceCeil=$_GET['priceCeil'];
$sx=$_GET['sx'];
$branch=$_GET['branch'];
$scent=$_GET['scent'];
$cat=$_GET['cat'];
$brand=$_GET['brand'];
if($_GET['colorSetInput'])  $colorSetInput="#".$_GET['colorSetInput'];
$sizes=$_GET['sizes'];
$campaign=$_GET['campaign'];
$page=$_GET['page'];$sortParameter=$_GET['sortParameter'];$picFilter=$_GET['picFilter'];$city=$_GET['activeCity'];
$branch=$_GET['branch'];$type=$_GET['type'];$word=$_GET['word'];$rateLikeCount=$_GET['rateLikeCount'];
$userAge=$_GET['userAge'];$userSex=$_GET['userSex'];$uid=$_GET['uid'];
$priceCondition="";
if($cat){ 
$b=intval($cat[0]); 
if(($b!=0)) ;
else {
     $sql = "SELECT * from services_branch where service_branch_ename like '%$cat%' ";
     $result=$con->QUERY_RUN($con,$sql);
     $row = $result->fetch_object();
     $cat=$row->service_branch_id;
     $service_branch_id=$row->service_branch_id;
    }
}
if($type)   { 
$b=intval($type[0]);  
if(($b!=0)) ;
else {
     $sql = "SELECT * from services_type where service_type_etitle = '$type' ";
     $result=$con->QUERY_RUN($con,$sql);
     $row = $result->fetch_object();
     $TID=$row->service_type_id;
    }}
    

    
 if(($priceCeil)&&(strcmp("undefined",$priceCeil)!=0)&&(strcmp("10",$priceCeil)!=0)){
     $priceCeil*=1000000;
     $priceCondition=" and do_price-(do_price*do_certificate/100)<=$priceCeil ";

 }
 
$SxCondition="";
 if(($sx)&&(strcmp("undefined",$sx)!=0)&&(strcmp("ANY",$sx)!=0)){
     $SxCondition=" and sx='$sx' ";

 }
 
 if(strcmp($scent,"Jungle")==0)  $scent="جنگلی";else
 if(strcmp($scent,"Spicy")==0)  $scent="تند";else
 if(strcmp($scent,"Bitter")==0)  $scent="تلخ";else
 if(strcmp($scent,"Sweet")==0)  $scent="شیرین";else
 if(strcmp($scent,"Fruit")==0)  $scent="میوه ای";else
 if(strcmp($scent,"Wooden")==0)  $scent="چوبی";else
 if(strcmp($scent,"Hot")==0)  $scent="گرم";else
 if(strcmp($scent,"Cold")==0)  $scent="خنک";else 
 $scentCondition="";
if(($scent)&&(strcmp("undefined",$scent)!=0)&&(strcmp("ANY",$scent)!=0)){
    $scentCondition=" and nature='$scent' ";

 }
 
 
 $scentTypeFilteredCondition_="'".$scentTypeFiltered."'";
 $scentTypeFilteredCondition="and  dos.nature=".$scentTypeFilteredCondition_."";
 if($scentTypeFiltered=='') $scentTypeFilteredCondition='';
 $sizeCondition_="'".$sizes."'";
 $coloCondition="  colors_dos.size='".$sizes."'";
 $sex_="'".$sex."'";
 $sexCondition="  colors_dos.sex='".$sex_."'";
 $pperfumer_="'".$perfumer."'";
 $perfumerCondition="  colors_dos.perfumer='".$perfumer_."'";
 $scentDiff_="'".$scentDiff."'";
 $scentDiff_Condition="  colors_dos.scet='".$scentDiff_."'";
 $scentGroup_="'".$scentGroup."'";
 $scentGroupCondition="  colors_dos.scentGroup='".$scentGroup_."'";
 if($colorSetInput){
   $coloCondition="  colors_dos.color='".$colorSetInput."'";
 }
 $madeinCondition="";
  if(($madeinFiltered)&&(strcmp("undefined",$madeinFiltered)!=0)&&(strcmp("ANY",$madeinFiltered)!=0)){
     $madeinCondition=" and do_location='$madeinFiltered' ";
 }
 $brandCondition="";
  if(($brand)&&(strcmp("undefined",$brand)!=0)&&(strcmp("ANY",$brand)!=0)){
     $brandCondition=" and brands='$brand' ";
 }
if((strcmp($word,"undefined")!=0)&&($word)){
   $brand="undefined";
   $sizes=0;
   $colorSetInput=0;
}

if($colorSetInput=='') $colorSetInput=0;
if(strcmp($userSex,"undefined")==0) $userSex=0;
if(strcmp($word,"undefined")==0) $word="";
if(strcmp($sortParameter,"undefined")==0) $sortParameter="order by dos.do_id desc";
else 
if(strcmp($sortParameter,"last_price desc")==0)
$sortParameter="order by ".$sortParameter;
else
$sortParameter="order by dos.".$sortParameter;
if(strcmp($rateLikeCount,"undefined")==0) $rateLikeCount=0;
if(strcmp($userAge,"undefined")==0) $userAge=0;
if(strcmp($page,"undefined")==0) $page=0;
//if(strcmp($city,"null")==0) $city=82;

$pageStart=$page*20;
if((strcmp($city,"undefined")!=0)&&(strcmp($city,"")!=0)&&(strcmp($city,"null")!=0)){

//$city_id= CITY_TO_CITY_ID($con,$city);
$query_sql=" where city_id=$city and do_active=1";
}
else   
$query_sql=" where city_id!=3300 and do_active=1";
if($campaign&&(strcmp($campaign,"0")!=0)){
    $query_sql_=" and do_campaign=".$campaign;
}
$colorDosFlag=false;
$intersectColorDos1="INNER JOIN (select DISTINCT do_id from colors_dos where do_id>0 ";
$intersectColorDos2=")co on co.do_id=dos.do_id";
if($sex) { $colorDosFlag=true; $sexCond=" and sex='".$sex."'";
}
if($scentDiff) {$colorDosFlag=true;  $scentDiffCond=" and scent='".$scentDiff."'";
}
if($sizes) {$colorDosFlag=true;  $sizeCond=" and size='".$sizes."'";
}
if($colorSetInput) { $colorDosFlag=true; $colorCond=" and color='".$colorSetInput."'";
}
if($scentGroup)  {$colorDosFlag=true; $scentGroupCond=" and scentGroup='".$scentGroup."'";
}
if($perfumer) {$colorDosFlag=true;  $perfumerCond=" and perfumer='".$perfumer."'";
}

$intersectColorDos=$intersectColorDos1.$sexCond.$sizeCond.$scentDiffCond.$colorCond.$scentGroupCond.$perfumerCond.$intersectColorDos2;
if(!$colorDosFlag) $intersectColorDos="";
$type=$_GET['type'];
if(($cat)&&(strcmp("undefined",$cat)!=0)){
if(($type)&&(strcmp("undefined",$type)!=0)){    
 $sql="SELECT dos.do_price-(dos.do_price*dos.do_certificate/100) as last_price,dos.* FROM dos
 INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id 
 ".$intersectColorDos." 
 where do_active=1  $scentTypeFilteredCondition $SxCondition $madeinCondition $brandCondition $scentCondition $priceCondition and (service_title like '%".$word."%'  or service_etitle like '%".$word."%') and service_etitle like '%".$word."%' and services_type.service_type_id=".$TID;
 }else{  
  $sql="SELECT dos.do_price-(dos.do_price*dos.do_certificate/100) as last_price,dos.* FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id 
 ".$intersectColorDos." 
 where city_id!=3300 and do_active=1  $scentTypeFilteredCondition $SxCondition $madeinCondition $brandCondition $scentCondition $priceCondition and (service_title like '%".$word."%'  or service_etitle like '%".$word."%')   and service_branch_id=".$cat;
}
}
else{
if(($type)&&(strcmp("undefined",$type)!=0)){ 
$sql="SELECT dos.do_price-(dos.do_price*dos.do_certificate/100) as last_price,dos.* FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id 
 ".$intersectColorDos." 
 where city_id!=3300 and do_active=1  $scentTypeFilteredCondition  $SxCondition $madeinCondition $brandCondition $scentCondition $priceCondition and (service_title like '%".$word."%'  or service_etitle like '%".$word."%') and services_type.service_type_id=".$type;
 }else{
  $sql="SELECT dos.do_price-(dos.do_price*dos.do_certificate/100) as last_price,dos.* FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id 
 ".$intersectColorDos." 
 where city_id!=3300 and do_active=1  $scentTypeFilteredCondition $SxCondition $madeinCondition $brandCondition $scentCondition $priceCondition and (service_title like '%".$word."%'  or service_etitle like '%".$word."%')";
  
}
}


if($branch){
 $sql=
"SELECT dos.do_price-(dos.do_price*dos.do_certificate/100) as last_price,dos.* FROM `dos` INNER JOIN services on dos.service_id=services.service_id INNER JOIN services_type ON services_type.service_type_id=services.service_type_id inner JOIN services_branch on services_branch.service_branch_id=services_type.service_branch_id
where services_type.service_branch_id=$branch
";
}
$sql=$sql." ".$query_sql_." ".$sortParameter;
if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
$len=0;
while($row = $result->fetch_object()){
$len++;
$sId=$row->service_id;
$uId=$row->user_id;
$doId=$row->do_id;

$row->dos_escent=$row->nature;
if(strcmp($row->nature,"تند"))
$row->dos_escent="Spicy";else
if(strcmp($row->nature,"شیرین"))
$row->dos_escent="Sweet";else
if(strcmp($row->nature,"گرم"))
$row->dos_escent="Warm";else
if(strcmp($row->nature,"میوه ای"))
$row->dos_escent="Fruit";else
if(strcmp($row->nature,"جنگلی"))
$row->dos_escent="Jungle";else    
if(strcmp($row->nature,"تلخ"))
$row->dos_escent="spicy";else
if(strcmp($row->nature,"چوبی"))
$row->dos_escent="Wood";else
if(strcmp($row->nature,"خنک"))
$row->dos_escent="Cold";else
if(strcmp($row->nature,"ملایم"))
$row->dos_escent="Soft";

if(strcmp($row->sx,"SPORT")==0)
$row->sx_new="MEN/WOMEN";
else
$row->sx_new=$row->sx;      



            
$sql_service = "select * from wishlist where do_id=$doId and user_id=$uid";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$rowwishlist = $result_service->fetch_object();
$row->wishlist_exists =$rowwishlist->wishlist_id ;
if(!$rowwishlist->wishlist_id)$row->wishlist_exists=0;
else
if($rowwishlist->wishlist_id)$row->wishlist_exists=1;

}

$colorString="00000000000000000000";
$sql_service = "select * from colors_dos where do_id=$doId";
if ($result_service=$con->QUERY_RUN($con,$sql_service))
while($rowColors = $result_service->fetch_object()){  
$row->scentGroup=$rowColors->scentGroup; 
$row->sex=$rowColors->sex;       
$row->perfumer=$rowColors->perfumer;       

$row->dos_sizeEx=$rowColors->size;  
$index=$rowColors->color_id;
$colorString[$index-1]='1';
if($row->likesCount==0) $row->likesCount=1;
}


$sizeString="0000000";
$sql_service = "select distinct size from colors_dos where do_id=$doId";
$indexSize=0;
if ($result_service=$con->QUERY_RUN($con,$sql_service))
while($rowSizes = $result_service->fetch_object()){  
$rsize=$rowSizes->size;
if((strcmp($rsize,"1")==0))  $sizeString[0]=1;
if((strcmp($rsize,"2")==0))  $sizeString[1]=1;
if((strcmp($rsize,"3")==0))  $sizeString[2]=1;
if((strcmp($rsize,"4")==0))  $sizeString[3]=1;
if((strcmp($rsize,"5")==0))  $sizeString[4]=1;
if((strcmp($rsize,"6")==0))  $sizeString[5]=1;
if((strcmp($rsize,"7")==0))  $sizeString[6]=1;

}
$row->sizeString=$sizeString;


$sql_service = "select count(*) as likesCount from likes where user_id1=$uId and service_id=$sId";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
    $rowCountLike = $result_service->fetch_object();
    $row->likesCount =$rowCountLike->likesCount ;
    if($row->likesCount==0) $row->likesCount=1;
}
$sql_service = "select sum(like_rate) as likesRate from likes where user_id1=$uId and service_id=$sId";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
    $rowSumRate = $result_service->fetch_object();
    $row->likesRate =$rowSumRate->likesRate ;
    if(!$rowSumRate->likesRate) $row->likesRate=1;
}
$sql_service = "select avg(like_rate) as userRate from likes where service_id=$doId";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$rowSumRate = $result_service->fetch_object();
$row->user_rate =intval($rowSumRate->userRate);
if($row->user_rate==0 ) $row->user_rate=1;
}



$sql_service = "SELECT * FROM services where service_id='$sId'";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$row_service = $result_service->fetch_object();
$row->service=$row_service->service_title;
$row->Eservice=$row_service->service_etitle;
$TID=$row_service->service_type_id;
}

    $sql_service = "SELECT * FROM services_type where service_type_id=$TID";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$row_service = $result_service->fetch_object();
$row->BRNID=$row_service->service_branch_id;
$BRNID=$row_service->service_branch_id;
}



$sId=$row->user_id;
    $sql_service = "SELECT * FROM users where user_id='$sId'";
    if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$row_service = $result_service->fetch_object();
$row->user=$row_service->user_name." ".$row_service->user_family;
$row->userEcommerce=$row_service->user_name;
$row->userEcommerceMalek=$row_service->user_family;
$row->user_prof=$row_service->user_prof;
$row->user_phone=$row_service->user_phone;
$row->user_mobile=$row_service->user_mobile;
$row->user_year=$row_service->user_year;
$row->user_comm=$row_service->user_comm;
$row->user_age=$row_service->user_age;
$row->user_email=$row_service->user_email	;
$row->user_sex=$row_service->user_sx;
$row->user_adrs=$row_service->user_adrs;
$row->user_meli=$row_service->user_meli;
$row->user_pic=$row_service->user_pic;
$row->user_active=$row_service->user_active;


}


$row->rateLikeCount=$row->likesRate/$row->likesCount;
$row->price_after=$row->do_price-($row->do_price*$row->do_certificate/100);
$row->price_after=strval($row->price_after);
$row->AED_after=intval($row->price_after/6800);      
$row->AED=intval($row->do_price/6800);
$row->USD_after=intval($row->price_after/24000);
$row->USD=intval($row->do_price/24000);    
$row->brands=$row->brands;
$tempArray = $row;
    $row->colorString=$colorString;



            array_push($resultArray, $tempArray);



}

$finalArray = array();

for($i=0;$i<$len;$i++){

if((strcmp($picFilter,"undefined")==0)||($resultArray[$i]->user_pic=="1")){ 
if((!$userAge)||($resultArray[$i]->user_age<=$userAge)){
if((!$rateLikeCount)||($resultArray[$i]->user_rate>=$rateLikeCount)){
    if((!$userSex)||(strcmp($resultArray[$i]->user_sex,$userSex)==0)){
    if($resultArray[$i]->user_active==1){
array_push($finalArray, $resultArray[$i]);
}}}}}
}

$t=json_encode($finalArray);
if(strlen($t)!=2)  echo $t;
else { 
        echo('[{"do_id":"0"}]');
}}

}


function PRDS_NEW($con){
$priceCeil=$_GET['priceCeil'];
$sx=$_GET['sx'];
$branch=$_GET['branch'];
$scent=$_GET['scent'];
$cat=$_GET['cat'];
$brand=$_GET['brand'];
$colorSetInput=$_GET['colorSetInput'];
$sizes=$_GET['sizes'];
$campaign=$_GET['campaign'];
$page=$_GET['page'];$sortParameter=$_GET['sortParameter'];$picFilter=$_GET['picFilter'];$city=$_GET['activeCity'];
$branch=$_GET['branch'];$type=$_GET['type'];$word=$_GET['word'];$rateLikeCount=$_GET['rateLikeCount'];
$userAge=$_GET['userAge'];$userSex=$_GET['userSex'];$uid=$_GET['uid'];
$priceCondition="";
if(($cat)&&(strcmp($cat,"undefined")!=0)){ 
$b=intval($cat[0]); 
if(($b!=0)) ;
else {
     $sql = "SELECT * from services_branch where service_branch_ename like '%$cat%' ";
     $result=$con->QUERY_RUN($con,$sql);
     $row = $result->fetch_object();
     $cat=$row->service_branch_id;
     $service_branch_id=$row->service_branch_id;
    }
}
if(($type)&&(strcmp($type,"undefined")!=0)){ 
$b=intval($type[0]);  
if(($b!=0)) ;
else {
     $sql = "SELECT * from services_type where service_type_etitle like '%$type%' ";
     $result=$con->QUERY_RUN($con,$sql);
     $row = $result->fetch_object();
     $type=$row->service_type_id;
     $service_branch_id=$row->service_type_id;
    }
 }
 if(($priceCeil)&&(strcmp("undefined",$priceCeil)!=0)&&(strcmp("10",$priceCeil)!=0)){
     $priceCeil*=1000000;
     $priceCondition=" and do_price-(do_price*do_certificate/100)<=$priceCeil ";

 }
 
$SxCondition="";
 if(($sx)&&(strcmp("undefined",$sx)!=0)&&(strcmp("ANY",$sx)!=0)){
     $SxCondition=" and sx='$sx' ";

 }
 
 $scentCondition="";
  if(($scent)&&(strcmp("undefined",$scent)!=0)&&(strcmp("ANY",$scent)!=0)){
     $scentCondition=" and nature='$scent' ";
 }
 if($sizes){
   if(strcmp($sizes,"100 ml")==0)  $sizeCondition_=1;
   if(strcmp($sizes,"50 ml")==0)  $sizeCondition_=2;
   if(strcmp($sizes,"Tester")==0)  $sizeCondition_=3;
   $coloCondition="  colors_dos.size=".$sizeCondition_;
 }
 
if($colorSetInput){
   $coloCondition="  colors_dos.color_id=".$colorSetInput;
 }
 
 $brandCondition="";
  if(($brand)&&(strcmp("undefined",$brand)!=0)&&(strcmp("ANY",$brand)!=0)){
     $brandCondition=" and brands='$brand' ";
 }
if((strcmp($word,"undefined")!=0)&&($word)){
   $brand="undefined";
   $sizes=0;
   $colorSetInput=0;
}
if($colorSetInput=='') $colorSetInput=0;
if(strcmp($userSex,"undefined")==0) $userSex=0;
if(strcmp($word,"undefined")==0) $word="";
if(strcmp($sortParameter,"undefined")==0) $sortParameter="order by dos.do_id desc";
else  $sortParameter="order by dos.".$sortParameter;
if(strcmp($rateLikeCount,"undefined")==0) $rateLikeCount=0;
if(strcmp($userAge,"undefined")==0) $userAge=0;
if(strcmp($page,"undefined")==0) $page=0;
$pageStart=$page*20;
if((strcmp($city,"undefined")!=0)&&(strcmp($city,"")!=0)&&(strcmp($city,"null")!=0)){
 $query_sql=" where city_id=$city and do_active=1";
}
else $query_sql=" where city_id!=3300 and do_active=1";
if((strcmp($campaign,"0")!=0)){
    $query_sql_=" and do_campaign=".$campaign;
}
if($sizes||$colorSetInput){
   $intersectColorDos=" INNER JOIN (select DISTINCT do_id from colors_dos where ".$coloCondition.")co on co.do_id=dos.do_id ";
}
if($sizes&&$colorSetInput){
  $sizeCondition=" colors_dos.size=".$sizeCondition_;
  $intersectColorDos=" INNER JOIN (select DISTINCT do_id from colors_dos where ".$coloCondition." and ".$sizeCondition.")co on co.do_id=dos.do_id ";
}
if(($cat)&&(strcmp("undefined",$cat)!=0)){
 if($type){
 $sql="SELECT * FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id 
 ".$intersectColorDos." 
 where city_id!=3300 and do_active=1 $SxCondition $brandCondition $scentCondition $priceCondition and (service_title like '%".$word."%'  or service_etitle like '%".$word."%') and service_etitle like '%".$word."%' and services_type.service_type_id=".$type;
 }else{
  $sql="SELECT * FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id 
 ".$intersectColorDos." 
 where city_id!=3300 and do_active=1 $SxCondition $brandCondition $scentCondition $priceCondition and (service_title like '%".$word."%'  or service_etitle like '%".$word."%')   and service_branch_id=".$cat;

}
}
else {
if(($type)&&(strcmp("undefined",$type)!=0)){
 $sql="SELECT * FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id 
 ".$intersectColorDos." 
 where city_id!=3300 and do_active=1  $SxCondition $brandCondition $scentCondition $priceCondition and (service_title like '%".$word."%'  or service_etitle like '%".$word."%') and services_type.service_type_id=".$type;

 }else{
  $sql="SELECT * FROM dos INNER JOIN services on dos.service_id=services.service_id 
 INNER JOIN 
 `services_type` on services_type.service_type_id=services.service_type_id 
 ".$intersectColorDos." 
 where city_id!=3300 and do_active=1 $SxCondition $brandCondition $scentCondition $priceCondition and (service_title like '%".$word."%'  or service_etitle like '%".$word."%')";
}
}
if($branch){
$sql=
"SELECT * FROM `dos` INNER JOIN services on dos.service_id=services.service_id INNER JOIN services_type ON services_type.service_type_id=services.service_type_id inner JOIN services_branch on services_branch.service_branch_id=services_type.service_branch_id
where services_type.service_branch_id=$branch
";
}
$sql=$sql." ".$query_sql_." ".$sortParameter;
if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
$len=0;
while($row = $result->fetch_object()){
$len++;
$sId=$row->service_id;
$uId=$row->user_id;
$doId=$row->do_id;
$row->dos_escent=$row->nature;
if(strcmp($row->nature,"تند"))
$row->dos_escent="Spicy";else
if(strcmp($row->nature,"شیرین"))
$row->dos_escent="Sweet";else
if(strcmp($row->nature,"گرم"))
$row->dos_escent="Warm";else
if(strcmp($row->nature,"میوه ای"))
$row->dos_escent="Fruit";else
if(strcmp($row->nature,"جنگلی"))
$row->dos_escent="Jungle";else    
if(strcmp($row->nature,"تلخ"))
$row->dos_escent="spicy";else
if(strcmp($row->nature,"چوبی"))
$row->dos_escent="Wood";else
if(strcmp($row->nature,"خنک"))
$row->dos_escent="Cold";else
if(strcmp($row->nature,"ملایم"))
$row->dos_escent="Soft";
$sql_service = "select * from wishlist where do_id=$doId and user_id=$uid";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$rowwishlist = $result_service->fetch_object();
$row->wishlist_exists =$rowwishlist->wishlist_id ;
if(!$rowwishlist->wishlist_id)$row->wishlist_exists=0;
else
if($rowwishlist->wishlist_id)$row->wishlist_exists=1;
}
$colorString="00000000000000000000";
$sql_service = "select * from colors_dos where do_id=$doId";
if ($result_service=$con->QUERY_RUN($con,$sql_service))
while($rowColors = $result_service->fetch_object()){  
$index=$rowColors->color_id;
$colorString[$index-1]='1';
if($row->likesCount==0) $row->likesCount=1;
}


$sizeString="0000000";
$sql_service = "select distinct size from colors_dos where do_id=$doId";
$indexSize=0;
if ($result_service=$con->QUERY_RUN($con,$sql_service))
while($rowSizes = $result_service->fetch_object()){  
$rsize=$rowSizes->size;
if((strcmp($rsize,"1")==0))  $sizeString[0]=1;
if((strcmp($rsize,"2")==0))  $sizeString[1]=1;
if((strcmp($rsize,"3")==0))  $sizeString[2]=1;
if((strcmp($rsize,"4")==0))  $sizeString[3]=1;
if((strcmp($rsize,"5")==0))  $sizeString[4]=1;
if((strcmp($rsize,"6")==0))  $sizeString[5]=1;
if((strcmp($rsize,"7")==0))  $sizeString[6]=1;

}
$row->sizeString=$sizeString;


$sql_service = "select count(*) as likesCount from likes where user_id1=$uId and service_id=$sId";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$rowCountLike = $result_service->fetch_object();
$row->likesCount =$rowCountLike->likesCount ;
if($row->likesCount==0) $row->likesCount=1;
}
$sql_service = "select sum(like_rate) as likesRate from likes where user_id1=$uId and service_id=$sId";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$rowSumRate = $result_service->fetch_object();
$row->likesRate =$rowSumRate->likesRate ;
if(!$rowSumRate->likesRate) $row->likesRate=1;
}
$sql_service = "select avg(like_rate) as userRate from likes where service_id=$doId";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$rowSumRate = $result_service->fetch_object();
$row->user_rate =intval($rowSumRate->userRate);
if($row->user_rate==0 ) $row->user_rate=1;
}



$sql_service = "SELECT * FROM services where service_id='$sId'";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$row_service = $result_service->fetch_object();
$row->service=$row_service->service_title;
$row->Eservice=$row_service->service_etitle;
$TID=$row_service->service_type_id;
}

$sql_service = "SELECT * FROM services_type where service_type_id=$TID";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$row_service = $result_service->fetch_object();
$row->BRNID=$row_service->service_branch_id;
$BRNID=$row_service->service_branch_id;
}



$sId=$row->user_id;
$sql_service = "SELECT * FROM users where user_id='$sId'";
if ($result_service=$con->QUERY_RUN($con,$sql_service)){
$row_service = $result_service->fetch_object();
$row->user=$row_service->user_name." ".$row_service->user_family;
$row->userEcommerce=$row_service->user_name;
$row->userEcommerceMalek=$row_service->user_family;
$row->user_prof=$row_service->user_prof;
$row->user_phone=$row_service->user_phone;
$row->user_mobile=$row_service->user_mobile;
$row->user_year=$row_service->user_year;
$row->user_comm=$row_service->user_comm;
$row->user_age=$row_service->user_age;
$row->user_email=$row_service->user_email	;
$row->user_sex=$row_service->user_sx;
$row->user_adrs=$row_service->user_adrs;
$row->user_meli=$row_service->user_meli;
$row->user_pic=$row_service->user_pic;
$row->user_active=$row_service->user_active;


}


$row->rateLikeCount=$row->likesRate/$row->likesCount;
$row->price_after=$row->do_price-($row->do_price*$row->do_certificate/100);
$row->price_after=strval($row->price_after);

$row->brands=$row->brands;
$tempArray = $row;
$row->colorString=$colorString;



    array_push($resultArray, $tempArray);



}

$finalArray = array();

for($i=0;$i<$len;$i++){

if((strcmp($picFilter,"undefined")==0)||($resultArray[$i]->user_pic=="1")){ 
if((!$userAge)||($resultArray[$i]->user_age<=$userAge)){
if((!$rateLikeCount)||($resultArray[$i]->user_rate>=$rateLikeCount)){
if((!$userSex)||(strcmp($resultArray[$i]->user_sex,$userSex)==0)){
if($resultArray[$i]->user_active==1){
array_push($finalArray, $resultArray[$i]);
}}}}}
}

$t=json_encode($finalArray);
if(strlen($t)!=2)  echo $t;
else { 
echo('[{"do_id":"0"}]');
}}

}


function CountsLike($con,$sql){

if ($result=$con->QUERY_RUN($con,$sql)	){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
 $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '"countLike":'.$t;
}
}


function CountsMsg($con,$sql){
if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
while($row = $result->fetch_object()){
$tempArray = $row;
array_push($resultArray, $tempArray);
}
$t=json_encode($resultArray);
if(strlen($t)!=2)  echo '"count":'.$t;
}
}


function MSGS($con){
$uid=$_GET['uid'];
$sql = "SELECT * from send_msg where dest_id='$uid'"; 
if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
while($row = $result->fetch_object()){

    $tempArray = $row;
    array_push($resultArray, $tempArray);
}

$t=json_encode($resultArray);
if(strlen($t)!=2)  echo $t;
else { 
            echo('"msgs":[{"user_id":"0"}]');
}
}
}



function LIKES($con){
$uid=$_GET['uid'];
$sql = "SELECT * from dos where user_id='$uid'";
if ($result=$con->QUERY_RUN($con,$sql)	){
$resultArray = array();
$tempArray = array();
while($row = $result->fetch_object()){
    $tempArray = $row;
    array_push($resultArray, $tempArray);
}

$t=json_encode($resultArray);
if(strlen($t)!=2)  echo '"like":'.$t;
else { 
            echo('[{"like":"0"}]');
}}
  }



function userApply($con){
$sx=$_GET['sx']; 
$scent=$_GET['scent'];
$certification=$_GET['certification'];
$service_etitle=$_GET['service_etitle'];
$service_type_id=$_GET['service_type_id'];  $user_id=$_GET['user_id'];  $service_title=$_GET['service_title']; 
$do_price=$_GET['do_price']; $do_location=$_GET['do_location'];  $brands=$_GET['brands'];   $do_free_time=$_GET['do_free_time'];  
$do_type_comm=$_GET['do_type_comm'];  $do_look=$_GET['do_look'];$city=$_GET['city_id'];
//$city_id= CITY_TO_CITY_ID($con,$city);

$sql = "SELECT * from services where service_title='$service_title'";
$result=$con->QUERY_RUN($con,$sql);	
$resultArray = array();
$tempArray = array();
if (!$row = $result->fetch_object()){
$service_id=$con->GET_MAX_COL('services','service_id');
$sql = "insert into services(service_id,service_title,service_etitle,service_type_id,service_active) values($service_id,'$service_title','$service_etitle',$service_type_id,0)";
$result=$con->QUERY_RUN($con,$sql);
}
else { 
$service_id=$row->service_id;
}
$do_id=$con->GET_MAX_COL('dos','do_id');
$sqlInsert = "insert into dos(do_id,user_id,service_id,do_price,do_location,do_free_time,brands,do_type_comm,do_look,city_id,do_active,do_certificate,sx,nature) 
values($do_id,$user_id,$service_id,$do_price,'$do_location','$do_free_time','$brands','$do_type_comm',$do_look,$city,0,$certification,'$sx','$scent')";
//echo  $sqlInsert;
$result=$con->QUERY_RUN($con,$sqlInsert);	

$sqlSelectCheck = "SELECT * from dos where do_id=$do_id and user_id=$user_id and service_id=$service_id";
$resultSelectCheck=$con->QUERY_RUN($con,$sqlSelectCheck);
$rowSelectCheck = $resultSelectCheck->fetch_object();
$CheckInsert=$rowSelectCheck->do_id;
if ($CheckInsert>0){
echo('[{"Applied":"'.$CheckInsert.'"}]');
}
else{
echo('[{"Applied":"0"}]');
}
}

function FORGET($con){
$mobile=$_GET['mobile'];
if($mobile[0]=='0')
$mobile=substr($mobile,1);
$sql = "SELECT *  FROM users where user_mobile='$mobile'";
$result=$con->QUERY_RUN($con,$sql);	
$resultArray = array();
$tempArray = array();
if (!$row = $result->fetch_object()){
echo('[{"user_id":"0"}]');
}
else { 
$PASS=$row->user_pass;
SMS($mobile,$PASS);

}
}


function REGISTER($con){
  $mobile=$_GET['mobile'];
  $email=$_GET['email'];
  $name=$_GET['name'];  
  $token=0;
  if(!$mobile) {$token=1;  $mobile=$_GET['email'];
}
  $pass=$mobile[rand(1,9)].$mobile[rand(1,9)].$mobile[rand(1,9)].rand(26,99);
  $sql = "SELECT *  FROM users where user_mobile='$mobile' or user_email='$email'";  
  $result=$con->QUERY_RUN($con,$sql);	
  $resultArray = array();
  $tempArray = array();
  if (!$row = $result->fetch_object()){
     
        $id=$con->GET_MAX_COL('users','user_id');
        if($token==0)
          $sql = "insert into users(user_id,user_mobile,user_pass,user_email,user_name,user_active,user_prof,user_year,user_comm,user_age,user_whatsapp,user_telegram,`user_instagram`,`user_linkedin`) 
          values($id,'$mobile','$pass','$email','$name',1,'0',0,'',0,'0','0','0','0')";
          
        else
          $sql = "insert into users(user_id,user_email,user_pass,user_name) values($id,'$mobile','$pass','$name')";
      
        if ($result=$con->QUERY_RUN($con,$sql)){
            $sql = "SELECT * FROM users where user_mobile='$mobile' or user_email='$email'";
            if ($result=$con->QUERY_RUN($con,$sql)){
                 
                //SMS($mobile,$pass);
                EMAIL($email,$row->user_pass);
                $resultArray = array();
                $tempArray = array();
                while($row = $result->fetch_object()){
                    $tempArray = $row;
                    array_push($resultArray, $tempArray);
                }
        $t=json_encode($resultArray);
                if(strlen($t)!=2)  {        echo $t;    }
            }        
            
        }
  }
  else { 
            
       $tempArray = $row;
       array_push($resultArray, $tempArray);
       $t=json_encode($resultArray);
       //SMS($mobile,$row->user_pass);
       EMAIL($email,$row->user_pass);       
       if(strlen($t)!=2)  {        echo $t;    }
  }
}



function EMAIL($email,$pass){
$to = $email;
$subject = "HTML email";
$msg = $pass;
$message = "
<html>
<head>
<title>LOGIN INFORMATION</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>PASSWORD</th>
</tr>
<tr>
<td>".$msg."/td>
</tr>
</table>
</body>
</html>
";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to,$subject,$message,$headers);
}


function SMS($mobile,$pass){
$username = "09188108019";
$password = 'AnDyMaMa!1';
$from = "+10005542";
$sex_code = "afymega43l";
$to = array($mobile);
$input_data = array("verification-code" => $pass);
$url = "https://ippanel.com/sexs/sex?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&sex_code=$sex_code";
echo $url;
$handler = curl_init($url);
curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($handler);
var_dump($response);
}


function LOGIN($con){
  $mobile=$_GET['mobile'];
  $email=$_GET['email'];

  if(strlen($mobile)==0) $mobile=$email;
  $pass=$_GET['pass'];
  $sql = "SELECT user_id,user_name,user_family FROM users where ('0'+user_mobile='$mobile' and user_pass='$pass')or(user_mobile='$mobile' and user_pass='$pass')or(user_email='$email' and user_pass='$pass')";

  $result=$con->QUERY_RUN($con,$sql);
  $rowLogin = $result->fetch_object();
  if ($rowLogin->user_id){
    $resultArray = array();
    $tempArray = array();
    {
        $uid=$rowLogin->user_id;
        $sqlU = "SELECT   *  FROM basket where user_id='$uid'";
        $result=$con->QUERY_RUN($con,$sqlU);
        $count=0;
        while($rowU = $result->fetch_object())
          $count++;
	    $row->user_name=$rowLogin->user_name." ".$rowLogin->user_family;
	    $row->basket_count=$count;
	    $row->user_id=$rowLogin->user_id;
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo $t;
    else{ 
          echo('[{"user_name":"Unauth","basket_count":0,,"user_id":"0"}]');
     }
  }
 else echo('[{"user_name":"Unauth","basket_count":0,,"user_id":"0"}]');
return $FIND;
}

function spinchange($con){
$subgrid=$_GET['pid'];
if(!$lim) $lim=50;
$sql___ = "SELECT * FROM `group2` where sub_title='$subgrid' ";
$result = mysqli_query($con, $sql___);
$row = $result->fetch_object();
$subgrid=$row ->subgrid;
$sql___ = "SELECT * FROM `products` where subgrid=$subgrid and p_active=1 order by pid desc";


if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        
        $brid=$row->brid;
        $sqlbrand = "SELECT *  FROM brands where brid=$brid";
        $resultbrand = mysqli_query($con, $sqlbrand);
        $rowbrnad = $resultbrand->fetch_object();
        $brtitle=$rowbrnad->br_title;
        $row->p_country=$brtitle;
                $row->p_price=$row->p_price-($row->p_price*$row->p_off_price/100);
        
        $row->p_comm="";
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}

return $FIND;
}


function catspin($con){
$SUBCAT=$_GET['subcat'];
if($SUBCAT)
   $sql___ = "SELECT * FROM group2  where grid=$SUBCAT and sub_active=1 order by subgrid desc";
else
   $sql___ = "SELECT * FROM group2  where sub_active=1 order by subgrid desc";

if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}

return $FIND;
}




function CONTACT($con,$PID_){
$sql___ = "SELECT tell,mobile,email,help FROM `cms`";
if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}
return $FIND;
}

function SABADHAZF($con,$pid){
    $uid=$_GET['uid'];
    $sql = "delete FROM sabad where uid=$uid and pid=$pid";
    $result = mysqli_query($con,$sql);
    if($result)    echo '{ "data":[{"pid":"1"}]}';
    return $FIND;
}

function PAYCAT($con,$pid){
$state=$_GET['state'];
$uid=$_GET['uid'];
$sql___ = "SELECT * FROM `sabad` where uid=$uid and sabad_confirm=$state";//echo $sql___;
if ($result = mysqli_query($con, $sql___)){
$resultArray = array();
$tempArray = array();
$H=0;
while($row = $result->fetch_object()){
$H=1;
$pid=$row->pid;
$sqlbrand = "SELECT * from products where pid=$pid and p_active=1";
$resultbrand = mysqli_query($con, $sqlbrand);
$rowbrnad = $resultbrand->fetch_object();
$p_title=$rowbrnad->p_title;
$row->prd=$p_title;


$row->p_price=$rowbrnad->p_price-($rowbrnad->p_price*$rowbrnad->p_off_price/100);

$uid=$row->uid;
$sqlbrand = "SELECT * from users where uid=$uid";
$resultbrand = mysqli_query($con, $sqlbrand);
$rowbrnad = $resultbrand->fetch_object();
$uid=$rowbrnad->user_mobile;
$row->uid=$uid;              

$tempArray = $row;
array_push($resultArray, $tempArray);
}
$t=json_encode($resultArray);
if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}
if($H==0) echo ('{ "data":[]}');

return $FIND;
}






function SABADCAT($con,$pid){
$sql___ = "SELECT * FROM `sabad` where uid=$pid and sabad_confirm=0";//echo $sql___ ;
if ($result = mysqli_query($con, $sql___)){
$resultArray = array();
$tempArray = array();
$H=0;
while($row = $result->fetch_object()){
$H=1;
$pid=$row->pid;
$sqlbrand = "SELECT * from products where pid=$pid  and p_active=1";
$resultbrand = mysqli_query($con, $sqlbrand);
$rowbrnad = $resultbrand->fetch_object();
$p_title=$rowbrnad->p_title;
$row->prd=$p_title;
$row->p_price=$rowbrnad->p_price-($rowbrnad->p_price*$rowbrnad->p_off_price/100);
$uid=$row->uid;
$sqlbrand = "SELECT * from users where uid=$uid";
$resultbrand = mysqli_query($con, $sqlbrand);
$rowbrnad = $resultbrand->fetch_object();
$uid=$rowbrnad->user_mobile;
$row->uid=$uid;    
$tempArray = $row;
array_push($resultArray, $tempArray);
}
$t=json_encode($resultArray);
if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}
if($H==0) echo ('{ "data":[{"sabad_id":"-1"}]}');
return $FIND;
}




function SABADREG($con,$uid,$pid,$count){
include("../connection.php");
$connect=new connection;
$connect->database="topiksho_topic";
$connect->user="topiksho_utopic";
$connect->CONNECT_DB();
$sid=$connect->GET_MAX_COL('sabad','sabad_id');$sid++;

$sql= "SELECT sabad_id FROM sabad where uid=$uid and pid=$pid" ;
$result = mysqli_query($con, $sql);
$row = $result->fetch_object();
$sidUPDATE=$row->sabad_id;//echo "D".$sidUPDATE;
if($sidUPDATE){
    $sql = "update sabad set sabad_count=sabad_count+$count  where sabad_id=$sidUPDATE";
    $result = mysqli_query($con, $sql );
    echo '{ "data":[{"sabad_id":"1"}]}';
    return $FIND;
}
$date=date('l jS \of F Y h:i:s A');
$sql = "insert into sabad values($sid,$uid,$pid,'$date','$time',$count,1,0)";
if ($result = mysqli_query($con, $sql )){
    $sql___ = "SELECT sabad_id FROM sabad where sabad_id=$sid";
    if ($result = mysqli_query($con, $sql___)){
        $resultArray = array();
        $tempArray = array();
        while($row = $result->fetch_object()){
            $tempArray = $row;
            array_push($resultArray, $tempArray);
        }
        
    $t=json_encode($resultArray);
        if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
    }
}
return $FIND;
}

function UPDATEVERSION($con,$PID_){
$sql___ = "SELECT * FROM `version`";
if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}

return $FIND;
}


function PIDCAT($con,$pid){
$lim=$_GET['lim'];
if(!$lim) $lim=50;
$sql___ = "SELECT * FROM `products` where grid=$pid and p_active=1 order by pid desc";
if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        
        $brid=$row->brid;
        $sqlbrand = "SELECT *  FROM brands where brid=$brid";
        $resultbrand = mysqli_query($con, $sqlbrand);
        $rowbrnad = $resultbrand->fetch_object();
        $brtitle=$rowbrnad->br_title;
        $row->p_country=$brtitle;
                $row->p_price=$row->p_price-($row->p_price*$row->p_off_price/100);
        
        $row->p_comm="";
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}

return $FIND;
}

function PIDPRD($con,$PID_){
$CON_PIC=0;
for($i=1;$i<17;$i++){
$PIC="../prd/cats/".$PID_."/".$i.".jpg";//echo $PIC."<br>";
if(file_exists($PIC)) $CON_PIC++;
}
//echo $CON_PIC;
$sql___ = "SELECT * FROM `products` where pid=$PID_";
if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $brid=$row->brid;
        $sqlbrand = "SELECT *  FROM brands where brid=$brid";
        $resultbrand = mysqli_query($con, $sqlbrand);
        $rowbrnad = $resultbrand->fetch_object();
        $brtitle=$rowbrnad->br_title;
        $row->p_country=$brtitle;
        $row->pic_count=$CON_PIC;

        $row->p_price=$row->p_price-($row->p_price*$row->p_off_price/100);
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}

return $FIND;
}

function NEWPRD($con){
$lim=$_GET['lim'];
if($lim==0) $lim=50;
else  $lim=8;
$sql___ = "SELECT * FROM `products`  order by pid desc limit 0,$lim";
if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        
        $brid=$row->brid;
        $sqlbrand = "SELECT *  FROM brands where brid=$brid";
        $resultbrand = mysqli_query($con, $sqlbrand);
        $rowbrnad = $resultbrand->fetch_object();
        $brtitle=$rowbrnad->br_title;
        $row->p_country=$brtitle;
             //   $row->p_price=$row->p_price-($row->p_price*$row->p_off_price/100);
        if($lim==50)
          if(strcmp($row->p_active,"0")==0) 
             $row->p_title=$row->p_title.' - ???? ?? - ';       
        $row->p_comm="";
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}

return $FIND;
}

function OFFPRD($con){
$lim=$_GET['lim'];
if($lim==0) $lim=50;
else  $lim=8;
$sql___ = "SELECT * FROM `products` order by p_off_price desc limit 0,$lim";
if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $brid=$row->brid;
        $sqlbrand = "SELECT *  FROM brands where brid=$brid";
        $resultbrand = mysqli_query($con, $sqlbrand);
        $rowbrnad = $resultbrand->fetch_object();
        $brtitle=$rowbrnad->br_title;
        $row->p_country=$brtitle;
        if($lim==50)          if(strcmp($row->p_active,"0")==0)              $row->p_title=$row->p_title.' - ???? ?? - '; 
        $row->p_comm="";
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}

return $FIND;
}

function MVPRD($con){
$lim=$_GET['lim'];
if($lim==0) $lim=50;
else $lim=8;
$sql___ = "SELECT * FROM `products`  order by p_like_score desc limit 0,$lim";
if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $brid=$row->brid;
        $sqlbrand = "SELECT *  FROM brands where brid=$brid";
        $resultbrand = mysqli_query($con, $sqlbrand);
        $rowbrnad = $resultbrand->fetch_object();
        $brtitle=$rowbrnad->br_title;
        $row->p_country=$brtitle;
        if($lim==50)
          if(strcmp($row->p_active,"0")==0) 
             $row->p_title=$row->p_title.' - ???? ?? - '; 
        $row->p_comm="";
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}

return $FIND;
}

function GROUPS($con){
$sql___ = "SELECT * FROM `groups`  where group_active=1";
if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    while($row = $result->fetch_object()){
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}
return $FIND;
}

function COUNT_GROUPS($con){
$sql___ = "SELECT count(grid) as cnt FROM `groups`  where group_active=1";
if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    $row = $result->fetch_object();
    {
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}

return $FIND;
}

function SLIDE_ID($con){
$sql___ = "SELECT adrs FROM `slide`";
if ($result = mysqli_query($con, $sql___)){
    $resultArray = array();
    $tempArray = array();
    $row = $result->fetch_object();
    {
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    
    $t=json_encode($resultArray);
    if(strlen($t)!=2)  echo '{ "data":'.$t.'}';
}
return $FIND;
}
?>