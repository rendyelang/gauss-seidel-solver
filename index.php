<?php 
if (isset($_POST['rw11']) && isset($_POST['rw12']) && isset($_POST['rw13']) && isset($_POST['eq1Cons']) && isset($_POST['rw21']) && isset($_POST['rw22']) && isset($_POST['rw23']) && isset($_POST['eq2Cons']) && isset($_POST['rw31']) && isset($_POST['rw32']) && isset($_POST['rw33']) && isset($_POST['eq3Cons']) && isset($_POST['iterarionNum'])) {
    $equation1 = array($_POST['rw11'], $_POST['rw12'], $_POST['rw13'], $_POST['eq1Cons']);
    $equation2 = array($_POST['rw21'], $_POST['rw22'], $_POST['rw23'], $_POST['eq2Cons']);
    $equation3 = array($_POST['rw31'], $_POST['rw32'], $_POST['rw33'], $_POST['eq3Cons']);
    $iteration = $_POST['iterarionNum'];


    function gaussSeidel($eq1, $eq2, $eq3, $iteration) {
        $x = 0;
        $y = 0;
        $z = 0;
        for ($i=0; $i < $iteration; $i++) { 
            $x = ($eq1[3] - ($eq1[1] * $y) - ($eq1[2] * $z)) / $eq1[0];
            $y = ($eq2[3] - ($eq2[0] * $x) - ($eq2[2] * $z)) / $eq2[1];
            $z = ($eq3[3] - ($eq3[0] * $x) - ($eq3[1] * $y)) / $eq3[2];
        }
        return array($x, $y, $z);
    }

    $result = gaussSeidel($equation1, $equation2, $equation3, $iteration);

    $resX = $result[0];
    $resY = $result[1];
    $resZ = $result[2];

    // $unComplete = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $requiredFields = [
            'rw11', 'rw12', 'rw13', 'eq1Cons',
            'rw21', 'rw22', 'rw23', 'eq2Cons',
            'rw31', 'rw32', 'rw33', 'eq3Cons',
            'iterarionNum'
        ];

        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                $unComplete = true;
                break;
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gauss Seidel Solver</title>
    <link rel="stylesheet" href="./output.css">
</head>
<body class="font-poppins">
    <div class="bg-main-bg bg-cover w-screen h-screen relative">
        <div class="absolute inset-0 bg-black opacity-80"></div>
        <div class="relative z-10">
            <div class="flex h-screen items-center justify-center">
                <div class="bg-[#242424] pt-5 md:w-[50%] h-fit md:pt-7 text-white">
                    <p class="text-center mb-4 sm:mb-7 text-base lg:text-xl font-bold">Welcome to Gauss Seidel Solver</p>
                    <div class="flex justify-center px-5 md:px-0">
                        <div>
                            <!-- <img src="" alt=""> -->
                            <form name="submit" action="" method="post">
                                <div class="grid gap-y-4">
                                    <div class="grid grid-rows-3 gap-y-5 justify-items-center">
                                        <div class="">
                                            <input class="inpStyle" type="number" name="rw11" placeholder="(1,1)"">
                                            <input class="inpStyle" type="number" name="rw12" placeholder="(1,2)"">
                                            <input class="inpStyle" type="number" name="rw13" placeholder="(1,3)"">
                                            <span>=</span>
                                            <input  class="inpStyle" type="number" name="eq1Cons">
                                        </div>
                                        <div class="">
                                            <input class="inpStyle" type="number" name="rw21" placeholder="(2,1)"">
                                            <input class="inpStyle" type="number" name="rw22" placeholder="(2,2)"">
                                            <input class="inpStyle" type="number" name="rw23" placeholder="(2,3)"">
                                            <span>=</span>
                                            <input  class="inpStyle" type="number" name="eq2Cons">
                                        </div>
                                        <div class="">
                                            <input class="inpStyle" type="number" name="rw31" placeholder="(3,1)"">
                                            <input class="inpStyle" type="number" name="rw32" placeholder="(3,2)"">
                                            <input class="inpStyle" type="number" name="rw33" placeholder="(3,3)"">
                                            <span>=</span>
                                            <input class="inpStyle" type="number" name="eq3Cons">
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <p class="mr-4 text-sm lg:text-base">How many iteration do you want? </p>
                                        <input  class="inpStyle" type="number" name="iterarionNum">
                                    </div>
                                    <button class="bg-blue-500 w-fit h-fit px-3 py-2 rounded-md text-sm lg:text-base">
                                        Submit
                                    </button>
                                </div>
                            </form>
    
                            <?php if (isset($unComplete)): ?>
                                <div class="mt-3">
                                    <p class="text-red-500 text-sm sm:text-base">Please fill all the fields</p>
                                </div>
                            <?php endif; ?>
        
                            <div class="grid grid-cols-3 mt-4">
                                <p>x = <?php echo isset($resX) ? round($resX, 5) : 0; ?></p>
                                <p>y = <?php echo isset($resY) ? round($resY, 5) : 0; ?></p>
                                <p>z = <?php echo isset($resZ) ? round($resZ, 5) : 0; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="border mt-5 py-2">
                        <p class="text-center text-xs text-gray-300">Developed by Rendy & Salman.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>