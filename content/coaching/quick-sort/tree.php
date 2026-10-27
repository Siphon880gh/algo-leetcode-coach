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
            'message' => "State:\na = [3, 1, 4, 2]\npivot = 2 (the last element)\n\nAfter a correct partition, where is 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At its final sorted index, with smaller values to its left and larger ones to its right', 'next' => 'worst'],
                ['label' => 'Still at the end, because partitioning never moves the pivot', 'next' => 'w_end'],
            ],
        ],
        'w_end' => [
            'message' => "Wrong.\n\nPartitioning swaps the pivot into its final position.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'worst' => [
            'message' => "State:\nan array that is already sorted\nthe pivot is always the last element\n\nWhat is the risk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²) time, because every partition is lopsided', 'next' => 'fix'],
                ['label' => 'It is still guaranteed O(n log n) comparisons', 'next' => 'w_guar'],
            ],
        ],
        'w_guar' => [
            'message' => "Wrong.\n\nUnlike merge sort, classic quicksort has no O(n log n) guarantee.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'worst',
            'choices' => [],
        ],
        'fix' => [
            'message' => "State:\nyou want to avoid the slowdown on sorted input\n\nWhat is the practical fix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A random pivot, a shuffle, or the median of three', 'next' => 'success'],
                ['label' => 'Stop recursing and partition only once', 'next' => 'w_once'],
            ],
        ],
        'w_once' => [
            'message' => "Wrong.\n\nBoth sides still need sorting. Fix how the pivot is chosen instead.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'fix',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Partition around a pivot, then recurse on both sides.\n- The average is O(n log n), but guard against the O(n²) pivot trap.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
