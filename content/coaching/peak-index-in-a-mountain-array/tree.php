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
            'message' => "Read the problem statement above.\nScan for the largest element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: binary search, since O(log n) is required', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The problem asks for O(log n).\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "arr[mid] < arr[mid + 1]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hi = mid', 'next' => 'wrong_b'],
                ['label' => 'lo = mid + 1: the peak is to the right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You are on the rising slope.\nStep back to when you went left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Otherwise?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hi = mid: mid may be the peak', 'next' => 'success'],
                ['label' => 'hi = mid − 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That can skip the peak itself.\nStep back to when you excluded mid.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). [0,1,0] → 1. [0,2,1,0] → 1. [0,10,5,2] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
