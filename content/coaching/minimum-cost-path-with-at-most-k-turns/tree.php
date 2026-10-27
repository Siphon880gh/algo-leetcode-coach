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
            'message' => "Read the problem statement above.\nWhat must one search state remember?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just the cell', 'next' => 'wrong_a'],
                ['label' => 'The cell, the heading and the turns used', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With cells only, Example 3 gives 8 instead of −1, and Example 2 gives 18 instead of 20.\nStep back to when you dropped the heading and the turn count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Every cell cost is ≥ 0. Which search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS by number of moves', 'next' => 'wrong_b'],
                ['label' => 'Dijkstra with a min-heap', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. BFS finds the fewest moves, not the cheapest sum. In Example 1 both 3-move paths are allowed, but they cost 12 and 17.\nStep back to when you picked BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Dijkstra over (cell, heading, turns). O(S log S) with S = m · n · 4 · (k + 1). Examples give 12, 20 and −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
