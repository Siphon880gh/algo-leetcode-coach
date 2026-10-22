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
            'message' => "Read the problem statement above.\nRows are?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First row from degrees, then each cell’s unvisited neighbour', 'next' => 's2'],
                ['label' => 'BFS layers from a corner', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1’s layers are [0], [1, 2], [3], not a rectangle.\nStep back to when you used BFS layers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next row order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All unvisited neighbours, sorted', 'next' => 'wrong_b'],
                ['label' => 'Below each cell, in the same column', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [[3, 1], [0, 2]], which puts 3 above 0 though they share no edge.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + e). Examples → valid grids for all three.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
