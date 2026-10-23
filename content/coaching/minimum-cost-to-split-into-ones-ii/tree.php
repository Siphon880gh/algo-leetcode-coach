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
            'message' => "Problem: You get an integer n. One operation splits a number x into two positive integers a and b with a + b = x, and costs a · b. Return the minimum total cost to break n into n ones. This version allows a much larger n than Minimum Cost to Split into Ones. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nTotal cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n(n − 1) / 2', 'next' => 's2'],
                ['label' => 'n − 1, one per split', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): n = 5 → 4 instead of 10.\nStep back to when you counted splits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Integer width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '32-bit', 'next' => 'wrong_b'],
                ['label' => '64-bit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Edge check (made-up values, run in code): n = 5 · 10^7 → −864,376,896 instead of 1,249,999,975,000,000.\nStep back to when you multiplied in 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Constructed checks → 10, 21.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
