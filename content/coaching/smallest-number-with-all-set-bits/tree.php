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
            'message' => "Read the problem statement above.\nAnswer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2^b − 1', 'next' => 's2'],
                ['label' => '2^b', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 8 instead of 7.\nStep back to when you took the power of two.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n already all ones?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the next one', 'next' => 'wrong_b'],
                ['label' => 'Return n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 7 instead of 3.\nStep back to when you moved past n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 7, 15, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
