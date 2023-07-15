<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body { background: #000000; color: #ffffff}

    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div>
        <h1>home</h1>
        <?php

            $arr = [1,2,3,4,5,6,7];

            $arrAsoc = [["name" => "Laravel", "age" => 23,"gender" => "male"],["name" => "VACN", "age" => 23,"gender" => "male"],["name" => "AAA", "age" => 23,"gender" => "male"]];
            function x2($num){
                return $num*$num;
            }
            
            $newArr = array_map("x2", $arr);
            $jSon = json_encode($arrAsoc);
            $jsonEncode = json_decode($jSon);;
            print_r($newArr);
                echo "<br/>";
                echo "<br/>";

            print_r("======== json json_encode ======");
                echo "<br/>";
                print_r($jSon[0],"json[0]");
                echo getType($jSon). " ||=>  ";
                print_r($jSon);
                echo "<br/>";
                echo "<br/>";

            print_r("======== json json_decode back ==========");
                echo "<br/> ";
                print_r($jsonEncode);
                print_r($jsonEncode[0]->name);
                echo "<br/> ";
                echo "<br/> ";

            print_r("======= json array column ========");
                echo "<br/> ";
                $name  = array_column($arrAsoc, 'name');
                print_r($name);
                echo "<br/> ";
        ?>
    </div>
	<script>
		// window.onload=function(){
		// 	Echo.private('App.Models.User.1 }}')
		// 		.notification((e) => {
        //             console.log(e.message, 'e.message');
		// 		});
		// };
	</script>
</body>

</html>
