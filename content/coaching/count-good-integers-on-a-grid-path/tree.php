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
            'message' => "Read the problem statement above.\nPath order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Non-decreasing', 'next' => 's2'],
                ['label' => 'Strictly increasing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 0 instead of 2.\nStep back to when you made the path strict.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Grid cell (row, col) is digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'col · 4 + row', 'next' => 'wrong_b'],
                ['label' => 'row · 4 + col', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 3 instead of 2.\nStep back to when you filled the grid column by column.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(16 · 2 · 10 · 10). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
