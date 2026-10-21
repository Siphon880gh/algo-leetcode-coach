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
            'message' => "Read the problem statement above.\nWhich node is the root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The parent that is never a child', 'next' => 's2'],
                ['label' => 'The parent in the first description', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 starts with 20, but the root is 50.\nStep back to when you took the first parent.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Child mentioned before its own description?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Create nodes only as parents', 'next' => 'wrong_b'],
                ['label' => 'Create it on first mention', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 mentions 15 only as a child, and 20 first as a parent and later as a child, so both sides must reach the same node.\nStep back to when you created only parents.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "isLeft = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left child', 'next' => 'success'],
                ['label' => 'Right child', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 would put 2 on the right of 1.\nStep back to when you swapped the sides.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [50,20,80,15,17,19], [1,2,null,null,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
