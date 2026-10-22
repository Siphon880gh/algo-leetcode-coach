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
            'message' => "Read the problem statement above.\nThe first call happens when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Immediately, before setInterval', 'next' => 's2'],
                ['label' => 'On setInterval’s first tick', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. setInterval waits t first; example 1 → first call at 35 ms instead of 0.\nStep back to when you relied on setInterval alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeat with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One setTimeout after t ms', 'next' => 'wrong_b'],
                ['label' => 'setInterval every t ms', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That fires once; in Node example 1 → calls at 0 and 35 ms only, instead of 0 through 175.\nStep back to when you used setTimeout.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Example 1 → calls at 0, 35, 70, 105, 140, 175 ms.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
