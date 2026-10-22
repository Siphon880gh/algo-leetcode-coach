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
            'message' => "Read the problem statement above.\nAlgorithm?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dijkstra on time', 'next' => 's2'],
                ['label' => 'BFS on move count', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 6.\nStep back to when you counted moves.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Arrival at v?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(t + 1, moveTime[v])', 'next' => 'wrong_b'],
                ['label' => 'max(t, moveTime[v]) + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 5 instead of 6.\nStep back to when you treated moveTime as an arrival time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(nm log(nm)). Examples → 6, 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
