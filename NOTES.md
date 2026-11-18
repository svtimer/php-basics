### PHP 8.5.12RC1 (cli)
#### LAB1
Expected:

- `bool(true)   `
- `int(1900)` because in integer drops fractional parts

Received:

- `bool(false)`
because 0.1 + 0.2 gives float 0.30000000000000004 (because used bin format)  and != 0.3 classical problem float numbers

- `int(1900) `

**Conclusion:** for store values money need to use kopecks as integer everywhere

#### LAB2
Expected:

- `bool(false)` compare number and non-numeric string
- `bool(true)` compare number and numeric-string ("01" string reduced to 1, then 1=1) If used operator `===` then false
- `bool(true)` compare number and numeric string ( but record "1e1" string with type casting equal 1*10^1 and 10=10) If I use operator `===` then false
- `bool(true)` similar with previous ("1e2" equal 1*10^2 and 20=20)
- `bool(true)` automatic cast types to bool (null gives false, false=false)
- `bool(false)` `===` compare types which not equally and then not compare values

Received:
````
bool(false) 
bool(true) 
bool(true) 
bool(true)
bool(true)
bool(false)
````
**Conclusion:** for get expected behavior when comparing different values with different types need to use `===` comparator, its never use type conversion when comparing. 

#### LAB3
Expected:
- Call function `f("5")` with `declare(strict_type=1)`, return error (because "5" is numeric string, but function takes type int;
- Call function `f("5")` without  `declare(strict_type=1)`, calls the function

Received:
-  Call function f("5") with declare(strict_type=1)   
```
Fatal error: Uncaught TypeError: f(): Argument #1 ($x) must be of type int, string given, called in /lab/lab/lab3.php on line 9 and defined in /lab/lab/lab3.php:4 
Stack trace:  
#0 /lab/lab/lab3.php(9): f('5')
#1 {main}
thrown in /lab/lab/lab3.php on line 4
```
- Call function `f("5") without`  `declare(strict_type=1)`  returned EMPTY STRING

**Conclusion:** So, to use strict types without type juggle need to use `declare(strict_type=1)`

#### LAB4

Expected:
- Function `strln()` will output number of bytes (does not take into account encoding)
- Function `mb_strln()` will output  number of characters
- Function `sprintf()` return a formatted string, but counts BYTES, not CHARACTERS

Received:
````
14  
12  
14  
6  
Hello       |   
Привіт|  
Номер  |  
````
**Conclusion:** 
- Use `strln()` when important length in bytes, for example for hashes, binary data, clear ASCII
- Use `mb_strln()` when important length in characters, for example for validation user input, work with Cyrillic and other
- If you need use `sprintf()` for formating Cyrillic strings, then need to compensate for the difference between bytes and characters

#### LAB5

Expected:

When PHP script is run with arguments Hello 42. Function `php_dump($argv)` will display array containing arguments of type string 

Received:
````
array(3) {
[0]=>
string(8) "lab5.php"
[1]=>
string(5) "hello"
[2]=>
string(2) "42"
````
**Conclusion:**

`$argv` - Array of argument passed to script when running from a command line, all elements stored as array of string, first element always the name of the script

### Links to my solutions practiced PHP track on the [Exercism](https://exercism.org)

- [Booleans in PHP, Exercise: Annalyn's Infiltration](https://exercism.org/tracks/php/exercises/annalyns-infiltration/solutions/SvBOT)
- [Basics of PHP Syntax , Exercise:  Lucian's Luscious Lasagna](https://exercism.org/tracks/php/exercises/lasagna/solutions/SvBOT)
- [Arithmetic operators, integers, floating point numbers. Exercise: Pizza Pi](https://exercism.org/tracks/php/exercises/pizza-pi/solutions/SvBOT)
- [Strings, Exercise: Highschool Sweetheart](https://exercism.org/tracks/php/exercises/sweethearts/solutions/SvBOT)
- [Arrays, Variable-Length Arguments, Exercise: Language List](https://exercism.org/tracks/php/exercises/language-list/solutions/SvBOT)
- [Classes, Exercise: Windowing system](https://exercism.org/tracks/php/exercises/windowing-system/solutions/SvBOT)
- [Type Declaration, Exercise: City Office](https://exercism.org/tracks/php/exercises/city-office/solutions/SvBOT)
- [Type Juggling, Exercise: Lucky Numbers](https://exercism.org/tracks/php/exercises/lucky-numbers/solutions/SvBOT)
- [Converting a phrase to its acronym, Exercise: Acronym](https://exercism.org/tracks/php/exercises/acronym/solutions/SvBOT)
- [Conversion sequence digits, Exercise: All Your Base](https://exercism.org/tracks/php/exercises/all-your-base/solutions/SvBOT)