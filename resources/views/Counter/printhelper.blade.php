<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Iframe</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <?php
    $sale_order_id = $_GET['id'];
    $redirect = $_GET['re'];
    ?>
    <iframe id="contentFrame" src="{{ url('print') }}?id={{ $sale_order_id }}&re={{ $redirect }}" style="width: 100%; height: 400px; border: 1px solid #ccc;display:none"></iframe>
    <button id="printButton">Print</button>

    <script>
        document.getElementById('printButton').addEventListener('click', function () {
            const iframe = document.getElementById('contentFrame');
            const iframeWindow = iframe.contentWindow;

            // Open the print dialog for the iframe content
            iframeWindow.focus(); // Ensure the iframe is in focus
            iframeWindow.print();
        });
    document.addEventListener("DOMContentLoaded", function(event){
  $("#printButton").trigger('click');
});
    </script>
</body>
</html>
