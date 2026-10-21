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
            'message' => "Read the problem statement above.\nFirst piece?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any prefix leaving at least one more piece', 'next' => 's2'],
                ['label' => 'The first digit only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The first value can have several digits.\nStep back to when you fixed one digit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leading zeros like \"004\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reject the piece', 'next' => 'wrong_b'],
                ['label' => 'Allowed; parse as 4', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pieces are compared by value.\nStep back to when you rejected leading zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Next piece must be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly previous − 1', 'next' => 'success'],
                ['label' => 'Any smaller value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Adjacent values must differ by exactly 1.\nStep back to when you allowed any decrease.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → false, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
