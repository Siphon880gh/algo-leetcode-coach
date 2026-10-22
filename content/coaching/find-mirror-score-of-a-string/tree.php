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
            'message' => "Read the problem statement above.\nWhich mirror index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The closest (stack top)', 'next' => 's2'],
                ['label' => 'The farthest (oldest)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. aaz → 2 instead of 1.\nStep back to when you took the oldest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No mirror found?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push i on the mirror letter’s stack', 'next' => 'wrong_b'],
                ['label' => 'Push i on its own letter’s stack', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 5.\nStep back to when you used the mirror stack.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
