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
            'message' => "Read the problem statement above.\nSearch over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The answer d, from 0 to side', 'next' => 's2'],
                ['label' => 'Every subset of k points', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With up to 15,000 points and k up to 25 there are far too many subsets.\nStep back to when you listed subsets.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check the last gap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'wrong_b'],
                ['label' => 'Yes, round the end back to the start', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. side = 4, points (4, 4), (2, 4), (2, 0), (0, 4), (0, 0), k = 4 → 4 instead of 2.\nStep back to when you skipped the wrap-around.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + n · k · log n · log side). Examples → 2, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
