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
            'message' => "Read the problem statement above.\nLast ride rounded up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, arrival can be fractional', 'next' => 's2'],
                ['label' => 'Yes, like the others', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You only wait before departing a next train.\nStep back to when you rounded the last ride.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Search range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1, max(dist)]', 'next' => 'wrong_b'],
                ['label' => '[1, 10^7]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A fractional last leg may need speed above max(dist).\nStep back to when you capped at max(dist).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Even 10^7 too slow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return 10^7', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The trip cannot be made on time.\nStep back to when you returned the cap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log 10^7). Examples → 1, 3, -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
