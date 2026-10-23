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
            'message' => "Read the problem statement above.\nCan the answer be 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, if every element ≥ 2 can be changed', 'next' => 's2'],
                ['label' => 'No, it is at least 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [2, 1, 3], maxC = 2 → 1 instead of 0.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which element of a bad window to change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The leftmost', 'next' => 'wrong_b'],
                ['label' => 'The rightmost', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 2, 8], maxC = 1 → 2 instead of 1.\nStep back to when you changed the leftmost.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n · log max). Examples → 1, 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
