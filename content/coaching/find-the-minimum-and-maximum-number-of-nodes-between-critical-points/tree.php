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
            'message' => "Read the problem statement above.\nCritical point?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly greater or strictly smaller than both neighbours', 'next' => 's2'],
                ['label' => 'Greater or equal to both', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal neighbours do not make a local maximum or minimum.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Minimum distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distance from the first to the second-to-last', 'next' => 'wrong_b'],
                ['label' => 'Smallest gap between consecutive critical points', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The smallest gap can be anywhere, so track it as you go.\nStep back to when you used fixed positions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fewer than two critical points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return [-1, -1]', 'next' => 'success'],
                ['label' => 'Return [0, 0]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → [-1, -1].\nStep back to when you returned zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) extra. Examples → [-1,-1], [1,3], [3,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
