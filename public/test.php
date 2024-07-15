<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <script src="https://sjs.zalopay.com.vn/mini-app/sdk/1.0.1/sdk.js"></script>
</head>
<body>
    <script>
        window.ZLP.init(2553, "sandboxmc").then(result => { console.log(result) }).catch(e => console.error(e))
    </script>
</body>
</html>