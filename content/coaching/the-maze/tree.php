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
            'message' => "Problem: m × n maze of 0 and 1. The ball rolls until the next cell is a wall, then picks a new direction. Can it stop at destination? Sample: [0,4] → [4,4] true; → [3,2] false. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Graph over stopping cells; edges are full rolls', 'next' => 's2'],
                ['label' => 'Normal grid BFS with one-cell steps', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The ball cannot stop mid-roll. Moving one cell at a time finds paths the ball cannot take.\nStep back to when you used one-cell steps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "From a stop, you roll left.\nWhere does that edge end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the destination if the roll passes over it', 'next' => 'wrong_b'],
                ['label' => 'At the last open cell before a wall', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rolling continues until the next cell is a wall or the border, not until it meets the destination.\nStep back to when you stopped at the destination.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mark stops visited; return true when a stop equals destination. O(m n (m + n)). The Maze II (505) wants the shortest distance; III (499) adds a hole.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stops as nodes, full rolls, visited set. Not 505 / 499', 'next' => 'success'],
                ['label' => 'No visited set, since rolls always move', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rolls can bounce forever between the same stops. Without a visited set, the search never ends.\nStep back to when you skipped the visited set.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Search over stopping cells with full rolls. Passing through does not count.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
