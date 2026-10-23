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
            'message' => "Read the problem statement above.\nWhich indices does a query touch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'l, l + k, l + 2k, … ≤ r', 'next' => 's2'],
                ['label' => 'Every index from l to r', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 19 instead of 31.\nStep back to when you ignored k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When to take the modulo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never', 'next' => 'wrong_b'],
                ['label' => 'After every multiply', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [10^9], query [0, 0, 1, 10^5] → 100000000000000 instead of 999300007.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q · n). Examples → 4, 31.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
