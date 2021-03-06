## Recipe Finder
By importing CSV file of available items in your freeze and recipe JSON file, we can suggest you one or more dishes to be prepared tonight


### Application Requirements
- PHP 7.3+ 
- Apache 2.4+
- PHPUnit 9.0+


### Usage
To get the one or more dishes suggestions on the basis of available items in the freeze


### How to run
- Download code packet from url: https://github.com/aishaaniadvik/Recipe-Finder
  or 
- git clone https://github.com/aishaaniadvik/Recipe-Finder
- Run the Application by hitting url: http://localhost/Recipe-Finder/
- Select a ingredient csv file, csv file must be in the format (item, amount, unit, useBy). Ingredient csv file is present in Recipe-Finder/templates 
- Select a recipe json file having recipe name and ingredients json object as below. Recipe File is present in Recipe-Finder/templates
   [{ "name": "grilled cheese on toast", "ingredients": [{"item":"bread", "amount":"2", "unit":"slices" }] }]


### Tests
PHPUnit can be easily installed via Composer. For more details kindly refer below url
https://phpunit.de/getting-started/phpunit-9.html 

#### Run PHPUnit test cases with the following commands in vscode
  - open test case file in tests/tests folder
  - go to vscode terminal 
  - In terminal write command "cd tests" then press enter
  - next command "vendor/bin/phpunit"
    or
  - go to test file and press ctrl+r 



