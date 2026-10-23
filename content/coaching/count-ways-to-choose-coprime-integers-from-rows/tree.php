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
            'message' => "Read the problem statement above.\ng[d] (gcd exactly d) = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Product of divisible counts − Σ g[multiples of d]', 'next' => 's2'],
                ['label' => 'Product of divisible counts', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 4 instead of 3.\nStep back to when you skipped the subtraction.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of d?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From 1 upward', 'next' => 'wrong_b'],
                ['label' => 'From the largest value down to 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 4 instead of 3 (the multiples are not known yet).\nStep back to when you went upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(V · m · n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
