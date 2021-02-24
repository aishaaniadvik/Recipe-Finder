<?php
if (isset($_POST["import"])) {
    $itemfileName     = $_FILES["file"]["tmp_name"];
    // Read JSON file
    $recipeData = file_get_contents($_FILES["jsonFile"]["tmp_name"]);
    $recipes = [];
    if(!empty($recipeData)){
        //Decode JSON
        $recipes = json_decode($recipeData, true);
    }
    if ($_FILES["file"]["size"] > 0) {
        // read csv file
        $file = fopen($itemfileName, "r");
        $i=0;
        $itemArr = [];
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            //to make an array of all the recpies with their ingredients 
            if(!empty($column[0])){
                $itemArr[$i]['item']  = $column[0];
                $itemArr[$i]['amount']= $column[1];
                $itemArr[$i]['unit']  = $column[2];
                $itemArr[$i]['useBy'] = $column[3];
                $i++;
            }
        }
    }
    //to check both are arrays(item and recipe array) are not empty)
    if(!empty($recipes) && !empty($itemArr)){
        //method to match the available items with the recipe ingredients
        $tonightDishArr = matchRecipe($recipes, $itemArr);
        // to check if tonightDishArr is not empty
        if(!empty($tonightDishArr)){
            echo json_encode(['status' => true, 'message' => 'recipe found', 'data' => $tonightDishArr]);
        } else {
            //if tonightDishArr is empty, no recipe matched with the available items in the freeze
            echo json_encode(['status' => false, 'message' => 'Order Takeout']);
        }
        // if provided inputs are not valid or one of them is not valid
    } else {
        echo json_encode(['status' => false, 'message' => 'Please provide valid input']);
    }
   }


function matchRecipe($recipes, $itemArr){
    $today     = date("Y-m-d");
    $timestamp = strtotime($today);
    $tonightDishArr=[];
    foreach ($recipes as $recipe) {
        foreach($recipe['ingredients'] as $key => $value) {
            $currentDate = date("d/m/Y");
            $itemKey = array_search($value['item'], array_column($itemArr, 'item')); 
            if($itemKey >=0){
               if(($value['amount'] <= $itemArr[$itemKey]['amount']) &&
                ($value['unit'] == $itemArr[$itemKey]['unit']) &&
                 ($currentDate <= date("d/m/Y", strtotime($itemArr[$itemKey]['useBy'])))){
                    if($key == count($recipe['ingredients'])-1){
                       $tonightDishArr[] = $recipe;
                    }
           }} else {
               break;
           }
        }
    }
    return $tonightDishArr;
}
?>