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
            'message' => "Read the problem statement above.\nOnes give?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest odd count', 'next' => 's2'],
                ['label' => 'Their full count', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The pattern has odd length; [1, 1, 1, 1] → 4 instead of 3.\nStep back to when you took every 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Chain ends at a missing value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Still 2t + 1', 'next' => 'wrong_b'],
                ['label' => 'Step back one: 2t − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 2, 4, 4] → 5 instead of 3; 16 is missing.\nStep back to when you kept 2t + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log log max). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
