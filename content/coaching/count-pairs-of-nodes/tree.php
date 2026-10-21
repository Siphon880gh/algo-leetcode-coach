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
            'message' => "Read the problem statement above.\nincident(a, b)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'deg(a) + deg(b) − shared(a, b)', 'next' => 's2'],
                ['label' => 'deg(a) + deg(b)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Edges between a and b are counted twice.\nStep back to when you just added degrees.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Enumerate all pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: two pointers on sorted degrees', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 2 · 10^4 gives 2 · 10^8 pairs per query.\nStep back to when you enumerated pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which pairs need correction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only connected pairs', 'next' => 'success'],
                ['label' => 'All pairs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Disconnected pairs share no edge.\nStep back to when you corrected all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + q · (n + E)). Examples → [6,5], [10,10,9,8,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
