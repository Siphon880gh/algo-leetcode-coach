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
            'message' => "Read the problem statement above.\nHow do you sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By end ascending, and start descending on ties', 'next' => 's2'],
                ['label' => 'By start ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy point placement works from the earliest end.\nStep back to when you sorted by start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Neither chosen point is inside [s, e]. Add which?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's and s + 1', 'next' => 'wrong_b'],
                ['label' => 'e − 1 and e', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Right-end points are more likely to sit inside later intervals.\nStep back to when you picked from the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Only the larger point b is inside. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add e and shift: a = b, b = e', 'next' => 'success'],
                ['label' => 'Add e − 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. e is the most useful point, and b stays inside.\nStep back to when you added e − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [[1,3],[3,7],[8,9]] → 5. [[1,3],[1,4],[2,5],[3,5]] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
