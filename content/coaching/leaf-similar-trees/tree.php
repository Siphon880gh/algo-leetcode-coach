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
            'message' => "Read the problem statement above.\nWhat counts as a leaf?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A node with no children', 'next' => 's2'],
                ['label' => 'A node with at most one child', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A node with one child is internal.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which order do you visit children in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any order', 'next' => 'wrong_b'],
                ['label' => 'Left, then right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The leaf sequence is read left to right.\nStep back to when you ignored the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you compare the two results?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As ordered lists', 'next' => 'success'],
                ['label' => 'As sets', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Order and repeats both matter.\nStep back to when you compared sets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n₁ + n₂). root1 = [3,5,1,6,2,9,8,null,null,7,4], root2 = [3,5,1,6,7,4,2,null,null,null,null,null,null,9,8] → true. [1,2,3], [1,3,2] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
