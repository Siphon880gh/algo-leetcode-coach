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
            'message' => "Problem: Given a positive integer k and two digits digit1 and digit2, return the smallest integer that is larger than k, is a multiple of k, and is written using only digit1 and/or digit2. Return −1 if no such integer exists or it does not fit in a signed 32-bit integer. For instance, k = 2 with digits 0 and 2 → 20; k = 3 with digits 4 and 2 → 24; k = 2 with digits 0 and 0 → −1. (Restated from memory; limits and examples may differ slightly.)\nSearch how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Generate numbers of the two digits, shortest first, in increasing order', 'next' => 's2'],
                ['label' => 'Test k, 2k, 3k, … one by one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer can be close to 2^31 − 1, so walking multiples can take billions of steps.\nStep back to when you walked multiples.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leading digit 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed', 'next' => 'wrong_b'],
                ['label' => 'Not allowed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 020 is just 20; leading zeros create duplicates and are not new numbers.\nStep back to when you allowed them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Accept x when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x > k, x % k == 0, x ≤ 2^31 − 1', 'next' => 'success'],
                ['label' => 'x % k == 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. x must be larger than k; for k = 2 with digits 0 and 2, 2 itself is not the answer, 20 is.\nStep back to when you only checked divisibility.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed checks → 20, 24, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
