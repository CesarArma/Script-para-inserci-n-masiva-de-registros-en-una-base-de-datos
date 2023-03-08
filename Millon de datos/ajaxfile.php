<?php
include('dbcon.php');
$draw = $_POST['draw'];  
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($conn,$_POST['search']['value']); // Search value
 
## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery .= " and (nombre like '%".$searchValue."%' or
            edad like '%".$searchValue."%' or
            correo like'%".$searchValue."%' or
            telefono like'%".$searchValue."%') ";
}
 
## Total number of records without filtering
$sel = mysqli_query($conn,"select count(*) as allcount from usuarios");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];
 
## Total number of records with filtering
$sel = mysqli_query($conn,"select count(*) as allcount from usuarios WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];
 
## Fetch records
$empQuery = "select * from usuarios WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
 
$data = array();
 
while($row = mysqli_fetch_assoc($empRecords)){
    $telefono = $row['telefono'];
    $telefonoarray = "$telefono";
    $data[] = array(
            "id"=>$row['id'],
            "nombre"=>$row['nombre'],
            "edad"=>$row['edad'],
            "correo"=>$row['correo'],
            "telefono"=>$telefonoarray
        );
}
 
## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);
 
echo json_encode($response);
 
?>