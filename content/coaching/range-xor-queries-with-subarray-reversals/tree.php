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
            'message' => "Problem: Given an array and a list of queries, each query either sets one element, asks for the XOR of a range, or reverses a range in place. Return the answers to the XOR queries in order. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nReversals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Apply them (they move values)', 'next' => 's2'],
                ['label' => 'Skip them, since a range XOR does not change', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2, 3] with reverse(0, 2), set(0, 9), XOR(2, 2) → [3] instead of [1].\nStep back to when you skipped reversals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After set, what else changes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing but that node’s value', 'next' => 'wrong_b'],
                ['label' => 'The XOR stored in every node above it (recomputed on merge)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 2, 3] with set(0, 9), XOR(0, 2) → 0 instead of 8.\nStep back to when you left the totals stale.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) expected per query. Checks → [2, 2], [1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
