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
            'message' => "Problem: A grid has a start, a destination, empty cells, stones and flooded cells. Each second you move to an adjacent cell, and the flood spreads to adjacent empty cells. You cannot walk through stones or step where the water is. Return the fewest seconds to reach the destination, or −1. Exactly how the moves and the spreading interleave, and which cells the flood can enter, are in the official statement. For instance, in a 1 × 3 row of start, empty, destination with no water, the answer is 2. (Restated from memory; limits and examples may differ slightly.)\nGet flood times with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One multi-source BFS', 'next' => 's2'],
                ['label' => 'A BFS from each flooded cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That repeats the grid once per wet cell, O(cells²).\nStep back to when you ran many BFS passes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Enter cell c at time t + 1 when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't + 1 ≤ flood time', 'next' => 'wrong_b'],
                ['label' => 't + 1 < flood time', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Under the guide’s assumptions you would step in as the water arrives; one random grid → 3 instead of −1.\nStep back to when you allowed a tie.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows · cols). The checks → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
