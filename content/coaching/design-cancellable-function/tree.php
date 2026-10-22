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
            'message' => "Read the problem statement above.\nA yielded promise rejects?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'gen.throw(error)', 'next' => 's2'],
                ['label' => 'Reject the outer promise at once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The generator may catch it; Example 6 → rejected Promise Rejected instead of resolved 4.\nStep back to when you rejected directly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cancel throws?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'new Error with that message', 'next' => 'wrong_b'],
                ['label' => 'The string Cancelled', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for the string itself; Example 3 → rejected with an Error object instead of the string.\nStep back to when you wrapped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per yield. Examples → 42, Error: Hello, Cancelled, 2, 1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
