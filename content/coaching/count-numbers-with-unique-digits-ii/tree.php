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
            'message' => "Problem: You are given two positive integers a and b. Return how many integers in the range from a to b, inclusive, have no repeated digit. Limits are in the official statement. For instance, a = 1, b = 20 → 19 (only 11 repeats a digit), and a = 80, b = 120 → 27. (Restated from memory; limits and examples may differ slightly.)\nCount over [a, b] as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f(b) − f(a − 1)', 'next' => 's2'],
                ['label' => 'f(b) − f(a)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That drops a itself; a = b = 12 → 0 instead of 1.\nStep back to when you subtracted f(a).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Numbers with fewer digits than x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '10 · 9 · 8 · … per length', 'next' => 'wrong_b'],
                ['label' => '9 · 9 · 8 · … per length', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That lets 0 lead; a = 1, b = 20 → 20 instead of 19.\nStep back to when you allowed a leading 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The examples → 19, 27.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
