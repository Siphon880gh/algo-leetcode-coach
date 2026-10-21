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
            'message' => "Problem: An interactive problem: a robot in an unknown grid can ask whether it can move in a direction, move (which returns the cost of the cell it enters), and check whether it is on the target. Return the minimum total of the entry costs along a route to the target, or −1 if it is unreachable. For instance, in the grid [[1,2,3],[blocked,1,5]] from the top-left to the bottom-right, the cheapest route costs 2 + 1 + 5 = 8. (Restated from memory; limits and examples may differ slightly.)\nShortest path method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dijkstra (cells have different costs)', 'next' => 's2'],
                ['label' => 'BFS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. BFS minimises moves, not cost.\nStep back to when you used BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What to store per cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cost of the cell you left', 'next' => 'wrong_b'],
                ['label' => 'The cost returned when entering it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. move returns the cost of the cell you enter.\nStep back to when you stored the wrong cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After each DFS branch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move back the opposite way', 'next' => 'success'],
                ['label' => 'Stay', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The robot must stay in sync with the DFS.\nStep back to when you stayed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(cells log cells). Constructed check → 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
