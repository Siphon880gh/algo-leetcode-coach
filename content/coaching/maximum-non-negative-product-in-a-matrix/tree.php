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
            'message' => "Read the problem statement above.\nTrack only the max?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: max and min', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A large negative times a negative cell can become the best.\nStep back to when you dropped the min.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When to take the modulo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At every cell', 'next' => 'wrong_b'],
                ['label' => 'Only at the end', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Modulo breaks max and min comparisons.\nStep back to when you reduced early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final max < 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return it mod 1e9+7', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Negative results map to −1.\nStep back to when you reduced it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → −1, 8, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
