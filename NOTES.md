### PHP 8.5.12RC1 (cli)
#### LAB1
Expected:
- bool(true)   
- int(1900)

Received:
- bool(false)
because 0.1 + 0.2 gives float 0.30000000000000004 (because used bin format)  and != 0.3 classical problem float numbers :flushed:
- int(1900) because in integer drops fractional parts

Conclusion: for store values money need to use kopecks as integer everywhere

#### LAB2
#### LAB3
#### LAB4
#### LAB5

