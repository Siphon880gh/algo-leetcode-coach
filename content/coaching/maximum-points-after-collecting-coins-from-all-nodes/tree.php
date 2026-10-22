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
            'message' => "Read the problem statement above.\nThe halving option affects?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'This node and its whole subtree', 'next' => 's2'],
                ['label' => 'Only this node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Children then keep full coins; example 1 → 12 instead of 11.\nStep back to when you halved only this node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cap halvings at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No cap', 'next' => 'wrong_b'],
                ['label' => '14, since coins are below 2^14', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A long path would need up to n halving levels per node, about n² states, while every value is already 0 after 14.\nStep back to when you dropped the cap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(15n). Examples → 11, 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
