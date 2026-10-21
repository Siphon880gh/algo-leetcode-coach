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
            'message' => "Read the problem statement above.\nUse the smallest count as X?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: take the gcd of all counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counts 4 and 6 work with X = 2, but 4 does not divide 6.\nStep back to when you used the minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the answer condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'gcd ≥ 1', 'next' => 'wrong_b'],
                ['label' => 'gcd ≥ 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every gcd is at least 1; groups need size ≥ 2.\nStep back to when you allowed 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Does the order of cards matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only the counts do', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Groups can take cards from anywhere in the deck.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1,2,3,4,4,3,2,1] → true. [1,1,1,2,2,2,3,3] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
