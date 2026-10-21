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
            'message' => "Read the problem statement above.\nKeep the prefix as an integer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep only r mod 5', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The prefix grows to n bits.\nStep back to when you kept the integer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next remainder after bit b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(r + b) % 5', 'next' => 'wrong_b'],
                ['label' => '(2r + b) % 5', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Appending a bit doubles the value.\nStep back to when you only added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you record?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r == 0', 'next' => 'success'],
                ['label' => 'r', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output is a list of booleans.\nStep back to when you recorded r.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [0,1,1] → [true,false,false]. [1,1,1] → [false,false,false].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
