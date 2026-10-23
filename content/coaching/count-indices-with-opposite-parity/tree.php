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
            'message' => "Read the problem statement above.\nWhich j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only j > i', 'next' => 's2'],
                ['label' => 'Both sides', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [2, 2, 2, 2] instead of [2, 1, 1, 0].\nStep back to when you counted earlier indices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The same parity', 'next' => 'wrong_b'],
                ['label' => 'The other parity', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [1, 1, 0, 0] instead of [2, 1, 1, 0].\nStep back to when you used the same parity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [2, 1, 1, 0], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
