<?php
class connection
{	
public $host="****";
public $user="****";
public $pass="****";
public $database="****";
public function CONNECT_DB(){
 $con=mysqli_connect($this->host,$this->user,$this->pass);
 $con -> set_charset("utf8");
 $this->con=$con;
 $db=mysqli_select_db($this->con,$this->database);
 return $con;
}
public function QUERY_RUN($con,$sql){
$q=mysqli_query($this->con,$sql);
mysqli_commit($this->con);
 return $q;	
}
public function GET_MAX_COL($table,$column){
 $c=0; 
 $sql="select max($column) from $table";
 $q=mysqli_query($this->con,$sql);
 $col=mysqli_fetch_row($q);
 return $col[0]+1;
}
}