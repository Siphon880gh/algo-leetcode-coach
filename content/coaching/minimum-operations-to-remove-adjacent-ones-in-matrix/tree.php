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
            'message' => "Problem: Given a 0-indexed binary matrix grid, one operation flips a 1 to 0. A grid is well-isolated when no 1 is 4-directionally adjacent to another 1. Return the minimum number of operations to make the grid well-isolated. For instance, [[1,1,0],[0,1,1],[1,1,1]] → 3; an all-zero 3 × 3 grid → 0; [[0,1],[1,0]] → 0. (Restated from memory; limits and examples may differ slightly.)\nWhy is the graph bipartite?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adjacent cells differ in (r + c) parity', 'next' => 's2'],
                ['label' => 'It is not; use general matching', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every 4-neighbour flips the parity of r + c, so edges always join the two colours.\nStep back to when you gave up on bipartite.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Number of flips needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of adjacent pairs', 'next' => 'wrong_b'],
                ['label' => 'The maximum matching size', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[1,1,1]] has 2 adjacent pairs, but flipping the middle 1 fixes both.\nStep back to when you counted pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Build the matching how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Augmenting paths', 'next' => 'success'],
                ['label' => 'Greedily match any free neighbour, no augmenting', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In [[1,1,1,1]], matching the middle pair first stops at 1, but the answer is 2.\nStep back to when you matched greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(V · E). Constructed checks → 3, 0, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
