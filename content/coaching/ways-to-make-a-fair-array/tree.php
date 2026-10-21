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
            'message' => "Read the problem statement above.\nRebuild per removal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: prefix sums', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you rebuilt.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After removal, later even indices become?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Still even', 'next' => 'wrong_b'],
                ['label' => 'Odd', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Everything after shifts left by one.\nStep back to when you kept parity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Exclude nums[i] itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, from its after-sum', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The removed element counts nowhere.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,1,6,4] → 1. [1,1,1] → 3. [1,2,3] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
