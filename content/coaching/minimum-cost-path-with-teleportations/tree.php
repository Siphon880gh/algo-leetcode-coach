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
            'message' => "Read the problem statement above.\nTeleport to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cells with value ≤ the current one', 'next' => 's2'],
                ['label' => 'Cells with a smaller value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 11 instead of 7.\nStep back to when you required smaller.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many teleports?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As many as you like', 'next' => 'wrong_b'],
                ['label' => 'At most k (k + 1 layers)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[3, 2], [2, 3], [6, 1]], k = 0 → 0 instead of 6.\nStep back to when you ignored k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · (k + log(m · n))). Examples → 7, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
