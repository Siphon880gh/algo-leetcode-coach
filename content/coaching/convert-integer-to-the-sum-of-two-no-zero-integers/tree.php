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
            'message' => "Read the problem statement above.\nReturn [1, n − 1] directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: n − 1 may contain 0', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. For n = 11, 10 contains a zero.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check which digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the last digit', 'next' => 'wrong_b'],
                ['label' => 'All digits', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A zero can be in the middle, as in 101.\nStep back to when you checked one digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Must match the sample?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any valid pair', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any valid answer is accepted.\nStep back to when you copied the sample.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Fast in practice. n = 2 → [1,1]. n = 11 → [2,9].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
