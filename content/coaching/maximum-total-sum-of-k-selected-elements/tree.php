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
            'message' => "Read the problem statement above.\nMultiply when mul ≤ 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, add instead', 'next' => 's2'],
                ['label' => 'Always multiply', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 24 instead of 26.\nStep back to when you always multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest value first', 'next' => 'wrong_b'],
                ['label' => 'Largest value first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 41 instead of 43.\nStep back to when you gave the big multiplier to the small value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 26, 43, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
