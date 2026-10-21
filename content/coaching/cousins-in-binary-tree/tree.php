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
            'message' => "Read the problem statement above.\nSame depth is enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: they also need different parents', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Siblings share a parent and are not cousins.\nStep back to when you checked only depth.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you record for x and y?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only their values', 'next' => 'wrong_b'],
                ['label' => 'Their depth and their parent', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Values alone cannot tell you the relationship.\nStep back to when you kept only values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "BFS finds x on a level but not y. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false', 'next' => 'success'],
                ['label' => 'Keep looking deeper for y', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. y would be on a different level.\nStep back to when you kept looking.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4], x = 4, y = 3 → false. [1,2,3,null,4,null,5], x = 5, y = 4 → true. [1,2,3,null,4], x = 2, y = 3 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
