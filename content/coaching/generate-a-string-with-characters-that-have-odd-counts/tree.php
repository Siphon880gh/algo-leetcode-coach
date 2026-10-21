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
            'message' => "Read the problem statement above.\nn odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n copies of one letter', 'next' => 's2'],
                ['label' => 'Two letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One letter with an odd count already works.\nStep back to when you added a second letter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n even?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n / 2 of two letters', 'next' => 'wrong_b'],
                ['label' => 'n − 1 of one letter plus one other', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n / 2 is even when n is a multiple of 4.\nStep back to when you halved.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Must match the sample?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any valid string', 'next' => 'success'],
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
            'message' => "Correct. O(n). n = 4 → \"aaab\". n = 7 → \"aaaaaaa\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
