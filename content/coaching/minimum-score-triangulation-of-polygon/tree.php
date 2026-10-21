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
            'message' => "Read the problem statement above.\nCut the cheapest triangle first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use interval DP', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Local choices do not give the best total.\nStep back to when you cut greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[i][i + 1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'v[i] · v[i + 1]', 'next' => 'wrong_b'],
                ['label' => '0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two vertices form no triangle.\nStep back to when you scored an edge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fill order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By increasing j − i', 'next' => 'success'],
                ['label' => 'By increasing i', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. dp[k][j] may not be ready yet.\nStep back to when you filled by i.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). [1,2,3] → 6. [3,7,4,5] → 144. [1,3,1,4,1,5] → 13.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
