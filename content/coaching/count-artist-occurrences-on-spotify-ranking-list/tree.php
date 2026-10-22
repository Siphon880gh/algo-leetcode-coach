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
            'message' => "Problem: A ranking table lists tracks, each with its artist. Count how many times each artist appears and return each artist with that count, ordered by the count from highest to lowest; the tie-break and output names are in the official statement. For instance, an artist with three listed tracks comes before one with two. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The artist', 'next' => 's2'],
                ['label' => 'The track', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each track is its own group; the constructed check → every count 1 instead of 3, 2, 1.\nStep back to when you grouped by track.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order counts how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lowest first', 'next' => 'wrong_b'],
                ['label' => 'Highest first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for most appearances first; the constructed check → 1, 2, 3 instead of 3, 2, 1.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (run in SQLite) → 3, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
