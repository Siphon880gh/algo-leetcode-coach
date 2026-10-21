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
            'message' => "Read the problem statement above.\nWhy enumerate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n ≤ 15 → 2^15 subsets', 'next' => 's2'],
                ['label' => 'n is large', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The constraint is small.\nStep back to when you dismissed brute force.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Connected test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Size ≥ 2', 'next' => 'wrong_b'],
                ['label' => 'Internal edges = size − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A chosen set of cities may be disconnected.\nStep back to when you skipped the test.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Distance inside the subtree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same as in the tree', 'next' => 'success'],
                ['label' => 'Recompute with BFS per subset', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Tree paths are unique, so precomputed distances are exact.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n²). Examples → [3,4,0], [1], [2,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
