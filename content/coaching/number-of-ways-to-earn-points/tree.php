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
            'message' => "Read the problem statement above.\nWhere do the new counts go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A fresh array for this type', 'next' => 's2'],
                ['label' => 'Into dp itself, t ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Updated cells get reused, so a type is taken too often; Example 1 → 55 instead of 7.\nStep back to when you updated in place.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "j ranges over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 … count', 'next' => 'wrong_b'],
                ['label' => '0 … count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Skipping a type must stay possible; Example 1 → 1 instead of 7.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(target · Σ count). Examples → 7, 4, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
