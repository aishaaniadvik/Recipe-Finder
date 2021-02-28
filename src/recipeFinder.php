<?php

/**
     * date         : 24 Feb 2021
     * author       : Indu
     * description  : to import and read csv and json file after submitting and sent both the file array to matchRecipe()    
     * @return .     json object of suggested dish for tonight
     *
        **/
if (isset($_POST["import"])) {
    // Read JSON file
    $recipeData = file_get_contents($_FILES["jsonFile"]["tmp_name"]);
    //echo $recipeData;die;
    $recipes = [];
    if(!empty($recipeData)){
        //Decode JSON
        $recipes = json_decode($recipeData, true);
    }
    $itemArr = readCsv($_FILES["file"]["tmp_name"]);
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


function readCsv($itemfileName){
    //$itemfileName = $files["file"]["tmp_name"];
    $itemArr = [];
  //  if ($files["file"]["size"] > 0) {
        // read csv file
        $file = fopen($itemfileName, "r");
        $i=0;
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
    //} 
    return $itemArr;

}


/**
     * access public
     * Module Name  : Recipe Finder
     * Method       : matchRecipe.
     * date         : 24 Feb 2021
     * author       : Indu
     * description  : match the available ingredients with the recipe's ingredients.
     * param        : $recipes, $itemArr       
     * @return .     the array of suggested dish for tomight
     *
        **/
function matchRecipe($recipes, $itemArr){
    $today     = date("d-m-Y");
    $timestamp = strtotime($today);
    //echo $timestamp;die;
    $tonightDishArr=[];
    if(!empty($recipes) && !empty($itemArr)){
      foreach ($recipes as $recipe) {
        foreach($recipe['ingredients'] as $key => $value) {
            $itemKey = array_search($value['item'], array_column($itemArr, 'item')); 
            if($itemKey >=0){
              //echo strtotime($itemArr[$itemKey]['useBy'])."====";die;
               if(($value['amount'] <= $itemArr[$itemKey]['amount']) &&
                ($value['unit'] == $itemArr[$itemKey]['unit']) && (strtotime($itemArr[$itemKey]['useBy']) >= $today )){
                    if($key == count($recipe['ingredients'])-1){
                       $tonightDishArr[] = $recipe;
                    }
           }} else {
               break;
           }
        }
    }

    }
 //   print_r($tonightDishArr);die;
    return $tonightDishArr;
}
?>