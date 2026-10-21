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
            'message' => "Read the problem statement above.\nMiddle of 4 nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Index 2', 'next' => 's2'],
                ['label' => 'Index 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The middle is ⌊n / 2⌋; Example 2 removes 3, not 2.\nStep back to when you used index 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where should slow stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On the middle', 'next' => 'wrong_b'],
                ['label' => 'On the node before the middle', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In a singly linked list you need the previous node to unlink the middle.\nStep back to when you stopped on the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A list of one node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return an empty list', 'next' => 'success'],
                ['label' => 'Return it unchanged', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Its middle is index 0, the only node.\nStep back to when you left it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) extra. Examples → [1,3,4,1,2,6], [1,2,4], [2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
