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
            'message' => "Read the problem statement above.\nLast element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x with n − 1 in its zero bits', 'next' => 's2'],
                ['label' => 'x + n − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 8, and 7 AND 8 = 0.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Write which number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n', 'next' => 'wrong_b'],
                ['label' => 'n − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. x itself is the first element: example 1 → 7 instead of 6.\nStep back to when you wrote n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n); use 64-bit. Examples → 6, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
