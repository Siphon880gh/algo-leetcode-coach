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
            'message' => "Read the problem statement above.\nCentre when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Differs from both neighbours', 'next' => 's2'],
                ['label' => 'Differs from either neighbour', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 5 instead of 3.\nStep back to when you needed only one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Neighbours of the ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the ends', 'next' => 'wrong_b'],
                ['label' => 'Wrap around', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 1 instead of 3.\nStep back to when you skipped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 0, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
