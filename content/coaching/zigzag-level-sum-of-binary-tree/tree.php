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
            'message' => "Problem: You get the root of a binary tree. Visit the levels in zigzag order and return a list with one sum per level, where each level’s sum follows the statement’s rule for which nodes count. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nReading direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Alternate each level', 'next' => 's2'],
                ['label' => 'Always left to right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [5, 3, 8, 1, null, 7, 9, null, null, 2] → [5, 11, 0, 0] instead of [5, 8, 0, 0].\nStep back to when you never flipped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Missing child on the reading side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip that node', 'next' => 'wrong_b'],
                ['label' => 'Stop the level', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Same tree → [5, 8, 7, 0] instead of [5, 8, 0, 0].\nStep back to when you kept reading.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → [1, 5, 0], [5, 8, 0, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
