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
            'message' => "Problem: Given an integer array nums of length n, answer n queries: for each i (0-indexed), return the maximum, over all subarrays of length i + 1, of that subarray's minimum. For instance, [0,1,2,4] → [4,2,1,0], and [10,20,50,10] → [50,20,10,10]. (Restated from memory; limits and examples may differ slightly.)\nWidth of nums[i] as minimum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Between previous smaller and next smaller', 'next' => 's2'],
                ['label' => 'Just i alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It is the minimum of a wider window.\nStep back to when you used width 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Final sweep direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From small to large', 'next' => 'wrong_b'],
                ['label' => 'From large widths to small', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A wide-window candidate also serves narrower sizes.\nStep back to when you swept upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop on one side only', 'next' => 'success'],
                ['label' => 'Stop on both sides', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every copy of [2, 2] would get width 1.\nStep back to when you stopped on both sides.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → [4,2,1,0], [50,20,10,10].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
