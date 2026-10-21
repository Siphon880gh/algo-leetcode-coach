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
            'message' => "Read the problem statement above.\nModel the puzzle as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ weight · digit = 0', 'next' => 's2'],
                ['label' => 'Column-by-column carries only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Weights turn it into one equation that is easier to search.\nStep back to when you simulated carries.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two letters, same digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed', 'next' => 'wrong_b'],
                ['label' => 'Not allowed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each letter maps to a distinct digit.\nStep back to when you reused a digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Leading letter of a multi-letter word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cannot be 0', 'next' => 'success'],
                ['label' => 'Can be 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leading zeros are forbidden.\nStep back to when you allowed 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. SEND + MORE = MONEY → true. LEET + CODE = POINT → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
