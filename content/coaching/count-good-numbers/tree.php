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
            'message' => "Read the problem statement above.\nEven-index choices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '5 (0, 2, 4, 6, 8)', 'next' => 's2'],
                ['label' => '4 (excluding 0)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Leading zeros are allowed.\nStep back to when you dropped 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd-index choices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '5 including 1', 'next' => 'wrong_b'],
                ['label' => '4 primes: 2, 3, 5, 7', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1 is not prime.\nStep back to when you counted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n up to 10^15?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary exponentiation', 'next' => 'success'],
                ['label' => 'Loop n times', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That would never finish.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). Examples → 5, 400, 564908303.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
