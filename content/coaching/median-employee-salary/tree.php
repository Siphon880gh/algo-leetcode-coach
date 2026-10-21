<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: An employee table lists each employee's company and salary. For each company, return the rows holding the median salary: the middle row for an odd count, the two middle rows for an even count, sorting by salary and then by id. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nHow do you number the rows inside a company?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER() OVER (PARTITION BY company ORDER BY salary, id)', 'next' => 's2'],
                ['label' => 'RANK() OVER (PARTITION BY company ORDER BY salary)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. RANK gives tied salaries the same number, so positions skip and the median math breaks.\nStep back to when you used RANK.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You also need n, the size of the company. How?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GROUP BY company, then ROW_NUMBER', 'next' => 'wrong_b'],
                ['label' => 'COUNT(*) OVER (PARTITION BY company)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. GROUP BY collapses each company to one row, so the individual rows are gone.\nStep back to when you grouped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which positions are medians?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rk between n / 2 and n / 2 + 1, with real division', 'next' => 'success'],
                ['label' => 'rk = n / 2 with integer division', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. For n = 4 the medians are positions 2 and 3, and one equality keeps only one of them.\nStep back to when you used one position.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Row numbers plus the company count, keep n/2 ≤ rk ≤ n/2 + 1: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
