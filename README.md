# PHP - basic

This is a learning project for studying the basics of PHP: variables and arrays, functions, strict typing, `match`, string formatting, and working with command-line arguments. Includes simple labs in directory ./lab  for representation the results of the experiment with the basics of PHP, and includes NOTES.md for description of results (forecasting and conclusions in labs).

## Expenses.php (CLI)

A command-line PHP script for personal expense reports: totals by category, top categories, and the total for a single category.

### Features

- Report by category for all time or for a given month
- Top categories by total spending
- Total spending for a specific category
- Amounts are stored in kopecks (integers), so there are no `float` rounding errors

### Requirements

- PHP 8.0 or higher (using PHP 8.5.12RC1 (cli) on docker environment)
- Run from the command line (CLI)

## Project structure

```
php-basics/             
├── expenses.php                # The main script
├── lab/                        # Direcory with labs
├── NOTES.md                    # Forecasting and conclusions in labs
├── README.md
└── .gitignore
```
## Installation

```bash
git clone <repository-URL>
cd php-basics
```
## Usage for Expenses.php

```bash
php expenses.php report [YYYY-MM]
php expenses.php top [N]
php expenses.php category <name>
```

### Examples

Report for all time:

```bash
php expenses.php report
```

```
Расходы за всё время
Category         Amount
-----------------------
health          1199.00
food             820.85
fun              390.40
transport        390.40
-----------------------
Total           2800.65
```

Report for October 2026:

```bash
php expenses.php report 2026-10
```

```
Расходы за 2026-10
Category         Amount
-----------------------
health          1199.00
food             570.85
fun              390.40
transport        390.40
-----------------------
Total           2550.65
```

Top categories:

```bash
php expenses.php top
```

```
1. health - 1199.00
2. food - 820.85
3. fun - 390.40
```

Total for a category:

```bash
php expenses.php category food
```

```
food: 820.85
```

> Note: the report titles are currently printed in Russian ("Расходы за ..." means: Expenses for ...").

## LABS
- NOTES.md - description of results (expected, received, conclusion);
- lab1.php - Theme: floating point numbers;
- lab2.php - Theme: comparison operator == vs === ;
- lab3.php - Theme: declaration of strict_types;
- lab4.php - Theme: bytes and symbols;
- lab5.php - Theme: Arguments command line.

## Usage for Labs
lab1-5.php
```bash
cd lab
php labX.php #Where X is the lab number  
```

