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
            'message' => "Read the problem statement above.\nWhat signals a zero-sum run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two equal prefix sums', 'next' => 's2'],
                ['label' => 'A node with value 0 only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Runs like 1, 2, −3 sum to zero too.\nStep back to when you looked for zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Map stores which node per sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first one', 'next' => 'wrong_b'],
                ['label' => 'The last one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Jumping to the last skips the longest run.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Need a dummy head?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, with sum 0', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A run can start at the head.\nStep back to when you skipped the dummy.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,−3,3,1] → [3,1]. [1,2,3,−3,4] → [1,2,4]. [1,2,3,−3,−2] → [1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
