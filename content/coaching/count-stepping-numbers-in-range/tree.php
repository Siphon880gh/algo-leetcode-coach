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
            'message' => "Read the problem statement above.\nThe answer is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f(high) − f(low) + [low is stepping]', 'next' => 's2'],
                ['label' => 'f(high) − f(low)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. low itself drops out; example 1 → 9 instead of 10.\nStep back to when you subtracted f(low).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count up to a bound by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Testing every number', 'next' => 'wrong_b'],
                ['label' => 'A digit DP on the string', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Bounds go up to 10^100.\nStep back to when you looped over numbers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len · 100). Examples → 10, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
