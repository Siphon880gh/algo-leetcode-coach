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
            'message' => "Problem: arr holds distinct integers in ascending order. Return the smallest index i with arr[i] == i, or −1. [-10,-5,0,3,7] → 3. [0,2,5,8,17] → 0. [-10,-5,3,4,7,9] → −1. (Restated from memory; limits and examples may differ slightly.)\nWhy is arr[i] − i monotone?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct sorted integers rise by at least 1 each step', 'next' => 's2'],
                ['label' => 'Because arr is sorted', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorted alone allows repeats; distinctness is what matters.\nStep back to when you cited sorting only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "arr[mid] == mid. Return mid right away?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: a smaller fixed point may lie to the left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The question asks for the smallest index.\nStep back to when you returned early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The search ends at lo. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lo if lo < n and arr[lo] == lo, else −1', 'next' => 'success'],
                ['label' => 'lo', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. arr[lo] may exceed lo.\nStep back to when you returned lo.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). [-10,-5,0,3,7] → 3. [0,2,5,8,17] → 0. [-10,-5,3,4,7,9] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
