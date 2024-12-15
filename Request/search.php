<?php
    include '../config.php';
    $requestData = json_decode(file_get_contents("php://input"), true);
    $text = $requestData['text']; //text
    $words = explode(" ", $text); //array

    // double quotation, one for the element, one for the array default quotation
    $mappedArray = array_map(function($value) {
        return "'$value'"; 
    }, $words); 

     //we removed split it so the array quotation is gone. We're left with single quotation and we added the parenthesis
    $result = '(' . implode(',', $mappedArray) . ')';

    // echo json_encode(['text' => $text, 'word' => $words, 'mapped' => $mappedArray, 'result' => $result]);

    $sql = "SELECT user_id, img, firstname, lastname FROM users WHERE firstname IN $result OR lastname IN $result";
    
    $result = $con_DB->query($sql);

    if ($result->num_rows > 0) {
        $users = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode(['success' => true, 'users' => $users]);
    } else {
        echo json_encode(['success' => false]);
    }
?>