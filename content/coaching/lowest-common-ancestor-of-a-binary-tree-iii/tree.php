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
            'message' => "Problem: Each node has a parent pointer. Given two nodes p and q of the same tree (no root given), return their lowest common ancestor. For instance, in [3,5,1,6,2,0,8], LCA(6, 2) = 5 and LCA(6, 1) = 3. (Restated from memory; limits and examples may differ slightly.)\nNeed the root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: parent pointers suffice', 'next' => 's2'],
                ['label' => 'Yes, find it first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Walking up already reaches the root.\nStep back to when you searched for it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pointer hits null?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Restart at its own node', 'next' => 'wrong_b'],
                ['label' => 'Restart at the other node', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Switching equalises the path lengths.\nStep back to when you restarted at its own node.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Extra space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1)', 'next' => 'success'],
                ['label' => 'O(h) required', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A hash set is optional; two pointers need none.\nStep back to when you required a set.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(h). Constructed check: (6, 2) → 5; (6, 1) → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
