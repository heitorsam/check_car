<?php

    include 'cabecalho.php';


?>

<!DOCTYPE html>
<html>
<head>
  <style>
    .container {
      display: flex;
      justify-content: space-between;
      width: 400px;
      height: 200px;
    }
    .dropzone {
      width: 180px;
      height: 180px;
      border: 2px dashed #ccc;
      padding: 10px;
    }
    .draggable {
      width: 100px;
      height: 100px;
      background-color: #f00;
      cursor: move;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="dropzone" id="dropzone1" ondrop="drop(event)" ondragover="allowDrop(event)">
      <div class="draggable" id="draggable1" draggable="true" ondragstart="drag(event)"></div>
    </div>
    <div class="dropzone" id="dropzone2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
  </div>

  <script>
    function allowDrop(event) {
      event.preventDefault();
    }

    function drag(event) {
      event.dataTransfer.setData("text/plain", event.target.id);
    }

    function drop(event) {
      event.preventDefault();
      var data = event.dataTransfer.getData("text/plain");
      event.target.appendChild(document.getElementById(data));
    }
  </script>
</body>
</html>


</script>

<?php


    include 'rodape.php';


?>