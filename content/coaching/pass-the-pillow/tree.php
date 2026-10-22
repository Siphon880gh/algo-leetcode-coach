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
            'message' => "Read the problem statement above.\nPeriod of a round trip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2(n − 1)', 'next' => 's2'],
                ['label' => '2n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The ends are visited once per trip; n = 2, time = 3 → 0 instead of 2.\nStep back to when you used 2n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Holder when t ≥ n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2n − t', 'next' => 'wrong_b'],
                ['label' => '2n − 1 − t', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is one step behind; n = 3, time = 3 → 3 instead of 2.\nStep back to when you used 2n − t.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
