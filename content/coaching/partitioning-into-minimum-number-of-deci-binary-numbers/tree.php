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
            'message' => "Read the problem statement above.\nConvert to an integer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it can have 10^5 digits', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Work on characters.\nStep back to when you converted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Lower bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of digits', 'next' => 'wrong_b'],
                ['label' => 'The largest digit', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A digit d needs d numbers with a 1 there.\nStep back to when you counted digits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is it achievable?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: number k has 1 where digit ≥ k', 'next' => 'success'],
                ['label' => 'Not always', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That construction always works.\nStep back to when you doubted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len). Examples → 3, 8, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
