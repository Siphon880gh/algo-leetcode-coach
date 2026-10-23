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
            'message' => "Problem: Given item weights and the capacities w1 and w2 of two bags, place each item in at most one bag without going over either capacity, and return the largest total weight packed. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Which (load 1, load 2) pairs are reachable', 'next' => 's2'],
                ['label' => 'Fill bag 1 as fully as possible, then bag 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [4, 4, 6], w1 = 8, w2 = 4 → 8 instead of 10.\nStep back to when you filled one bag first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop the loads?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Upward', 'next' => 'wrong_b'],
                ['label' => 'Downward', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3], w1 = 6, w2 = 3 → 9 instead of 3 (the item is used twice).\nStep back to when you looped upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · w1 · w2). Checks → 9, 11, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
