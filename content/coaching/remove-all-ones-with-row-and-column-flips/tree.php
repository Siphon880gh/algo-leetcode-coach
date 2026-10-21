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
            'message' => "Problem: Given an m × n binary matrix grid, one operation flips every value in a chosen row or a chosen column. Return true if some sequence of operations makes every cell 0, otherwise false. For instance, [[0,1,0],[1,0,1],[0,1,0]] → true; [[1,1,0],[0,0,0],[0,0,0]] → false; [[0]] → true. (Restated from memory; limits and examples may differ slightly.)\nDoes the order of flips matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: flips commute and pairs cancel', 'next' => 's2'],
                ['label' => 'Yes, search over sequences', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each cell ends flipped by its row count plus column count, whatever the order.\nStep back to when you searched sequences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A row that is the complement of row 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Impossible', 'next' => 'wrong_b'],
                ['label' => 'Fine: flip that row', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[0,1,0],[1,0,1],[0,1,0]] → true.\nStep back to when you rejected it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Check rows how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each equals row 0 or its complement', 'next' => 'success'],
                ['label' => 'Each has the same number of 1s', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [[1,1,0],[1,0,1]] has two 1s per row but is false.\nStep back to when you compared counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Constructed checks → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
