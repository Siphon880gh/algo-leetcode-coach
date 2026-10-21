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
            'message' => "Read the problem statement above.\nAssign bags how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every child, with pruning', 'next' => 's2'],
                ['label' => 'Greedy: largest bag to the child with least', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3,3,2,2,2], k = 2 → 7 instead of 6 (3 + 3 and 2 + 2 + 2).\nStep back to when you assigned greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Unfairness?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest minus smallest', 'next' => 'wrong_b'],
                ['label' => 'The largest child total', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 31.\nStep back to when you used the spread.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Every bag handed out?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, all of them', 'next' => 'success'],
                ['label' => 'A bag may be left out', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. All bags must be given; skipping them all would make every answer 0.\nStep back to when you allowed skipping.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k^n) worst case with pruning. Examples → 31, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
