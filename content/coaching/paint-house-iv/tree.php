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
            'message' => "Read the problem statement above.\nMirrored houses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Different colors', 'next' => 's2'],
                ['label' => 'No rule', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 17 instead of 18.\nStep back to when you dropped the rule.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New pair (c, d) after (a, b)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c ≠ a only', 'next' => 'wrong_b'],
                ['label' => 'c ≠ a and d ≠ b', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. cost [[3, 4, 2], [2, 1, 1], [5, 0, 2], [4, 3, 4]] → 7 instead of 8.\nStep back to when you checked one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(36 · n). Examples → 9, 18.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
