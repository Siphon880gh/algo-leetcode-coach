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
            'message' => "Read the problem statement above.\nValues to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every v ≠ k', 'next' => 's2'],
                ['label' => 'Only the most frequent v', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [2, 1, 2, 1, 2, 3, 3], k = 1 → 3 instead of 4.\nStep back to when you tried one value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A k inside the subarray?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Counts −1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 1, 2], k = 1 → 3 instead of 2.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(50 · n). Examples → 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
