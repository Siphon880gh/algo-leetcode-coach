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
            'message' => "Read the problem statement above.\nIn-place update order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left to right', 'next' => 's2'],
                ['label' => 'Right to left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each value then adds only its old neighbour: example 1 → 26 instead of 56.\nStep back to when you went right to left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Closed form?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(n + k, k)', 'next' => 'wrong_b'],
                ['label' => 'C(n − 1 + k, k)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 126 instead of 56.\nStep back to when you used C(n + k, k).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n k). Examples → 56, 35.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
