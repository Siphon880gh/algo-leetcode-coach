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
            'message' => "Problem: Given an m × n 0/1 grid where grid[i][j] = 1 means boy i may invite girl j, each boy invites at most one girl and each girl accepts at most one invitation. Return the maximum number of accepted invitations. For instance, [[1,1,1],[1,0,1],[0,0,1]] → 3 and [[1,1],[0,0]] → 1. (Restated from memory; limits and examples may differ slightly.)\nGreedy first available girl?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, use augmenting paths', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy matches only 2 in the first example.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Seen set scope?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Shared across all boys', 'next' => 'wrong_b'],
                ['label' => 'Reset for each boy', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A shared set blocks valid augmenting paths later.\nStep back to when you shared it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Girl already matched?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try to rematch her partner elsewhere', 'next' => 'success'],
                ['label' => 'Skip her', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rematching is what grows the matching.\nStep back to when you skipped her.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · m · n). Constructed check → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
