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
            'message' => "Problem: Cities are joined by two-way roads, each with a travel cost, and every city sells apples at its own price. From a starting city you travel to any city, buy one apple, and travel back, where the way back costs the way there times a given factor k; the exact rule is in the official statement. For each starting city, return the least total cost. For instance, two cities joined by a road of cost 2, with prices [10,3] and k = 2 → [9,3]. (Restated from memory; limits and examples may differ slightly.)\nRoad weight in the Dijkstra?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cost scaled by the round-trip factor', 'next' => 's2'],
                ['label' => 'The cost alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The way back costs too; two cities with a road of cost 2, prices [10,3] and k = 2 → [5,3] instead of [9,3].\nStep back to when you used the raw cost.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Seed the heap with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the cheapest city', 'next' => 'wrong_b'],
                ['label' => 'Every city at its own price', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A city can be cheapest only for its own neighbourhood; path 0 – 1 – 2, road costs 1, prices [1,9,1], k = 1 → [1,3,5] instead of [1,3,1].\nStep back to when you seeded one city.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log n). Constructed checks → [9,3], [5,3,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
