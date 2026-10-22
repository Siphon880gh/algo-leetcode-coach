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
            'message' => "Read the problem statement above.\nHeight after removing v?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest depth among nodes outside v’s subtree', 'next' => 's2'],
                ['label' => 'depth(v) − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Other branches can be deeper; Example 1 → [0] instead of [2].\nStep back to when you used v’s depth.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The suffix maximum starts at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'tin[v] + 1', 'next' => 'wrong_b'],
                ['label' => 'tout[v] + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That still counts v’s descendants; Example 1 → [3] instead of [2].\nStep back to when you started after tin.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Traverse how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'With an explicit stack', 'next' => 'success'],
                ['label' => 'With plain recursion', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A path-shaped tree is 10^5 deep, far past Python’s default limit of 1000.\nStep back to when you recursed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → [2], [3,2,3,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
