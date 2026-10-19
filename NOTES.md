### PHP 8.5.12RC1 (cli)
#### LAB1
Expected:

- bool(true)   
- int(1900) because in integer drops fractional parts

Received:

- bool(false)
because 0.1 + 0.2 gives float 0.30000000000000004 (because used bin format)  and != 0.3 classical problem float numbers :flushed:

- int(1900) 

Conclusion: for store values money need to use kopecks as integer everywhere

#### LAB2
Expected:

- bool(false) compare number and non-numeric string
- bool(true) compare number and numeric-string ("01" string reduced to 1, then 1=1) If used operator === then false
- bool(true) compare number and numeric string ( but record "1e1" string with type casting equal 1*10^1 and 10=10) If I use operator === then false
- bool(true) similar with previous ("1e2" equal 1*10^2 and 20=20)
- bool(true) automatic cast types to bool (null gives false, false=false)
- bool(false) === compare types which not equally and then not compare values

Received:

- bool(false) 
- bool(true) 
- bool(true) 
- bool(true)
- bool(true)
- bool(false)

Conclusion: for get expected behavior when comparing different values with different types need to use === comparator, its never use type conversion when comparing. 
Conclusion: for get expected behavior when comparing different values with different types need to use === comparator, its never use type conversion when comparing. 

#### LAB3
#### LAB4
#### LAB5

