<?php 
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    ob_end_flush();

    $data = [
        'name' => 'John Doe',
        'age' => 25,
        'city' => 'New York'
    ];


    $count = 0;

    $data['count'] = $count++;
    while (true) {
        echo "data: " . json_encode($data) . "\n\n";
        flush();
        sleep(5); // Adjust the interval as needed
    }

?>