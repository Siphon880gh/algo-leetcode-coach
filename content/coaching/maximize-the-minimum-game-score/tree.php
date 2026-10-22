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
            'message' => "Read the problem statement above.\nExtra visit at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A round trip to i + 1, 2 moves', 'next' => 's2'],
                ['label' => '1 move', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 6 instead of 4.\nStep back to when you counted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Last index already covered?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Step in anyway', 'next' => 'wrong_b'],
                ['label' => 'Stop without stepping in', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. points = [2, 4], m = 5 → 4 instead of 6.\nStep back to when you stepped in.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log(m · min(points))). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
