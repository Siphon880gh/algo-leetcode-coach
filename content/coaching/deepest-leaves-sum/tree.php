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
            'message' => "Read the problem statement above.\nSum what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The deepest level only', 'next' => 's2'],
                ['label' => 'All leaves', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Shallower leaves do not count.\nStep back to when you summed every leaf.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Per level?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep a running total', 'next' => 'wrong_b'],
                ['label' => 'Reset the sum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the last level's sum is wanted.\nStep back to when you kept accumulating.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "DFS alternative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset when a deeper depth appears', 'next' => 'success'],
                ['label' => 'Add at every depth', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A deeper leaf invalidates the earlier sum.\nStep back to when you never reset.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). First example → 15. Second → 19.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
