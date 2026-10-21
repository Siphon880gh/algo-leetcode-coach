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
            'message' => "Read the problem statement above.\nWhy binary search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'More water never helps crossing', 'next' => 's2'],
                ['label' => 'Days are sorted by row', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Monotonicity in days is the reason.\nStep back to when you gave another reason.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "BFS sources?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the top-left cell', 'next' => 'wrong_b'],
                ['label' => 'All land cells in the top row', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You may start anywhere on the top row.\nStep back to when you used one cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mid choice with lo = mid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Upper mid', 'next' => 'success'],
                ['label' => 'Lower mid', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The lower mid can loop forever.\nStep back to when you used it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rc log(rc)). Examples → 2, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
