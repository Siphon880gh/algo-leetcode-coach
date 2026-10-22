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
            'message' => "Read the problem statement above.\nSubtract what from n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct servers in the window', 'next' => 's2'],
                ['label' => 'Requests in the window', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One server can send many requests; n = 2, logs [1, 1] and [1, 2], x = 5, query 6 → 0 instead of 1.\nStep back to when you counted requests.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is time q − x in the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'wrong_b'],
                ['label' => 'Yes, both ends are inclusive', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The interval is closed; example 2 → [2, 2] instead of [0, 1].\nStep back to when you excluded q − x.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L log L + q log q). Examples → [1, 2], [0, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
