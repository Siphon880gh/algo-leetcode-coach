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
            'message' => "Problem: Given the head of a singly linked list sorted in non-decreasing order of absolute values, return the list sorted in non-decreasing order of actual values. For instance, [0,2,-5,5,10,-10] → [-10,-5,0,2,5,10]; [0,1,2] → [0,1,2]; [1] → [1]. (Restated from memory; limits and examples may differ slightly.)\nWhich nodes are out of place?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The negative ones', 'next' => 's2'],
                ['label' => 'The non-negative ones', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Non-negatives sorted by absolute value are already sorted.\nStep back to when you moved them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does each negative go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just before the first non-negative', 'next' => 'wrong_b'],
                ['label' => 'To the head', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later negatives are smaller; [0,2,-5,5,10,-10] would end with -5 before -10.\nStep back to when you inserted before the first non-negative.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After unlinking cur, advance prev?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: prev stays, cur = prev.next', 'next' => 'success'],
                ['label' => 'Yes: prev = cur', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. prev would point at the node you just moved to the front.\nStep back to when you advanced prev.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) extra. Constructed checks → [-10,-5,0,2,5,10], [0,1,2], [1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
