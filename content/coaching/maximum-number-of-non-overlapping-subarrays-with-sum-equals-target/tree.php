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
            'message' => "Read the problem statement above.\nSliding window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: negatives exist', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Negative values break shrinking.\nStep back to when you used a window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After a match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep going', 'next' => 'wrong_b'],
                ['label' => 'Reset the set to {0} and the sum to 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later subarrays must not overlap this one.\nStep back to when you kept the set.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why greedy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Earliest end leaves the most room', 'next' => 'success'],
                ['label' => 'Longest first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ending early is never worse.\nStep back to when you took the longest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,1,1,1,1], 2 → 2. [-1,3,5,1,4,2,-9], 6 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
