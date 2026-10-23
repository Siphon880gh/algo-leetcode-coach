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
            'message' => "Read the problem statement above.\nLeading zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not digits: keep a started flag', 'next' => 's2'],
                ['label' => 'Treat them as digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): num1 = 1, num2 = 200 → 98 instead of 53.\nStep back to when you counted leading zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'calc(num2) − calc(num1)', 'next' => 'wrong_b'],
                ['label' => 'calc(num2) − calc(num1 − 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 0 instead of 2.\nStep back to when you dropped num1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(D · 10³). Examples → 3, 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
