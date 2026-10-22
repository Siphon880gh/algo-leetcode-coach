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
            'message' => "Read the problem statement above.\nCounting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort and binary search', 'next' => 's2'],
                ['label' => 'A count array over every value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. About 3 · 10^9 slots.\nStep back to when you built the array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Other targets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore them', 'next' => 'wrong_b'],
                ['label' => 'Widest 2k window, capped', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 5], k = 2, numOperations = 2 → 1 instead of 2.\nStep back to when you ignored them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
