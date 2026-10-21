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
            'message' => "Read the problem statement above.\nDoes sorting change the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: width ignores order, so sort freely', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting only relabels positions; the max and min of every subsequence stay the same.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "In sorted order, how many subsequences have a[i] as their maximum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i + 1', 'next' => 'wrong_b'],
                ['label' => '2^i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any subset of the i smaller elements can join a[i].\nStep back to when you counted i + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The term 2^i − 2^(n−1−i) can be negative mod p. Fix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add the modulus before taking %', 'next' => 'success'],
                ['label' => 'Take the absolute value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The sign matters: it subtracts a[i] as a minimum.\nStep back to when you took the absolute value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [2,1,3] → 6. [2] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
