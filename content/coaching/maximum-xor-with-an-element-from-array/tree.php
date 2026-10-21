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
            'message' => "Read the problem statement above.\nHandle the limit how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Offline: insert in increasing order with sorted queries', 'next' => 's2'],
                ['label' => 'Filter nums per query', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · q).\nStep back to when you filtered per query.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Greedy bit choice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefer the same bit', 'next' => 'wrong_b'],
                ['label' => 'Prefer the bit opposite to x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. XOR is 1 where bits differ.\nStep back to when you matched bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No element ≤ m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer −1', 'next' => 'success'],
                ['label' => 'Answer x', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With no candidate the statement wants −1.\nStep back to when you returned x.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → [3,3,7], [15,-1,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
