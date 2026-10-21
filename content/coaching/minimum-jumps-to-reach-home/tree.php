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
            'message' => "Read the problem statement above.\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(position, last move was backward)', 'next' => 's2'],
                ['label' => 'Position only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The same spot allows different moves depending on how you arrived.\nStep back to when you dropped the flag.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two backward jumps in a row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed', 'next' => 'wrong_b'],
                ['label' => 'Not allowed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement forbids consecutive backward jumps.\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Upper bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(max(forbidden), x) + a + b', 'next' => 'success'],
                ['label' => 'None', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Forward jumps could run forever.\nStep back to when you left it unbounded.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 3, −1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
