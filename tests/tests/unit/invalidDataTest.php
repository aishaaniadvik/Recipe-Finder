<?php

use PHPUnit\Framework\TestCase;

class InvalidDataTest extends Testcase
{
    /** @test */
    public function testInvalidData() {
        require 'src/recipeFinder.php';
        $recipesFile= 'templates/InvalidRecipeFile.json';
        $recipesStr = file_get_contents($recipesFile);
        $recipesArr = json_decode($recipesStr);
        $ingredientsArr = [];
        $expected = [];
        $this->assertEquals($expected, matchRecipe($recipesArr, $ingredientsArr),"Please provide valid data");
    }
}

?>