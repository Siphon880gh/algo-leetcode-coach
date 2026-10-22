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
            'message' => "Read the problem statement above.\nOrder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort first', 'next' => 's2'],
                ['label' => 'Input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [2, 1, 1], k = 1 → 2 instead of 3.\nStep back to when you skipped the sort.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Slot for x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x − k', 'next' => 'wrong_b'],
                ['label' => 'max(prev + 1, x − k)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 4 instead of 6.\nStep back to when you always took x − k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 6, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
