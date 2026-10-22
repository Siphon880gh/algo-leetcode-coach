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
            'message' => "Read the problem statement above.\nn is even?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return n', 'next' => 's2'],
                ['label' => 'Return 2n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n is already a multiple of 2 and of itself; Example 2 → 12 instead of 6.\nStep back to when you doubled an even n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n is odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return n', 'next' => 'wrong_b'],
                ['label' => 'Return 2n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An odd n is not a multiple of 2; Example 1 → 5 instead of 10.\nStep back to when you returned n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 10, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
