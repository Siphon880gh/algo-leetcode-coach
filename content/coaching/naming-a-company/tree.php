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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Group suffixes by first letter', 'next' => 's2'],
                ['label' => 'Test every pair of names', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 5 · 10^4 names give over 10^9 pairs.\nStep back to when you tested every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sizes to multiply for letters a and b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Full group sizes', 'next' => 'wrong_b'],
                ['label' => 'Group sizes minus their common suffixes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A shared suffix swaps into an existing name; Example 1 → 10 instead of 6.\nStep back to when you used full sizes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order of A and B?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count both orders', 'next' => 'success'],
                ['label' => 'Count each pair once', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A B and B A are different names; Example 1 → 3 instead of 6.\nStep back to when you counted once.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26² · L + Σ |w|). Examples → 6, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
