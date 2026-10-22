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
            'message' => "Read the problem statement above.\nCompare every pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, store arr1’s prefixes in a set', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is up to 2.5 · 10^9 pairs.\nStep back to when you compared pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shorten y how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop digits from the left (y mod 10^k)', 'next' => 'wrong_b'],
                ['label' => 'Drop digits from the right (y / 10)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That tests suffixes; example 1 → 0 instead of 3.\nStep back to when you cut from the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) · 8). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
