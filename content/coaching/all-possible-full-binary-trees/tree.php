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
            'message' => "Read the problem statement above.\nn is even. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[]: a full binary tree has an odd node count', 'next' => 's2'],
                ['label' => 'Build trees anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each internal node adds two children, so the count is always odd.\nStep back to when you built trees.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which left sizes do you try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every size from 0 to n − 1', 'next' => 'wrong_b'],
                ['label' => 'Odd sizes from 1 to n − 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Even sizes and 0 produce no full subtree.\nStep back to when you tried every size.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Rebuild f(i) for each split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: cache f(n) by n', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The same sizes come up again and again.\nStep back to when you dropped the cache.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Cost proportional to the output. n = 7 → 5 trees. n = 3 → [[0,0,0]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
