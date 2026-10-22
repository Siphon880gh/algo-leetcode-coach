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
            'message' => "Read the problem statement above.\nHow to know fn already ran?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A separate called flag', 'next' => 's2'],
                ['label' => 'Whether a result is stored', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. fn may return undefined; such an fn called twice → runs 2 times instead of 1.\nStep back to when you tested the result.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pass which arguments?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first one only', 'next' => 'wrong_b'],
                ['label' => 'All of them: ...args', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. fn takes three; Example 1 → NaN instead of 6.\nStep back to when you dropped arguments.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Examples → [{calls: 1, value: 6}], [{calls: 1, value: 140}].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
