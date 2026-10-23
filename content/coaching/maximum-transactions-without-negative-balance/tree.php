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
            'message' => "Problem: Given a list of transactions in order, where a positive amount adds money and a negative amount takes it away, you may skip any of them. Starting from a balance of 0, the balance must never go below 0. Return the largest number of transactions you can perform. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nBalance goes below 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop the most negative transaction taken so far', 'next' => 's2'],
                ['label' => 'Skip the current one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [3, −3, −1, −1] → 2 instead of 3.\nStep back to when you skipped the current one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which one to drop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The least negative', 'next' => 'wrong_b'],
                ['label' => 'The most negative (min-heap)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [3, −3, −1, −1] → 2 instead of 3.\nStep back to when you dropped the small one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 3, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
