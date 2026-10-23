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
            'message' => "Read the problem statement above.\nRemovals to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Indices where a prefix or suffix gcd changes', 'next' => 's2'],
                ['label' => 'None', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 0 instead of 2.\nStep back to when you never removed anything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Enough to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the first and last element', 'next' => 'wrong_b'],
                ['label' => 'Every changing index', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [12, 2, 12, 2, 3, 8] → 0 instead of 2.\nStep back to when you only tried the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log² V). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
