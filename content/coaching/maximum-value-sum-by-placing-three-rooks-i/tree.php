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
            'message' => "Read the problem statement above.\nStrategy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Filter candidates, then brute force', 'next' => 's2'],
                ['label' => 'Greedy largest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[2, −4, 1], [8, −4, 1], [5, 6, 6]] → 10 instead of 15.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cells per row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the best', 'next' => 'wrong_b'],
                ['label' => 'Top 3', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[3, 2, 0], [−1, 3, 6], [8, 1, 5]] leaves two best cells in one column and no valid placement, instead of 16.\nStep back to when you kept one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 4, 15, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
