## Recipe Finder
By importing CSV file of available items in your freeze and recipe JSON file, we can suggest you dish to be prepared tonight


### Application Requirements
- PHP 7.3+ 
- Apache 2.4+
- PHPUnit 9.0+


### Usage
To get the one or more dishes on the basis of available items in the freeze


### How to run
- Download code packet from url: https://github.com/aishaaniadvik/Recipe-Finder
  or 
- git clone https://github.com/aishaaniadvik/Recipe-Finder
- run the Application by hitting url: http://localhost/Recipe-Finder/
- Select a ingredient csv file, csv file must be in the format (item, amount, unit, useBy). Ingredient csv file is present in Recipe-Finder/templates 
- Select a recipe json file having recipe name and ingredients json object as below. Recipe File is present in Recipe-Finder/templates
   [{ "name": "grilled cheese on toast", "ingredients": [{"item":"bread", "amount":"2", "unit":"slices" }] }]


### Tests
PHPUnit can easily be installed via Composer. For more details kindly refer below url
https://phpunit.de/getting-started/phpunit-9.html 

#### Run PHPUnit test cases with the following commands in vscode
  - cd tests
  - open test case file in tests/tests folder
  - vendor/bin/phpunit
    or
    press ctrl+r 



