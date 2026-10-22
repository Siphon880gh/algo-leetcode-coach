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
            'message' => "Read the problem statement above.\nSame sign as before?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add max(0, |d| − |prev|)', 'next' => 's2'],
                ['label' => 'Add |d|', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 5 instead of 2.\nStep back to when you added |d|.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sign change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Treat it like the same sign', 'next' => 'wrong_b'],
                ['label' => 'Start over: add |d|', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 2 instead of 5.\nStep back to when you ignored the sign.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
