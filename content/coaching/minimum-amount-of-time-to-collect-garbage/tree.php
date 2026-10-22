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
            'message' => "Read the problem statement above.\nPick-up minutes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total number of characters', 'next' => 's2'],
                ['label' => 'Number of houses holding each type', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. GG is two units; Example 1 → 20 instead of 21.\nStep back to when you counted houses.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How far does each truck drive?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'To the last house', 'next' => 'wrong_b'],
                ['label' => 'To the last house with its type', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 33 instead of 21.\nStep back to when every truck drove to the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A type that never appears?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its truck stays at house 0', 'next' => 'success'],
                ['label' => 'Its truck still drives to the last house', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In Example 1 there is no metal; driving that truck too gives 30 instead of 21.\nStep back to when you sent an empty truck.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → 21, 37.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
