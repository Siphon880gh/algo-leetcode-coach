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
            'message' => "Read the problem statement above.\nFirst index of target after sorting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of elements smaller than target', 'next' => 's2'],
                ['label' => 'Its first index in the original array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 2: target 3 is at index 4 originally but at index 3 after sorting.\nStep back to when you used the original index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many indices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always one', 'next' => 'wrong_b'],
                ['label' => 'The number of copies of target', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [1,2].\nStep back to when you returned one index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Target absent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return an empty list', 'next' => 'success'],
                ['label' => 'Return [-1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With no copies the list is empty.\nStep back to when you returned [-1].",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1,2], [3], [4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
