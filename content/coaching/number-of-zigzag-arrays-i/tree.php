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
            'message' => "Read the problem statement above.\nWhat does each triple need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not strictly increasing or decreasing', 'next' => 's2'],
                ['label' => 'Nothing beyond neighbors differing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 12 instead of 10.\nStep back to when you only checked neighbors.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Length-1 starting counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'up[v] = 1, down[v] = 0', 'next' => 'wrong_b'],
                ['label' => 'up[v] = down[v] = 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 5 instead of 10.\nStep back to when you set down to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). Examples → 2, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
