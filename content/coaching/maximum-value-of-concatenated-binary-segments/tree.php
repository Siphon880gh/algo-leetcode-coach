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
            'message' => "Read the problem statement above.\nSort by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leading 1s, then fewer 0s', 'next' => 's2'],
                ['label' => 'Total length', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 71 instead of 120.\nStep back to when you sorted by length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Same number of 1s?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'More 0s first', 'next' => 'wrong_b'],
                ['label' => 'Fewer 0s first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): ones [1, 1], zeros [1, 2] → 18 instead of 20.\nStep back to when you put more zeros first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + L). Examples → 14, 120.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
