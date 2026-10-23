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
            'message' => "Read the problem statement above.\nHow to split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search D; check the graph of close pairs is bipartite', 'next' => 's2'],
                ['label' => 'Sort by x and cut in half', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 4.\nStep back to when you cut in half.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edges for a test value D?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pairs at distance ≤ D', 'next' => 'wrong_b'],
                ['label' => 'Pairs closer than D', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 10 instead of 11.\nStep back to when you included distance D.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log n). Examples → 4, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
