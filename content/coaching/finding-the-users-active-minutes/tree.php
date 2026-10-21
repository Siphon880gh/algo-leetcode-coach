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
            'message' => "Read the problem statement above.\nRepeated minute for one user?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts once (use a set)', 'next' => 's2'],
                ['label' => 'Counts each action', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. UAM counts unique minutes.\nStep back to when you counted actions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer index for UAM u?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'u', 'next' => 'wrong_b'],
                ['label' => 'u − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The array is 1-indexed by UAM.\nStep back to when you used u.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k', 'next' => 'success'],
                ['label' => 'Number of users', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement fixes the length to k.\nStep back to when you sized by users.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(logs). Examples → [0,2,0,0,0], [1,1,0,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
