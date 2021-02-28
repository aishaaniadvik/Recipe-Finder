<?php

use PHPUnit\Framework\TestCase;

class OrderTakeOutTest extends Testcase
{
   /** @test */
    public function testOrderTakeOut() {
        require 'src/recipeFinder.php';
        $recipesFile = 'templates/ValidRecipeFile.json';
        $recipesStr  = file_get_contents($recipesFile);
        $recipesArr  = json_decode($recipesStr, true);
        $ingredientsArr  = 
        [
            [
                    "item" => "bread",
                    "amount"=> 1,
                    "unit"=> "slices",
                    "useBy" => 25-07-2022
            ],
            [     
                    "item" => "cheese",
                    "amount" => 1,
                    "unit" => "slices",
                    "useBy" => 25-07-2022
            ],
        
            [
                    "item" => "butter",
                    "amount" => 50,
                    "unit" => "grams",
                    "useBy" => 25-07-2025
            ]
        ] ;
      $expected =  [];
      $this->assertEquals($expected, matchRecipe($recipesArr, $ingredientsArr));
    }
}

?>