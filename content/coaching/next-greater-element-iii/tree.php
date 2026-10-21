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
            'message' => "Read the problem statement above.\nThe smallest larger number with the same digits is…?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The next permutation of the digits', 'next' => 's2'],
                ['label' => 'The digits sorted from largest to smallest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Descending order is the largest arrangement, not the next one up; 12345 → 54321 skips almost everything.\nStep back to when you sorted descending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First step of next permutation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the left, find the first i with d[i] < d[i + 1]', 'next' => 'wrong_b'],
                ['label' => 'From the right, find the first i with d[i] < d[i + 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Changing a digit near the left makes a big jump; the change must be as far right as possible.\nStep back to when you scanned from the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Swap d[i] with the rightmost digit larger than it, then reverse the suffix. Anything left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1 if there is no such i or the result exceeds 2^31 − 1', 'next' => 'success'],
                ['label' => 'Nothing: return the number', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer must fit in 32 bits; 2147483486 → 2147483648 overflows, so the answer is −1.\nStep back to when you returned it unchecked.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Next permutation plus the 32-bit check: O(digits) time. 12 → 21. 21 → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
