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
            'message' => "Read the problem statement above.\nNon-increasing before day i means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each day ≤ the day before (equal allowed)', 'next' => 's2'],
                ['label' => 'Strictly decreasing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 1 → [2,3] relies on 5 ≥ 3 ≥ 3.\nStep back to when you required strict decrease.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check each day how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan time days on each side', 'next' => 'wrong_b'],
                ['label' => 'Precomputed run lengths from the left and right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n · time), up to 10^10 steps.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "time = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every day is good', 'next' => 'success'],
                ['label' => 'No day is good', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 → [0,1,2,3,4].\nStep back to when you returned none.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [2,3], [0,1,2,3,4], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
