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
            'message' => "Read the problem statement above.\nEnumerate all 2^40 subsets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, split into halves of 2^20', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 2^40 is about 10^12.\nStep back to when you enumerated everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Neighbours to check after bisect?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only R[i]', 'next' => 'wrong_b'],
                ['label' => 'R[i] and R[i − 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The closest value may be just below the target.\nStep back to when you checked one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Empty subsequence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed (sum 0)', 'next' => 'success'],
                ['label' => 'Excluded', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement allows removing all elements.\nStep back to when you excluded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^(n/2) · n). Examples → 0, 1, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
