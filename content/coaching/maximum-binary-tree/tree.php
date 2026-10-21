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
            'message' => "Read the problem statement above.\nRecurse: max as the root, then build the left and right parts. Worst case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²), on sorted input', 'next' => 's2'],
                ['label' => 'O(n log n) always', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorted input makes one side empty every time, so each max scan is O(n).\nStep back to when you assumed balanced splits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Use a stack of decreasing values. A new node x pops smaller nodes. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every popped node becomes x\'s right child', 'next' => 'wrong_b'],
                ['label' => 'The last node popped becomes x\'s left child', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The popped nodes are on x's left in the array, and the largest of them, popped last, is x's left child.\nStep back to when you attached them on the right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After popping, the stack top is larger than x. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x becomes the top\'s right child, then push x', 'next' => 'success'],
                ['label' => 'x becomes the top\'s left child', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. x comes after the top in the array, so it belongs in the top's right subtree.\nStep back to when you attached it on the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. A decreasing stack, with the bottom as the root: O(n). [3,2,1,6,0,5] → root 6, left 3 → right 2 → right 1, right 5 → left 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
