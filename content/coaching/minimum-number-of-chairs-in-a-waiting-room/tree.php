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
            'message' => "Read the problem statement above.\nTrack what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'People inside', 'next' => 's2'],
                ['label' => 'Total entries', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Freed chairs get reused: example 2 → 4 instead of 2.\nStep back to when you counted entries.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Final count', 'next' => 'wrong_b'],
                ['label' => 'Maximum reached', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Everyone leaves: example 3 → 0 instead of 3.\nStep back to when you used the final count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 7, 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
