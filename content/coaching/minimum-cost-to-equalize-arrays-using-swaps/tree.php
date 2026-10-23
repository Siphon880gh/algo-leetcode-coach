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
            'message' => "Read the problem statement above.\nCheck first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every value has an even total count', 'next' => 's2'],
                ['label' => 'Skip the check', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 1 instead of −1.\nStep back to when you skipped the parity check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost from the surplus?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ |c[v] − tot[v] / 2|', 'next' => 'wrong_b'],
                ['label' => 'Σ |c[v] − tot[v] / 2| / 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 2 instead of 1.\nStep back to when you forgot that one swap fixes two.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 0, 1, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
