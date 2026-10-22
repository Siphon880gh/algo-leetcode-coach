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
            'message' => "Problem: Given n, m and k, count the arrays of length n with values from 1 to m in which exactly k adjacent pairs satisfy a parity condition on the two values, modulo 10^9 + 7. The exact condition and limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nA counted pair has?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two even neighbours (as assumed)', 'next' => 's2'],
                ['label' => 'Two odd neighbours', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 3, m = 3, k = 1 → 8 instead of 4.\nStep back to when you counted odd pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Even values in 1 … m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌈m/2⌉', 'next' => 'wrong_b'],
                ['label' => '⌊m/2⌋', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 3, m = 3, k = 1 → 8 instead of 4.\nStep back to when you rounded up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k). The guide’s checks → 4, 48.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
