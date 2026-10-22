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
            'message' => "Read the problem statement above.\nPaying for wall i covers how many walls?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'time[i] + 1, itself plus the free ones', 'next' => 's2'],
                ['label' => 'time[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The paid wall itself counts too; example 1 → 4 instead of 3.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Index the table by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total cost', 'next' => 'wrong_b'],
                ['label' => 'Walls covered, capped at n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Costs reach 500 · 10^6, far too many slots.\nStep back to when you indexed by cost.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
