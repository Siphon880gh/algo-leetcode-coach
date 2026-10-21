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
            'message' => "Problem: In an array team, 1 marks a person who is \"it\" and 0 marks a person who is not. Each \"it\" person can catch at most one non-\"it\" person within distance dist (indices i − dist … i + dist), and each person can be caught once. Return the maximum number caught. For instance, [0,1,0,1,0] with dist 3 → 2; [1] with dist 1 → 0; [0] with dist 1 → 0. (Restated from memory; limits and examples may differ slightly.)\nDistance test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|i − j| ≤ dist', 'next' => 's2'],
                ['label' => '|i − j| < dist', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Index i − dist … i + dist is inclusive.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Too far apart and the not-it index is smaller?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Advance the it pointer', 'next' => 'wrong_b'],
                ['label' => 'Advance the not-it pointer', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That person is too far left for this and every later it, but this it may still catch someone to the right.\nStep back to when you advanced the it pointer.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many can one it catch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most one', 'next' => 'success'],
                ['label' => 'Everyone within dist', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each it catches at most one person.\nStep back to when you caught several.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 2, 0, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
