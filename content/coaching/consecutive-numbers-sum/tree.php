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
            'message' => "Read the problem statement above.\nLoop over the start x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: loop over the length k, about √(2n) values', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n can be 10⁹.\nStep back to when you looped over starts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does length k work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n is divisible by k', 'next' => 'wrong_b'],
                ['label' => '(n − k(k − 1)/2) is divisible by k and leaves x ≥ 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The run adds k(k − 1)/2 on top of k · x.\nStep back to when you only divided n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When does the loop stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When k(k + 1)/2 > n', 'next' => 'success'],
                ['label' => 'When k > n / 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That runs far too long; the smallest run of length k already sums to k(k + 1)/2.\nStep back to when you used n / 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√n). n = 5 → 2. n = 9 → 3. n = 15 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
