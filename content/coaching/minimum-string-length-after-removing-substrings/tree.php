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
            'message' => "Read the problem statement above.\nOne pass of replacing AB and CD?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, scan with a stack', 'next' => 's2'],
                ['label' => 'Yes, replace each once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Removals expose new pairs; example 1 → 4 instead of 2.\nStep back to when you replaced once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which pairs are removed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Also BA and DC', 'next' => 'wrong_b'],
                ['label' => 'Only AB and CD in that order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Order matters; BA → 0 instead of 2.\nStep back to when you allowed reversed pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
