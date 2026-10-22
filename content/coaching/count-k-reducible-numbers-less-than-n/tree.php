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
            'message' => "Read the problem statement above.\nx qualifies when its popcount needs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most k − 1 more steps', 'next' => 's2'],
                ['label' => 'At most k steps', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The first step is turning x into its popcount: example 1 → 6 instead of 3.\nStep back to when you allowed k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to n', 'next' => 'wrong_b'],
                ['label' => 'Below n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 7 instead of 6.\nStep back to when you included n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L²). Examples → 3, 6, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
