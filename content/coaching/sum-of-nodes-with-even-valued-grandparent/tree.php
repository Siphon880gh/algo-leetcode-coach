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
            'message' => "Read the problem statement above.\nMissing grandparent value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A sentinel such as −1 or null', 'next' => 's2'],
                ['label' => '0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 0 is even and would count the top levels.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add whose value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The grandparent', 'next' => 'wrong_b'],
                ['label' => 'The grandchild', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sum is of nodes whose grandparent is even.\nStep back to when you added the grandparent.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Passing to a child?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(child, node.val, parent)', 'next' => 'success'],
                ['label' => '(child, parent, node.val)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The current node becomes the parent.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). First example → 18. [1] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
