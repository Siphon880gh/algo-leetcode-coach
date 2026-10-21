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
            'message' => "Read the problem statement above.\nCheck every ancestor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, check the 50 value stacks', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A path of 10^5 nodes makes that quadratic.\nStep back to when you walked ancestors.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pick among coprime values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest value', 'next' => 'wrong_b'],
                ['label' => 'The top with the greatest depth', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. We want the closest ancestor.\nStep back to when you picked by value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After visiting children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop the node from its value stack', 'next' => 'success'],
                ['label' => 'Leave it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Siblings must not see it as an ancestor.\nStep back to when you left it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(50 · n). Examples → [-1,0,0,1], [-1,0,-1,0,0,0,-1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
