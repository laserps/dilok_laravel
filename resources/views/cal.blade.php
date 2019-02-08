<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div id="demo"></div>
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>
    <script>
        var x = 33239.5;
        var y = 0.07;
        var z = x * y;
        {{-- z = ((z*10).toFixed(1))/10; --}}
        document.getElementById("demo").innerHTML =
        "value : " + OtoFixed(2326.755, 2);

        function OtoFixed(num, pre) {
            return ((Math.round(num*(Math.pow(10, pre))))/Math.pow(10, pre)).toFixed(pre);
        }
    </script>
    
</body>
</html>