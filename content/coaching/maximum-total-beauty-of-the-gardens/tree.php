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
            'message' => "Read the problem statement above.\nWhich gardens to complete?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest ones', 'next' => 's2'],
                ['label' => 'The smallest ones', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Completing a smaller garden costs at least as many flowers, and the larger garden left behind needs no more to lift the minimum, so it never helps.\nStep back to when you completed the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "All gardens full?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add partial · target too', 'next' => 'wrong_b'],
                ['label' => 'Score n · full only', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Partial beauty needs an incomplete garden.\nStep back to when you added partial.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Minimum of incomplete gardens?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most target − 1', 'next' => 'success'],
                ['label' => 'Up to target', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. At target they are full; Example 2 → 36 instead of 30.\nStep back to when you let it reach target.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n · log target). Examples → 14, 30.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
