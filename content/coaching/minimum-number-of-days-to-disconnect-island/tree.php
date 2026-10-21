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
            'message' => "Read the problem statement above.\nAlready zero or several islands?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer 0', 'next' => 's2'],
                ['label' => 'Answer 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It is already disconnected.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Upper bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unbounded', 'next' => 'wrong_b'],
                ['label' => '2: cut around a corner cell', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A corner always has at most two land neighbours.\nStep back to when you searched more.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Removing a cell leaves no land?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts as disconnected', 'next' => 'success'],
                ['label' => 'Does not count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Zero islands is not one island.\nStep back to when you excluded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example 1 → 2. [[1,1]] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
