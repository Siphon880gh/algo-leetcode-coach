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
            'message' => "Read the problem statement above.\nCost of index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|s[i] − t[i]|', 'next' => 's2'],
                ['label' => 's[i] − t[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Changing either way costs the distance.\nStep back to when you dropped the absolute value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Over budget. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset the window at r + 1', 'next' => 'wrong_b'],
                ['label' => 'Move l right until within budget', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A shorter window ending at r may still fit.\nStep back to when you reset.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "maxCost = 0. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Longest run of equal characters', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Free positions still form a window.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abcd\", \"bcdf\", 3 → 3. \"abcd\", \"cdef\", 3 → 1. \"abcd\", \"acde\", 0 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
