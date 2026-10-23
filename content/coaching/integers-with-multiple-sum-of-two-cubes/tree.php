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
            'message' => "Read the problem statement above.\nPairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a ≤ b', 'next' => 's2'],
                ['label' => 'Ordered pairs', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [9, 28, 35, …] instead of [].\nStep back to when you counted (a, b) and (b, a).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep sums seen?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly twice', 'next' => 'wrong_b'],
                ['label' => 'At least twice', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): n = 10^9 → 1,546 values instead of 1,554; 87,539,319 has three pairs.\nStep back to when you required exactly two.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n^(2/3) log n). Examples → [1729, 4104], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
