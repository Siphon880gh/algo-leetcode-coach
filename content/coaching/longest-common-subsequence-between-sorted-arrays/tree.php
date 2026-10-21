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
            'message' => "Problem: Given several arrays, each sorted in strictly increasing order, return the longest common subsequence of all of them, i.e. the values present in every array, in increasing order. For instance, [[1,3,4],[1,4,7,9]] → [1,4]; [[2,3,6,8],[1,2,3,5,6,7,10],[2,3,4,6,9]] → [2,3,6]; and [[1,2,3,4,5],[6,7,8]] → []. (Restated from memory; limits and examples may differ slightly.)\nGeneral LCS DP?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, sorted distinct arrays allow counting', 'next' => 's2'],
                ['label' => 'Yes, pairwise LCS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Strictly increasing arrays make it a set intersection.\nStep back to when you ran DP.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep a value when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count ≥ 2', 'next' => 'wrong_b'],
                ['label' => 'Count equals the number of arrays', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It must be in every array.\nStep back to when you used 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing', 'next' => 'success'],
                ['label' => 'Order of first appearance', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A subsequence of sorted arrays is increasing.\nStep back to when you kept appearance order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → [1,4], [2,3,6], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
