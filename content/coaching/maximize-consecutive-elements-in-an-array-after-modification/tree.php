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
            'message' => "Read the problem statement above.\nProcess values in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted order', 'next' => 's2'],
                ['label' => 'Input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update order for x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd[x] first, then d[x + 1]', 'next' => 'wrong_b'],
                ['label' => 'd[x + 1] first, then d[x]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One element counts twice; [1] → 2 instead of 1.\nStep back to when you updated d[x] first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
