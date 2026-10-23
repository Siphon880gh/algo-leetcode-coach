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
            'message' => "Read the problem statement above.\nKeep what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The prefix through the last 2', 'next' => 's2'],
                ['label' => 'Only the 2s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → \"2\" instead of \"1112\".\nStep back to when you dropped the 1s.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No 2 at all?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return s', 'next' => 'wrong_b'],
                ['label' => 'Return ""', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → \"1\" instead of \"\".\nStep back to when you returned an odd number.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"1112\", \"22\", \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
