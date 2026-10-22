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
            'message' => "Read the problem statement above.\nTake?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, 2, 3, … skipping partners', 'next' => 's2'],
                ['label' => '1 … n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 1 and 3 sum to 4; example 1 → 15, which is not k-avoiding.\nStep back to when you took 1 … n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i passes n', 'next' => 'wrong_b'],
                ['label' => 'There are n numbers', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Skipped numbers leave you short; example 1 ends with 4 numbers summing to 12.\nStep back to when you stopped at i = n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + k). Examples → 18, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
