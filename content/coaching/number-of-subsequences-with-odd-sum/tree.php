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
            'message' => "Problem: Given an integer array, count its subsequences whose sum is odd, modulo the value the statement gives. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCount?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2^(n − 1) if some element is odd', 'next' => 's2'],
                ['label' => 'odd count · 2^(even count)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 3, 5] → 3 instead of 4.\nStep back to when you multiplied counts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Exponent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n', 'next' => 'wrong_b'],
                ['label' => 'n − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 2] → 4 instead of 2.\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). The guide’s checks → 4, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
