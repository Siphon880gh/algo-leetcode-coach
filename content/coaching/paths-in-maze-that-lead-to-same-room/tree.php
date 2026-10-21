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
            'message' => "Problem: A maze has n rooms numbered 1 to n and a list of corridors, each connecting two different rooms in both directions (no duplicates). The confusion score is the number of different cycles of length 3, that is, sets of three rooms that are pairwise connected. Return it. For instance, n = 5 with corridors 1-2, 5-2, 4-1, 2-4, 3-1, 3-4 → 2; n = 4 with corridors 1-2, 3-4 → 0; four rooms all connected to each other → 4. (Restated from memory; limits and examples may differ slightly.)\nCorridors are?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two-way', 'next' => 's2'],
                ['label' => 'One-way', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each corridor connects its rooms in both directions.\nStep back to when you made them one-way.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "1 → 2 → 4 → 1 and 2 → 4 → 1 → 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two different cycles', 'next' => 'wrong_b'],
                ['label' => 'The same cycle', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A cycle of length 3 is fixed by its set of rooms.\nStep back to when you counted orders.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "For edge (a, b), count which common neighbours w?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only w > max(a, b)', 'next' => 'success'],
                ['label' => 'All of them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every triangle has three edges and would be counted three times; four fully connected rooms → 12 instead of 4.\nStep back to when you counted all.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed checks → 2, 0, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
