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
        $file = fopen($itemfileName, "r");
        $i=0;
        $itemArr = [];
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            if(!empty($column[0])){
                $itemArr[$i]['item']  = $column[0];
                $itemArr[$i]['amount']= $column[1];
                $itemArr[$i]['unit']  = $column[2];
                $itemArr[$i]['useBy'] = $column[3];
                $i++;
            }
        }
    }
    if(!empty($recipes) && !empty($itemArr)){
        $tonightDishArr = matchRecipe($recipes, $itemArr);
        if(!empty($tonightDishArr)){
            echo json_encode(['status' => true, 'message' => 'recipe found', 'data' => $tonightDishArr]);
        } else {
            echo json_encode(['status' => false, 'message' => 'recipe not found']);
        }
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