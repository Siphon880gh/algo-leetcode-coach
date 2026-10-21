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
            'message' => "Read the problem statement above.\nWhich is the count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first of each pair', 'next' => 's2'],
                ['label' => 'The second', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pairs are (freq, val).\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Step size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairs do not overlap.\nStep back to when you stepped by 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ freq', 'next' => 'success'],
                ['label' => 'n / 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each pair expands to freq values.\nStep back to when you used n / 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(output). [1,2,3,4] → [2,4,4,4]. [1,1,2,3] → [1,3,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
