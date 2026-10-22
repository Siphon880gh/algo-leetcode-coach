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
            'message' => "Read the problem statement above.\nPartner remainder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(24 − r) mod 24', 'next' => 's2'],
                ['label' => '24 − r', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. r = 0 looks in slot 24: example 2 → 0 instead of 3.\nStep back to when you dropped the mod.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count against?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All hours, including itself', 'next' => 'wrong_b'],
                ['label' => 'Earlier hours only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairs count twice and self-pairs slip in: example 1 → 8 instead of 2.\nStep back to when you counted all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
