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
            'message' => "Read the problem statement above.\nEqual frequencies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller value', 'next' => 's2'],
                ['label' => 'Larger value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2], query [0, 1, 1] → 2 instead of 1.\nStep back to when you took the larger.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest value that reaches the threshold', 'next' => 'wrong_b'],
                ['label' => 'The most frequent value if it reaches the threshold', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 2, 2], query [0, 2, 1] → 1 instead of 2.\nStep back to when you skipped the frequency.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) · √n). Examples → [1, −1, 2], [3, 2, 3, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
