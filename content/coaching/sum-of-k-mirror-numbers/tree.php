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
            'message' => "Read the problem statement above.\nWhich numbers do you test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only decimal palindromes, generated from their first half', 'next' => 's2'],
                ['label' => 'Every integer 1, 2, 3, …', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The 30th 7-mirror number is about 6.4 · 10^10, far too many integers to scan.\nStep back to when you scanned every integer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test base k how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check the decimal string again', 'next' => 'wrong_b'],
                ['label' => 'Digits by repeated division by k, compare with their reverse', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The decimal form is already a palindrome; 4 is a decimal palindrome but 100 in base 2.\nStep back to when you rechecked base 10.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sum type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. For k = 7, n = 30 the sum is about 2.4 · 10^11.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 25, 499, 20379000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
