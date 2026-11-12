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
    $amount    = intdiv($kopecks, 100);
    $kopecks   = $kopecks % 100;
    $formatted = sprintf('%d.%02d', $amount, $kopecks);

    return $formatted;
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
    $filtered = array_values(
        array_filter(
            $expenses,
            fn($expense) => str_starts_with($expense['date'], $month),
        ),
    );

    return $filtered;
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