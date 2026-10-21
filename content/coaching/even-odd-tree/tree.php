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
            'message' => "Read the problem statement above.\nRoot level parity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Level 0: even index', 'next' => 's2'],
                ['label' => 'Level 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Levels are 0-indexed.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal neighbours on a level?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed', 'next' => 'wrong_b'],
                ['label' => 'Invalid', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Order must be strict.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Reset prev?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the start of each level', 'next' => 'success'],
                ['label' => 'Never', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Comparisons are within a level only.\nStep back to when you kept prev.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
