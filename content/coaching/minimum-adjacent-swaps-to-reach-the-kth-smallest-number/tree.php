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
            'message' => "Read the problem statement above.\nGet the target how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Next permutation k times', 'next' => 's2'],
                ['label' => 'Sort the digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting gives the smallest, not the kth larger.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which matching digit to move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any one', 'next' => 'wrong_b'],
                ['label' => 'The nearest one to the right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A farther copy costs extra and crosses an equal digit.\nStep back to when you picked any.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost of moving j to i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j − i', 'next' => 'success'],
                ['label' => '1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each adjacent swap moves it one step.\nStep back to when you counted one swap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k + n²). Examples → 2, 4, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
