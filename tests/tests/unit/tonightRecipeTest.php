<?php

use PHPUnit\Framework\TestCase;
class TonightRecipeTest extends Testcase
{
    /** @test */    
    public function testMatchRecipeResult() {
        require 'src/recipeFinder.php';
        $recipesFile = 'templates/ValidRecipeFile.json';
        $recipesStr  = file_get_contents($recipesFile);
        $recipesArr  = json_decode($recipesStr, true);
        $ingredientsArr = 
        [
            [
                    "item" => "bread",
                    "amount"=> 10,
                    "unit"=> "slices",
                    "useBy" => 25-07-2022
            ],
            [     
                    "item" => "cheese",
                    "amount" => 10,
                    "unit" => "slices",
                    "useBy" => 25-07-2022
            ],
            [
                    "item"=>"butter",
                    "amount" => 250,
                    "unit" => "grams",
                    "useBy" => 25-07-2025
            ]
        ] ;
      $expected =  [
          [
            "name"=> "grilled cheese on toast",
            "ingredients"=> [[
                    "item"=> "bread",
                    "amount"=> "2",
                    "unit"=> "slices"
                ],[
                        "item"=> "cheese",
                        "amount"=> "2",
                        "unit"=> "slices"
                ]]
      ]];
      $this->assertEquals($expected, matchRecipe($recipesArr, $ingredientsArr));
    //  return $expected;
       // $this->assertTrue(matchRecipe($recipesArr, $ingredientsArr));
    }
}

?>