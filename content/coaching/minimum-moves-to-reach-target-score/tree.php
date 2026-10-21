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
            'message' => "Read the problem statement above.\nWhich direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Backwards from target, halving when possible', 'next' => 's2'],
                ['label' => 'Forwards from 1, doubling as soon as possible', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 (19, 2 doubles): 1 → 2 → 4 then 15 increments is 17 moves, not 7.\nStep back to when you doubled early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Target is odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Halve it with rounding', 'next' => 'wrong_b'],
                ['label' => 'Subtract 1, then it can be halved', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Halving is only the reverse of doubling for even numbers.\nStep back to when you halved an odd number.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Doubles used up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add target − 1 at once', 'next' => 'success'],
                ['label' => 'Keep subtracting 1 in a loop', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Target reaches 10^9, so a step-by-step loop is far too slow.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log target). Examples → 4, 7, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
