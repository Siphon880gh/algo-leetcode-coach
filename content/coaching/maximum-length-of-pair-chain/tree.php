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
            'message' => "Read the problem statement above.\nWhat do you sort by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The second value of each pair (its end)', 'next' => 's2'],
                ['label' => 'The first value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A long pair that starts early can block many short ones.\nStep back to when you sorted by start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When do you take a pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When its first value is at least the last end', 'next' => 'wrong_b'],
                ['label' => 'When its first value is greater than the last chosen end', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A chain needs b < c strictly, so a pair starting exactly at the last end does not fit.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why is greedy enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The earliest-ending pair leaves the most room for the rest', 'next' => 'success'],
                ['label' => 'It is only a heuristic, so switch to DP', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Swapping any chain's first pair for the earliest-ending one never makes it worse, so greedy is optimal; DP is just slower.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort by end, greedy with strict b < c: O(n log n) time. [[1,2],[2,3],[3,4]] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
