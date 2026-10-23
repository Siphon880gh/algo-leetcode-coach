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
            'message' => "Read the problem statement above.\nPath XOR includes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every value from the root to the node', 'next' => 's2'],
                ['label' => 'Everything below the root', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [0, 5, −1, 5] instead of [0, 7, −1, 0].\nStep back to when you skipped the root.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeated XORs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each time', 'next' => 'wrong_b'],
                ['label' => 'Count once', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [0, 0, 1] instead of [0, 1, −1].\nStep back to when you kept repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log² n + q log n). Examples → [0, 1, −1], [0, 7, −1, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
