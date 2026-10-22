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
            'message' => "Read the problem statement above.\nWhat does sleep return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A promise that the timer resolves', 'next' => 's2'],
                ['label' => 'The timer id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Awaiting a number returns at once; millis = 100 → about 0 ms instead of 100.\nStep back to when you returned the id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What goes into setTimeout?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'resolve()', 'next' => 'wrong_b'],
                ['label' => 'resolve', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. resolve() runs right away; millis = 100 → about 0 ms instead of 100.\nStep back to when you called it early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 100, 200.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
