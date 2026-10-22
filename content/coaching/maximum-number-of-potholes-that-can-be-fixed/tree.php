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
            'message' => "Problem: A road is a string of potholes and smooth cells. Repairing consecutive potholes costs the amount the statement gives, and you have a budget. Return the most potholes you can repair. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nAssume, as the guide does, that k potholes cost k + 1. Which runs first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Longest first', 'next' => 's2'],
                ['label' => 'Shortest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every repair pays the extra 1: x.xxx with budget 4 → 2 instead of 3.\nStep back to when you sorted shortest first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Budget runs out mid-run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fix budget of it', 'next' => 'wrong_b'],
                ['label' => 'Fix budget − 1 of it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The partial repair pays the extra 1 too: ..xxxxx with budget 4 → 4 instead of 3.\nStep back to when you forgot the charge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s constructed checks match.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
