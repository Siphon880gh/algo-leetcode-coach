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
            'message' => "Problem: Given two strings, return a shortest string that contains both as substrings; if several exist, any one is accepted. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nOrders to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both', 'next' => 's2'],
                ['label' => 'Only a then b', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. bcd, abc → bcdabc instead of abcd.\nStep back to when you tried one order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One string inside the other?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge by overlap anyway', 'next' => 'wrong_b'],
                ['label' => 'Return the longer one', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. xy, axyb → xyaxyb instead of axyb.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m)²). Checks → abcd, axyb, aba.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
