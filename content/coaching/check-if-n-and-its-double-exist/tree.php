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
            'message' => "Read the problem statement above.\nLook for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2x and, if even, x / 2', 'next' => 's2'],
                ['label' => 'Only 2x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The larger value may come first.\nStep back to when you checked one way.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Insert before or after the check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before', 'next' => 'wrong_b'],
                ['label' => 'After', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A single 0 would match itself.\nStep back to when you inserted first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'True', 'next' => 'success'],
                ['label' => 'False', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 0 is double 0, at different indices.\nStep back to when you returned false.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [10,2,5,3] → true. [3,1,7,11] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
