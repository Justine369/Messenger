const eventSource = new EventSource('./Source.php');

eventSource.onmessage = function(event) {
    const jsonData = JSON.parse(event.data);
    console.log(jsonData);
};