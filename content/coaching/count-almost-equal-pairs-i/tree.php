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
            'message' => "Read the problem statement above.\nDifferent lengths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pad with leading zeros', 'next' => 's2'],
                ['label' => 'Never equal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 1 instead of 2.\nStep back to when you skipped padding.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Swaps allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly one', 'next' => 'wrong_b'],
                ['label' => 'At most one', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A one-digit number cannot swap: example 2 → 0 instead of 10.\nStep back to when you required a swap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² d²). Examples → 2, 10, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
