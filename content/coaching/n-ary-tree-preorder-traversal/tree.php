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
            'message' => "Read the problem statement above.\nIn what order are values recorded?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The node first, then each child from left to right', 'next' => 's2'],
                ['label' => 'The children first, then the node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is postorder (590).\nStep back to when you put the node last.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Iterative version: which structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A queue', 'next' => 'wrong_b'],
                ['label' => 'A stack', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A queue visits level by level, which is level order, not preorder.\nStep back to when you used a queue.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "In what order do you push the children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In reverse, so the leftmost child is on top', 'next' => 'success'],
                ['label' => 'In their normal order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last child pushed comes out first, so the rightmost child would be visited before the leftmost.\nStep back to when you pushed in order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Node, then children; iteratively, push the children in reverse: O(n) time.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
