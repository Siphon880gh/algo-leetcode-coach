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
            'message' => "State:\na = [3, 1, 4, 2]\npivot = 2 (last)\n\nAfter a correct partition, where is 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At its final sorted index — left all ≤, right all ≥', 'next' => 'worst'],
                ['label' => 'Still at the end — partition never moves the pivot', 'next' => 'w_end'],
            ],
        ],
        'w_end' => [
            'message' => "Wrong.\n\nPartition swaps the pivot into its final resting index.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'worst' => [
            'message' => "State:\nalready-sorted array, pivot always = last element\n\nRisk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²) — unbalanced partitions every time', 'next' => 'fix'],
                ['label' => 'Still guaranteed O(n log n) comparisons', 'next' => 'w_guar'],
            ],
        ],
        'w_guar' => [
            'message' => "Wrong.\n\nClassic quicksort is not comparison-guaranteed like mergesort.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'worst',
            'choices' => [],
        ],
        'fix' => [
            'message' => "State:\nwant to avoid the sorted-input blowup\n\nPractical fix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Random pivot / shuffle / median-of-three', 'next' => 'success'],
                ['label' => 'Disable recursion and only partition once', 'next' => 'w_once'],
            ],
        ],
        'w_once' => [
            'message' => "Wrong.\n\nYou still need both sides sorted — fix the pivot policy instead.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'fix',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Partition around a pivot, recurse both sides\n- Average O(n log n); guard the O(n²) pivot trap\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
