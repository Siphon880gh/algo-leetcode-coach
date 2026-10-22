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
            'message' => "Read the problem statement above.\nPair values how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted, within each parity', 'next' => 's2'],
                ['label' => 'Sorted, all together', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. ±2 keeps parity, so odd cannot become even; Example 2 → 0 instead of 1.\nStep back to when you ignored parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Divide the total distance by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 'wrong_b'],
                ['label' => '4', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One operation fixes 2 up and 2 down; Example 1 → 4 instead of 2.\nStep back to when you divided by 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width for the sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It can reach 10^5 · 10^6 = 10^11.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
