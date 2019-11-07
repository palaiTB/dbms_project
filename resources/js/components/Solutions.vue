<template>
    <div class="container">
        <h1>Solutions</h1>
    </div>
</template>

<script>
var data = JSON.stringify(false);

var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
  if (this.readyState === this.DONE) {
    console.log(this.responseText);
  }
});

xhr.open("POST", "https://mercury-uat.phonepe.com/v4/debit/",{headers: {'Access-Control-Allow-Origin': '*'}});
xhr.setRequestHeader("content-type", "application/json");
xhr.setRequestHeader("x-verify", "X-VERIFY");

xhr.send(data);
</script>