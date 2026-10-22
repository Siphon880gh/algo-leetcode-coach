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
            'message' => "Read the problem statement above.\nExclude grid[i][j] by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix · suffix', 'next' => 's2'],
                ['label' => 'Total product ÷ grid[i][j]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Mod 12345 you cannot divide; in example 2 the total is 0 mod 12345, so the first cell cannot come out as 2.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reduce mod 12345?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only at the end', 'next' => 'wrong_b'],
                ['label' => 'After every multiplication', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 10^5 values up to 10^9 make a product of about 9 · 10^5 digits.\nStep back to when you waited.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(nm). Examples → [[24, 12], [8, 6]], [[2], [0], [0]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
