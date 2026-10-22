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
            'message' => "Problem: A table records how many orders were placed in each minute. Split the minutes into consecutive intervals of a fixed length given in the official statement, numbered from 1, and report each interval’s number with its total orders, ordered by interval number. The table, column and output names, and the interval length, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nInterval number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(minute + L − 1) / L', 'next' => 's2'],
                ['label' => 'minute / L', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Minute L falls into the next interval and numbering starts at 0; with L = 6 the check gives (0, 22), (1, 26), (2, 2).\nStep back to when you used plain division.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Aggregate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT of rows', 'next' => 'wrong_b'],
                ['label' => 'SUM of the order counts', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts minutes, not orders: (1, 6), (2, 6) instead of (1, 27), (2, 23).\nStep back to when you counted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check with L = 6 → (1, 27), (2, 23).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
