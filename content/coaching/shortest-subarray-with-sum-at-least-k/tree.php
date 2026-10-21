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
            'message' => "Read the problem statement above.\nUse a two-pointer sliding window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: negatives break it; use prefix sums with a deque', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With negative numbers, shrinking the window can raise the sum.\nStep back to when you used a window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "P[j] − P[front] ≥ k. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Record it and keep the front', 'next' => 'wrong_b'],
                ['label' => 'Record j − front and pop the front', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any later j would only give that start a longer window.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "P[back] ≥ P[j]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop the back', 'next' => 'success'],
                ['label' => 'Keep it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. j is later and no larger, so it is always a better start.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1], k = 1 → 1. [1,2], k = 4 → −1. [2,−1,2], k = 3 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
