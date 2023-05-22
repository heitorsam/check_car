<?php

    include 'cabecalho.php';


?>

<script src="teste_qr/qrcodejs-master/qrcode.min.js"></script>



<div id="qrcode"></div>

<button onclick="gerarQRCode('fred chupa pingola')">+</button>


<script>

function gerarQRCode(valor) {
  var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: valor,

    width: 128,
    height: 128

  });
}

</script>

<?php


    include 'rodape.php';


?>