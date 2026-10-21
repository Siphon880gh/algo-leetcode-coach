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
            'message' => "Read the problem statement above.\nWhy subtract the index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It removes the 0, 1, 2 … offsets of a block', 'next' => 's2'],
                ['label' => 'It normalises values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The goal is consecutive positions, not one point.\nStep back to when you skipped the shift.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Gather point?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The mean', 'next' => 'wrong_b'],
                ['label' => 'The median of the shifted window', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The median minimises total absolute distance.\nStep back to when you used the mean.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Per-window cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums: O(1)', 'next' => 'success'],
                ['label' => 'Sum distances directly', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is O(k) per window.\nStep back to when you summed directly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 5, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
