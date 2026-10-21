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
            'message' => "Problem: m × n maze; the ball rolls until the next cell is a wall. Return the fewest cells rolled to stop at destination, or −1. Sample [0,4] → [4,4] = 12. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dijkstra: edge weight = cells rolled', 'next' => 's2'],
                ['label' => 'BFS: the first time you reach destination is shortest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. BFS counts rolls, but a single long roll can cost more than two short ones.\nStep back to when you used plain BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "From a popped stop, you roll to (x, y) in c cells.\nWhen do you push?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'If (x, y) was never pushed before', 'next' => 'wrong_b'],
                ['label' => 'If dist + c < best[x][y]: update and push', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Visiting each stop once on push locks in a distance before it is final.\nStep back to when you marked visited on push.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Skip stale heap entries (d > best). Return best at destination, or −1. O(m n log(m n) × (m + n)).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dijkstra over stops with relaxation; must stop at dest', 'next' => 'success'],
                ['label' => 'Return as soon as a roll passes over destination', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Stopping when the roll passes destination does not count; the ball must stop there.\nStep back to when you returned on passing through.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Weighted edges need Dijkstra; only a stop counts. → 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
