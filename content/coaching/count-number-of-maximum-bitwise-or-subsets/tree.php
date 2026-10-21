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
            'message' => "Read the problem statement above.\nMaximum possible OR?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OR of the whole array', 'next' => 's2'],
                ['label' => 'The largest element', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In [3,2,1,5] the largest is 5, but 3 | 5 = 7.\nStep back to when you took the largest element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subsets with equal values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The same subset', 'next' => 'wrong_b'],
                ['label' => 'Different by index', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2,2,2] → 7 counts each choice of indices.\nStep back to when you merged equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n ≤ 16. Enumerate all subsets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, 65536 is small', 'next' => 'success'],
                ['label' => 'No, too slow', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 2^16 subsets are cheap to check.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n). Examples → 2, 7, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
