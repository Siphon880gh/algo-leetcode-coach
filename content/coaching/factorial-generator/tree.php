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
            'message' => "Problem: Write a generator that, given n, yields the factorials 1!, 2!, …, n! in order. How n = 0 is handled and the limits are in the official statement. For instance, n = 5 yields 1, 2, 6, 24, 120. (Restated from memory; limits and examples may differ slightly.)\nStart the product at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 's2'],
                ['label' => '0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Everything stays 0; in Node n = 5 → 0, 0, 0, 0, 0.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At step i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yield, then multiply by i', 'next' => 'wrong_b'],
                ['label' => 'Multiply by i, then yield', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each value lags; in Node n = 5 → 1, 1, 2, 6, 24.\nStep back to when you yielded first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 5 → 1, 2, 6, 24, 120.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
