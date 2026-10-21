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
            'message' => "Read the problem statement above.\nLoop from 0 to n and test each number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count by the bits of n', 'next' => 's2'],
                ['label' => 'Yes: check every number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n can be 10⁹.\nStep back to when you looped over every number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many k-bit strings have no two adjacent 1s?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2^(k − 1)', 'next' => 'wrong_b'],
                ['label' => 'f[k] = f[k − 1] + f[k − 2]: a Fibonacci number', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. For k = 3 the valid strings are 000, 001, 010, 100 and 101: 5, not 4.\nStep back to when you used powers of 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Walking n from the top bit, you meet a 1 at position i. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add f[i]; stop if the bit above was also 1, else continue', 'next' => 'success'],
                ['label' => 'Add f[i] and always continue', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Once the prefix of n contains 11, nothing that keeps that prefix is valid, including n itself.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Fibonacci counts per bit, an early stop at 11, and + 1 for n itself if you never stopped: O(log n) time. n = 5 → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
