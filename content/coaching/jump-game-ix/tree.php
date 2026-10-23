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
            'message' => "Read the problem statement above.\nReach from i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The prefix maximum, or more if it connects right', 'next' => 's2'],
                ['label' => 'Just the prefix maximum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [2, 3, 3] instead of [3, 3, 3].\nStep back to when you stopped at the prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Connect when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pm[i] ≥ sm[i + 1]', 'next' => 'wrong_b'],
                ['label' => 'pm[i] > sm[i + 1]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 1, 3, 1] → [3, 3, 3, 3] instead of [1, 1, 3, 3].\nStep back to when you allowed equal.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [2, 2, 3], [3, 3, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
