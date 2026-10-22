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
            'message' => "Read the problem statement above.\nWindow test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't[i + 2] − t[i] < 60', 'next' => 's2'],
                ['label' => 't[i + 2] − t[i] ≤ 60', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Exactly one hour apart is not the same period; 0815, 0845, 0915 would count.\nStep back to when you used ≤ 60.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Before testing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep input order', 'next' => 'wrong_b'],
                ['label' => 'Sort each employee’s times', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1000, 0800, 0900 in that order would pass although they span two hours.\nStep back to when you kept input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [a], [c, d], [ab, cd].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
