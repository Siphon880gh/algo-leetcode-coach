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
            'message' => "Problem: A table records each employee's salary for each month they worked. For each employee and each such month except their most recent one, report a running total: that month's salary plus the previous two calendar months, where months not worked count as 0. Order by employee id ascending, then month descending. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWindow by row position or by month value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'RANGE BETWEEN 2 PRECEDING AND CURRENT ROW, ordered by month', 'next' => 's2'],
                ['label' => 'ROWS BETWEEN 2 PRECEDING AND CURRENT ROW', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With a gap in the months, ROWS reaches back further than three calendar months.\nStep back to when you used ROWS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which month is left out?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The latest month in the whole table', 'next' => 'wrong_b'],
                ['label' => 'Each employee\'s own latest month', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Employees stop at different months; drop the latest month per id.\nStep back to when you used the global max.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How is the output ordered?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'id ascending, then month descending', 'next' => 'success'],
                ['label' => 'id and month both ascending', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for months from latest to earliest within each employee.\nStep back to when you sorted months ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. RANGE window by month, drop each latest month, then id ASC and month DESC: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
