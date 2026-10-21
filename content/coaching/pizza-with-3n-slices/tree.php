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
            'message' => "Read the problem statement above.\nSimulate Alice and Bob's picks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any non-adjacent n-set works', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The friends' choices can always be arranged.\nStep back to when you simulated them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Handle the circle how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore adjacency of the ends', 'next' => 'wrong_b'],
                ['label' => 'Exclude the first or the last slice', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first and last slices are neighbours.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "DP state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(index, picks left)', 'next' => 'success'],
                ['label' => 'Index only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Exactly n picks are required.\nStep back to when you dropped the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len · n). [1,2,3,4,5,6] → 10. [8,9,8,6,1,1] → 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
