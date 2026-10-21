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
            'message' => "Problem: There are n cities numbered 0 to n − 1 and a list of highways, each connecting two cities in both directions with a toll. You also have a number of discounts; using one on a highway lets you pay toll / 2 (integer division) for that highway. Each discount can be used once and at most one per highway. Return the minimum total cost from city 0 to city n − 1, or −1 if it cannot be reached. For instance, n = 5, highways 0-1 (4), 2-1 (3), 1-4 (11), 3-2 (3), 3-4 (2) with 1 discount → 9; n = 4, highways 1-3 (17), 1-2 (7), 3-2 (5), 0-1 (6), 3-0 (20) with 20 discounts → 8; n = 4, highways 0-1 (3), 2-3 (2) with 0 discounts → −1. (Restated from memory; limits and examples may differ slightly.)\nDijkstra state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(city, discounts used)', 'next' => 's2'],
                ['label' => 'The city alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Highways 0-1 (1) and 1-2 (3) with 1 discount: city 1 is first reached for 0 by spending the discount, giving 3, but the best is 1 + 1 = 2.\nStep back to when you dropped the discount count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Highways?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One-way', 'next' => 'wrong_b'],
                ['label' => 'Two-way', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each highway can be used in both directions.\nStep back to when you made them one-way.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When is city n − 1 reached?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first time it is popped, with any number of discounts used', 'next' => 'success'],
                ['label' => 'Only with every discount used', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Discounts are optional; with 20 discounts and a 3-highway route the answer is 8, not −1.\nStep back to when you required all of them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + E) · d · log). Constructed checks → 9, 8, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
