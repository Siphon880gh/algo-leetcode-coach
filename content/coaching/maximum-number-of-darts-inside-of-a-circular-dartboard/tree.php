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
            'message' => "Read the problem statement above.\nCandidate centres?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Circles through two darts', 'next' => 's2'],
                ['label' => 'Only the darts themselves', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Optimal circles often centre between darts.\nStep back to when you used dart centres only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distance tests?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exact equality', 'next' => 'wrong_b'],
                ['label' => 'With an epsilon', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Floating error drops boundary darts.\nStep back to when you compared exactly.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pair farther than 2r?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'success'],
                ['label' => 'Clamp it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No radius-r circle passes through both.\nStep back to when you clamped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). Square of 4 darts, r = 2 → 4. Example 2, r = 5 → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
