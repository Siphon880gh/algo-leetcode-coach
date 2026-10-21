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
            'message' => "Read the problem statement above.\nHow do you search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS over strings; each edge is one swap', 'next' => 's2'],
                ['label' => 'Greedy swaps', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A greedy swap can pick a partner that costs extra swaps later.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which swaps do you try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All pairs (i, j)', 'next' => 'wrong_b'],
                ['label' => 'Fix the first mismatch i; swap with j > i where s[j] == goal[i] and s[j] != goal[j]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. All pairs add many useless swaps and blow up the frontier.\nStep back to when you tried all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You dequeue goal. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return its BFS level', 'next' => 'success'],
                ['label' => 'Keep searching for a shorter path', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. BFS reaches goal first at the shortest distance.\nStep back to when you kept searching.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Exponential in the worst case, fast for length ≤ 20. \"ab\", \"ba\" → 1. \"abc\", \"bca\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
