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
            'message' => "Read the problem statement above.\nRestriction check on request (u, v)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any restriction whose roots are the roots of u and v', 'next' => 's2'],
                ['label' => 'Only restrictions naming u and v directly', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 1: 2 is already friends with 0, so request [2,1] breaks restriction [0,1] → false.\nStep back to when you checked only u and v.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A failed request?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Union anyway', 'next' => 'wrong_b'],
                ['label' => 'Change nothing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rejected friendships never form and must not affect later requests.\nStep back to when you merged.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A successful request?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Union the two groups', 'next' => 'success'],
                ['label' => 'Only record the pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Friendship is transitive for later restriction checks.\nStep back to when you skipped the union.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q · r · α(n)). Examples → [true,false], [true,false], [true,false,true,false].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
