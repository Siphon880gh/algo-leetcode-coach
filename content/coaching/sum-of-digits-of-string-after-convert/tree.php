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
            'message' => "Read the problem statement above.\nLetter value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a = 1 … z = 26', 'next' => 's2'],
                ['label' => 'a = 0 … z = 25', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Positions start at 1.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Convert z?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Contribute 26 as one digit', 'next' => 'wrong_b'],
                ['label' => 'Contribute digits 2 and 6', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The value is concatenated as digits.\nStep back to when you treated 26 as a digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Transforms?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly k', 'next' => 'success'],
                ['label' => 'Until one digit remains', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Stop after k rounds even if more digits remain.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 36, 6, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
