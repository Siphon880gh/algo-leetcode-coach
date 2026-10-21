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
            'message' => "Problem: Given a matrix whose rows are strictly increasing, return the smallest value present in every row, or −1. For instance, [[1,3,6],[2,3,6],[3,6,9]] gives 3 and [[1,2],[3,4]] gives −1. (Restated from memory; limits and examples may differ slightly.)\nWhy can a count stand for \"in every row\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rows are strictly increasing, so no repeats in a row', 'next' => 's2'],
                ['label' => 'It cannot', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With no repeats, each row adds at most 1.\nStep back to when you doubted the count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Scan which values for the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The most frequent value', 'next' => 'wrong_b'],
                ['label' => 'The first row, in order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The answer is the smallest common value.\nStep back to when you took the most frequent.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No value reaches the row count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'success'],
                ['label' => 'The smallest value of the first row', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Nothing is common to all rows.\nStep back to when you returned a value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows · cols). [[1,3,6],[2,3,6],[3,6,9]] → 3. [[1,2],[3,4]] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
