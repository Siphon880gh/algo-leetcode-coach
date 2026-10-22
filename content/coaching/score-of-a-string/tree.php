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
            'message' => "Read the problem statement above.\nAdd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Absolute differences', 'next' => 's2'],
                ['label' => 'Signed differences', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. They cancel: example 2 → 0 instead of 50.\nStep back to when you kept signs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every pair', 'next' => 'wrong_b'],
                ['label' => 'Adjacent pairs', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 48 instead of 13.\nStep back to when you used every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 13, 50.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
