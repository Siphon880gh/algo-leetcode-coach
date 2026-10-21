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
            'message' => "Read the problem statement above.\nOverlapping windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start each at the next unoutput index', 'next' => 's2'],
                ['label' => 'Output every window in full', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 has a key everywhere, so indices would repeat.\nStep back to when you output whole windows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which side of a key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only i ≥ j', 'next' => 'wrong_b'],
                ['label' => 'Both: j − k … j + k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 index 1 qualifies through the key at index 2.\nStep back to when you looked one way.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Distance test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|i − j| ≤ k', 'next' => 'success'],
                ['label' => '|i − j| < k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → [2,5] instead of [1,2,3,4,5,6].\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1,2,3,4,5,6], [0,1,2,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
