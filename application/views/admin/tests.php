Full working sample actually is:


<br>
<input id="message" type="text" placeholder="Message">
<br>
<input id="passphrase" type="text" placeholder="Passphrase">
<br>
<button id="bt1">Encrypt</button>
<br>
<button id="bt2">Decrypt</button>
<br><br>
<label>encrypted</label>
<div id="demo1"></div>
<br>

<label>decrypted</label>
<div id="demo2"></div>

<br>
<label>Actual Message</label>
<div id="demo3"></div>

<script>
    let encrypted = "null";

    document.getElementById("bt1").onclick = () => {
        encrypted = CryptoJS.AES.encrypt(document.getElementById("message").value, document.getElementById("passphrase").value);
        document.getElementById("demo1").innerHTML = encrypted;
    }

    document.getElementById("bt2").onclick = () => {
        let decrypted = CryptoJS.AES.decrypt(encrypted, document.getElementById("passphrase").value);
        document.getElementById("demo2").innerHTML = decrypted;
        document.getElementById("demo3").innerHTML = decrypted.toString(CryptoJS.enc.Utf8);
    }
</script>

<br>
<br>
<br>
<br>

<?php 
var_dump(json_decode("{\"jdvbno\":\"jhyfjhf\"}"))
 ?>