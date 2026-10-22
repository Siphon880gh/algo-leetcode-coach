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
            'message' => "Read the problem statement above.\nPick order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Happiest first', 'next' => 's2'],
                ['label' => 'Input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 4.\nStep back to when you used input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Below zero?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Let it go negative', 'next' => 'wrong_b'],
                ['label' => 'Clamp at 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 1, 1] with k = 3 → 0 instead of 1.\nStep back to when you dropped the clamp.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 4, 1, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
