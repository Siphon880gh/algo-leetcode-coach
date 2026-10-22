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
            'message' => "Read the problem statement above.\nMatch a pair a … b before the middle with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A pair b … a after it', 'next' => 's2'],
                ['label' => 'A pair a … b after it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is a repeat, not a mirror; Example 1 → 0 instead of 2.\nStep back to when you matched the same order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The before-table for middle i covers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Indices up to and including i', 'next' => 'wrong_b'],
                ['label' => 'Indices before i only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The middle gets reused as an outer letter; Example 1 → 14 instead of 2.\nStep back to when you included i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(100 · n). Examples → 2, 21, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
