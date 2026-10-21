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
            'message' => "Read the problem statement above.\nOne of the two nodes is null. What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The other node', 'next' => 's2'],
                ['label' => 'null', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The other tree's subtree would be lost from the result.\nStep back to when you returned null.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Both nodes exist. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge a.left with b.right', 'next' => 'wrong_b'],
                ['label' => 'Value a.val + b.val; merge a.left with b.left and a.right with b.right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The trees are laid on top of each other, so left goes with left.\nStep back to when you crossed the sides.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can you do it without recursion?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: a queue or stack of node pairs', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Push (a, b) pairs and process them the same way; the logic is identical.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Overlapping nodes add, missing sides reuse the other subtree: O(min(n1, n2)) time.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
