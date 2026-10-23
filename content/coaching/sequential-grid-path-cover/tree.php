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
            'message' => "Problem: A grid holds the numbers 1 … k once each and 0 everywhere else. Find a path that starts anywhere, moves between side-adjacent cells, visits every cell exactly once, and meets the numbered cells in increasing order; return its cells in order, or an empty list if there is none. This guide assumes the grid is small enough for backtracking. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nStart cells?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any cell holding 0 or 1', 'next' => 's2'],
                ['label' => 'Only the cell holding 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[0, 1, 2]] → [] although a path exists.\nStep back to when you fixed the start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Allowed next cells?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any unvisited cell', 'next' => 'wrong_b'],
                ['label' => 'Unvisited cells holding 0 or the next number', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[1], [3], [2]], k = 3 → a path meeting 1, 3, 2 instead of [].\nStep back to when you ignored the numbers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Exponential in m · n at worst. Checks → paths for [[0, 1, 2]], [[1, 0], [0, 2]], [[1, 2], [0, 0], [0, 3]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
