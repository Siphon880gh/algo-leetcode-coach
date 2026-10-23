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
            'message' => "Problem: You get the root of a binary tree. Find a path of connected nodes whose values are all distinct, and return the largest possible sum of its values. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nRepeated values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip a node whose value is on the path', 'next' => 's2'],
                ['label' => 'Allow them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [5, 5, 1] → 11 instead of 6.\nStep back to when you ignored the distinct rule.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the root', 'next' => 'wrong_b'],
                ['label' => 'Every node', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [−5, 4, 3] → −1 instead of 4.\nStep back to when you started only at the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Constructed checks → 6, 6, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
