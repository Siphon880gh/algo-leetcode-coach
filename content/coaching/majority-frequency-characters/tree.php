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
            'message' => "Read the problem statement above.\nPick the group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How many letters it has', 'next' => 's2'],
                ['label' => 'The highest count', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → \"d\" instead of \"ab\".\nStep back to when you picked the highest count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie between groups?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smaller count', 'next' => 'wrong_b'],
                ['label' => 'The larger count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → \"gi\" instead of \"fp\".\nStep back to when you took the smaller.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"ab\", \"abcd\", \"fp\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
