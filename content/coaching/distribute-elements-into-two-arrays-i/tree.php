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
            'message' => "Read the problem statement above.\nCompare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Last elements', 'next' => 's2'],
                ['label' => 'First elements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [5, 3, 8, 4].\nStep back to when you compared first elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'arr2 + arr1', 'next' => 'wrong_b'],
                ['label' => 'arr1 + arr2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [1, 2, 3] instead of [2, 3, 1].\nStep back to when you put arr2 first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [2, 3, 1], [5, 3, 4, 8].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
