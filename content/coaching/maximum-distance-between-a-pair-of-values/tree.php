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
            'message' => "Read the problem statement above.\nCondition holds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Record j − i and advance j', 'next' => 's2'],
                ['label' => 'Advance i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A larger j may still work for this i.\nStep back to when you advanced i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Condition fails?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Advance j', 'next' => 'wrong_b'],
                ['label' => 'Advance i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums2 only gets smaller to the right.\nStep back to when you advanced j.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Need to check i ≤ j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, j − i < 0 never beats the best', 'next' => 'success'],
                ['label' => 'Yes, reset j', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Resetting j wastes the linear walk.\nStep back to when you reset j.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 2, 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
