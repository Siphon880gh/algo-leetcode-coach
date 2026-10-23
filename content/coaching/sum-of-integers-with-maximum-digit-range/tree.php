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
            'message' => "Read the problem statement above.\nZero digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count them', 'next' => 's2'],
                ['label' => 'Skip them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 5724 instead of 6074.\nStep back to when you skipped zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many numbers to add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the first', 'next' => 'wrong_b'],
                ['label' => 'Every one with the maximum range', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 90 instead of 990.\nStep back to when you stopped at the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · D). Examples → 6074, 990.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
