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
            'message' => "Read the problem statement above.\nCompare the strings directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: different forms can be equal', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. \"0.(9)\" and \"1.\" are equal.\nStep back to when you compared strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is 0.(R) with b repeating digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'R / 10^b', 'next' => 'wrong_b'],
                ['label' => 'R / (10^b − 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the value of one copy, not the repeating decimal.\nStep back to when you used 10^b.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare as floats with ==?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use exact fractions (or a tolerance)', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rounding can make equal values differ.\nStep back to when you used ==.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). \"0.(52)\", \"0.5(25)\" → true. \"0.1666(6)\", \"0.166(66)\" → true. \"0.9(9)\", \"1.\" → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
