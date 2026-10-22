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
            'message' => "Read the problem statement above.\nReachable when the gcd is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A power of two', 'next' => 's2'],
                ['label' => 'Exactly 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Doubling multiplies the gcd by 2; (4, 6) → false instead of true.\nStep back to when you required gcd 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test a power of two how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'g is even or 1', 'next' => 'wrong_b'],
                ['label' => 'g & (g − 1) = 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 6 is even but not a power of two; (6, 12) → true instead of false.\nStep back to when you tested evenness.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log max). Examples → false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
