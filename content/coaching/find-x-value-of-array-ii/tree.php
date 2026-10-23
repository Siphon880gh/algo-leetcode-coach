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
            'message' => "Read the problem statement above.\nUpdates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep every earlier update', 'next' => 's2'],
                ['label' => 'Apply each update to the original array only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [2, 2, 1] instead of [2, 2, 2].\nStep back to when you dropped earlier updates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Merging right into left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add right’s counts unchanged', 'next' => 'wrong_b'],
                ['label' => 'Shift right’s counts by left’s product', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [3, 1, 1] instead of [2, 2, 2].\nStep back to when you skipped the shift.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) · k · log n). Examples → [2, 2, 2], [1, 0], [5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
