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
            'message' => "Read the problem statement above.\nMove cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 if i + j is even, else 2', 'next' => 's2'],
                ['label' => 'Always 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 6 instead of 7.\nStep back to when you charged 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Arrival at v?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(t + cost, moveTime[v])', 'next' => 'wrong_b'],
                ['label' => 'max(t, moveTime[v]) + cost', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 6 instead of 7.\nStep back to when you treated moveTime as an arrival time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(nm log(nm)). Examples → 7, 6, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
