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
            'message' => "Read the problem statement above.\nDP over 1..n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: n up to 2·10^9', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is far too big.\nStep back to when you tabulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Eat one at a time when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whenever possible', 'next' => 'wrong_b'],
                ['label' => 'Only to reach divisibility', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Single steps are the slowest move.\nStep back to when you ate singly.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Memo size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(log² n) states', 'next' => 'success'],
                ['label' => 'O(n)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only quotients by 2 and 3 appear.\nStep back to when you sized it by n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. n = 10 → 4. n = 6 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
