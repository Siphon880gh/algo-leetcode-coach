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
            'message' => "Read the problem statement above.\nPer query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Look it up in the index list', 'next' => 's2'],
                ['label' => 'Rescan the array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 10^10 steps at 10^5 each.\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Entry for query q?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'idx[q]', 'next' => 'wrong_b'],
                ['label' => 'idx[q − 1]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Queries count from 1: example 1 → [2, −1, −1, −1] instead of [0, −1, 2, −1].\nStep back to when you used idx[q].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Examples → [0, −1, 2, −1], [−1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
