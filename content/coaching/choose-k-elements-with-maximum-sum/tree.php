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
            'message' => "Read the problem statement above.\nEqual nums1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer the whole group first', 'next' => 's2'],
                ['label' => 'Add each before answering the next', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [0, 3, 3, 3] instead of [0, 0, 0, 0].\nStep back to when you added too early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heap over k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop the largest', 'next' => 'wrong_b'],
                ['label' => 'Pop the smallest', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [50, 30, 0, 30, 50] instead of [80, 30, 0, 80, 50].\nStep back to when you popped the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [80, 30, 0, 80, 50], [0, 0, 0, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
