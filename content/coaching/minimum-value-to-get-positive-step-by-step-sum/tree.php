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
            'message' => "Read the problem statement above.\nAnswer formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 − min(0, min prefix)', 'next' => 's2'],
                ['label' => '−min prefix', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The sum must stay at least 1.\nStep back to when you dropped the 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "All prefixes positive?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer 0', 'next' => 'wrong_b'],
                ['label' => 'Answer 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. startValue must be positive.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Binary search needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one pass', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The formula is direct.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [-3,2,-3,4,2] → 5. [1,2] → 1. [1,-2,-3] → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
