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
            'message' => "Problem: Given parallel arrays of usernames, timestamps, and websites, a pattern is three websites in order, and its score is the number of users who visited them in that order (not necessarily consecutively). Return the highest-scoring pattern, the lexicographically smallest on a tie. (Restated from memory; limits and examples may differ slightly.)\nOrder of each user's visits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By timestamp', 'next' => 's2'],
                ['label' => 'Input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The input is not sorted by time.\nStep back to when you used input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A user forms the same triple twice. Count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Twice', 'next' => 'wrong_b'],
                ['label' => 'Once: use a set per user', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The score counts users.\nStep back to when you counted twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two patterns tie. Pick?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The lexicographically smallest', 'next' => 'success'],
                ['label' => 'The first one found', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The tie-break is defined.\nStep back to when you took the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + Σ m³). Highest score, smallest pattern on ties.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
