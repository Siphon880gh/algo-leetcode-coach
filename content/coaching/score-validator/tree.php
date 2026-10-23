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
            'message' => "Read the problem statement above.\nCounter hits 10?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop', 'next' => 's2'],
                ['label' => 'Keep going', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → [0, 11] instead of [0, 10].\nStep back to when you ignored the stop.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"WD\" and \"NB\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add nothing', 'next' => 'wrong_b'],
                ['label' => 'Add 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [8, 0] instead of [10, 0].\nStep back to when you skipped extras.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [12, 1], [10, 0], [0, 10].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
