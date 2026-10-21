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
            'message' => "Read the problem statement above.\nLeaf returns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count[1] = 1', 'next' => 's2'],
                ['label' => 'count[0] = 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Depths are measured from the parent.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pair leaves on the same side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: counted lower down', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That double counts.\nStep back to when you paired same-side leaves.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Drop depths above distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: they never pair', 'next' => 'success'],
                ['label' => 'Keep all', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. They only waste work.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · d²). [1,2,3,null,4], 3 → 1. [1..7], 3 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
