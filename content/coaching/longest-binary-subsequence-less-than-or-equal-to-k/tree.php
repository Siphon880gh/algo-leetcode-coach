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
            'message' => "Read the problem statement above.\nWhich 0s?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of them', 'next' => 's2'],
                ['label' => 'Only those right of the kept 1s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Leading zeros add nothing to the value; Example 1 → 2 instead of 5.\nStep back to when you dropped the left 0s.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which 1s first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leftmost first', 'next' => 'wrong_b'],
                ['label' => 'Rightmost first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. s = 111, k = 4 → 1 instead of 2: the leftmost 1 alone costs 4.\nStep back to when you started from the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Keep a 1 while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'value + 2^b ≤ k', 'next' => 'success'],
                ['label' => 'value + 2^b < k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal to k is allowed; Example 2 → 5 instead of 6.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
