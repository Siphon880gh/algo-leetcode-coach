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
            'message' => "Read the problem statement above.\nGap rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j − i ≥ k', 'next' => 's2'],
                ['label' => 'j − i > k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 11 instead of 13.\nStep back to when you made the gap strict.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Prefix max over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Indices 0 … j − 1', 'next' => 'wrong_b'],
                ['label' => 'Indices 0 … j − k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 9, 9], k = 2 → 18 instead of 10.\nStep back to when you ignored k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 13, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
