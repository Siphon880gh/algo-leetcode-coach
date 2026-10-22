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
            'message' => "Read the problem statement above.\nPair u with earlier v when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Their masks differ in at most one bit', 'next' => 's2'],
                ['label' => 'Their masks are equal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Odd palindromes have one odd letter; example 1 → 1 instead of 8.\nStep back to when you matched only equal masks.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Visit the nodes with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Plain recursion', 'next' => 'wrong_b'],
                ['label' => 'An explicit stack', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A path tree is 10^5 deep; Python’s default limit of 1000 raises RecursionError.\nStep back to when you recursed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 n), with 64-bit counts. Examples → 8, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
