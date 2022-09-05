<?php
$conn = mysqli_connect('localhost', 'root', '12345', 'practice');
if (!$conn) {
    echo "Connection Error : " . mysqli_connect_error();
}
$state = "SELECT * FROM `state`";
$state_query = mysqli_query($conn, $state);

if (isset($_GET['state_id']) && !empty($_GET['state_id'])) {
    $state_id = $_GET['state_id'];
    $district = "SELECT * FROM `district` WHERE `state_id`=" . $state_id;
    $district_query = mysqli_query($conn, $district);

    $html = [];
    while($row=mysqli_fetch_assoc($district_query)){
        $arr = ['id'=>$row['districtid'],'name'=>$row['district_title']];
        array_push($html,$arr);
    }
    echo json_encode($html);
}

if (isset($_GET['district_id']) && !empty($_GET['district_id'])) {
    $district_id = $_GET['district_id'];
    $city = "SELECT * FROM `city` WHERE `districtid`=" . $district_id;
    $city_query = mysqli_query($conn, $city);

    $html = [];
    while($row=mysqli_fetch_assoc($city_query)){
        $arr = ['id'=>$row['id'],'name'=>$row['name']];
        array_push($html,$arr);
    }
    echo json_encode($html);
}
