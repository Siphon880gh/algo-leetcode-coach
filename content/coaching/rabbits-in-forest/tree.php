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
            'message' => "Read the problem statement above.\nA rabbit answers x. Its group size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x + 1, counting itself', 'next' => 's2'],
                ['label' => 'x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. x others share its color, plus the rabbit itself.\nStep back to when you used x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "c rabbits answer x. How many groups?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c', 'next' => 'wrong_b'],
                ['label' => 'ceil(c / (x + 1))', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rabbits with the same answer can share a group.\nStep back to when you used one group each.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can rabbits with different answers share a color?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: their group sizes differ', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A color group has one size, so all its members give the same answer.\nStep back to when you mixed answers.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,1,2] → 5. [10,10,10] → 11. [0,0,1,1,1] → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
