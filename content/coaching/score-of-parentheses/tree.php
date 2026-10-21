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
            'message' => "Read the problem statement above.\nRecurse by splitting the string at each level?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: track depth; each "()" adds 2^depth', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Re-splitting can be O(n²).\nStep back to when you split.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When do you add to the score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At every ")"', 'next' => 'wrong_b'],
                ['label' => 'At a ")" right after a "("', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only innermost pairs score; outer pairs only double.\nStep back to when you added at every close.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A \"()\" has d pairs around it. Add what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 << d', 'next' => 'success'],
                ['label' => 'd + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each enclosing pair doubles the score.\nStep back to when you added the depth.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. \"()\" → 1. \"(())\" → 2. \"()()\" → 2. \"(()(()))\" → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
