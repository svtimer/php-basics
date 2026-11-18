<?php

declare(strict_types=1);

$expenses = [
    ['amount' => 25000, 'category' => 'food', 'date' => '2026-09-28'],
    ['amount' => 12050, 'category' => 'transport', 'date' => '2026-10-01'],
    ['amount' => 89900, 'category' => 'health', 'date' => '2026-10-02'],
    ['amount' => 15075, 'category' => 'food', 'date' => '2026-10-03'],
    ['amount' => 30000, 'category' => 'fun', 'date' => '2026-10-05'],
    ['amount' => 7000, 'category' => 'transport', 'date' => '2026-10-07'],
    ['amount' => 42010, 'category' => 'food', 'date' => '2026-10-09'],
    ['amount' => 30000, 'category' => 'health', 'date' => '2026-10-12'],
    ['amount' => 9040, 'category' => 'fun', 'date' => '2026-10-13'],
    ['amount' => 19990, 'category' => 'transport', 'date' => '2026-10-14'],
];

function formatMoney(int $kopecks = 0): string
{
    $amount  = intdiv($kopecks, 100);
    $kopecks = $kopecks % 100;

    return sprintf('%d.%02d', $amount, $kopecks);
}

function totalsByCategory(array $expenses): array
{
    $totals = [];
    foreach ($expenses as $item) {
        $category          = $item['category'];
        $totals[$category] = ($totals[$category] ?? 0) + $item['amount'];
    }

    return $totals;
}

function sumForCategory(array $expenses, string $category): int
{
    $filtered = array_filter(
        $expenses,
        fn($expense) => $category === $expense['category'],
    );

    return array_sum(array_column($filtered, 'amount'));
}

function filterByMonth(array $expenses, string $month): array
{
    return array_values(
        array_filter(
            $expenses,
            fn($expense) => str_starts_with($expense['date'], $month),
        ),
    );
}

function topCategories(array $expenses, int $limit = 3): array
{
    $totals = totalsByCategory($expenses);
    uksort($totals, fn($a, $b)
        => $totals[$a] === $totals[$b]
        ? strcmp($a, $b)
        : $totals[$b] <=> $totals[$a]);

    return array_slice($totals, 0, max(0, min($limit, 3)));
}

function renderReport(array $expenses, ?string $month = null): string
{
    $existDate        = $month === null || $month === "";
    $line             = str_repeat("-", 23) . PHP_EOL;
    $totalsByCategory = totalsByCategory(
        $existDate ? $expenses : filterByMonth($expenses, $month),
    );
    uksort($totalsByCategory, fn($a, $b)
        => $totalsByCategory[$a] === $totalsByCategory[$b]
        ? strcmp($a, $b)
        : $totalsByCategory[$b] <=> $totalsByCategory[$a]);
    $output = ($existDate ? 'Расходы за все время' : 'Расходы за ' . $month)
              . PHP_EOL;
    $output .= sprintf('%-15s %7s', 'Category', 'Amount')
               . PHP_EOL;
    $output .= $line;
    foreach ($totalsByCategory as $category => $amount) {
        $output .= sprintf('%-15s %7s', $category, formatMoney($amount))
                   . PHP_EOL;
    }

    $output .= $line;
    $output .= sprintf(
                   '%-15s %7s',
                   'Total',
                   formatMoney(array_sum($totalsByCategory)),
               ) . PHP_EOL;

    return $output;
}

function renderTOP(array $expenses, int $limit = 3): string
{
    $top    = topCategories($expenses, $limit);
    $num    = 0;
    $output = '';
    foreach ($top as $category => $amount) {
        ++$num;
        $output .= $num . '. ' . $category . ' - ' . formatMoney($amount)
                   . PHP_EOL;
    }

    return $output;
}

function runCommand(array $argv, array $expenses): ?string
{
    $command = $argv[1] ?? '';
    $arg     = $argv[2] ?? null;
    $limit   = $arg === null ? 3 : (int)$arg;

    return match ($command) {
        'report' => renderReport($expenses, $arg),
        'top' => renderTOP($expenses, $limit),
        'category' => ($arg === null || $arg === '')
            ? null
            : $arg . ': ' . formatMoney(sumForCategory($expenses, $arg))
              . PHP_EOL,
        default => null,
    };
}

$result = runCommand($argv, $expenses);
if ($result === null) {
    fwrite(
        STDERR,
        "Usage: php $argv[0] report [YYYY-MM] | top [N] | category <name>"
        . PHP_EOL,
    );
    exit(1);
}

echo $result;