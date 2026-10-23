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
            'message' => "Read the problem statement above.\nStep cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 if closest, else the gap', 'next' => 's2'],
                ['label' => 'Always the gap', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [8, 8, 5] instead of [6, 2, 5].\nStep back to when you ignored closest moves.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie for closest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The larger index', 'next' => 'wrong_b'],
                ['label' => 'The smaller index', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): nums = [−15, −9, −3, 1, 11], query [0, 2] → 2 instead of 7.\nStep back to when you picked the larger index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Examples → [6, 2, 5], [4, 1, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
