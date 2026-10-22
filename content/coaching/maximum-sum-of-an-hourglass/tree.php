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
            'message' => "Read the problem statement above.\nCells in an hourglass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top three, the middle centre, bottom three', 'next' => 's2'],
                ['label' => 'The whole 3 × 3 block', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The middle row’s sides are not part of it; Example 2 → 45 instead of 35.\nStep back to when you added nine cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Middle cell for corner (i, j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(i + 1, j)', 'next' => 'wrong_b'],
                ['label' => '(i + 1, j + 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the left side; Example 2 → 34 instead of 35.\nStep back to when you used column j.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Corner rows range over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 … m − 3', 'next' => 'success'],
                ['label' => '0 … m − 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rows i + 1 and i + 2 fall off the grid.\nStep back to when you let i reach the bottom.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 30, 35.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
