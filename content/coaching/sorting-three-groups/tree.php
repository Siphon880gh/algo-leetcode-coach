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
            'message' => "Read the problem statement above.\nKeep the longest non-decreasing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subsequence', 'next' => 's2'],
                ['label' => 'Subarray', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Kept elements need not be adjacent; example 2 → 3 instead of 2.\nStep back to when you used a run.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "e[x] becomes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'e[x] + 1', 'next' => 'wrong_b'],
                ['label' => 'max(e[1 … x]) + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The 3s no longer extend the run of 2s; example 3 → 2 instead of 0.\nStep back to when you extended only e[x].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
