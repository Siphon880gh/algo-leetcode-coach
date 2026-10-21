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
            'message' => "Read the problem statement above.\nWhat shape is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A contiguous window of length k in the sorted array', 'next' => 's2'],
                ['label' => 'Any k values; sort by distance', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting by distance works but is O(n log n); because the array is sorted, the k closest are contiguous.\nStep back to when you sorted by distance.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Search left edges over which range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[0, n − 1]', 'next' => 'wrong_b'],
                ['label' => '[0, n − k]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The window must fit, so the start is at most n − k.\nStep back to when you used n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "At mid, compare what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'If x − arr[mid] > arr[mid + k] − x, set lo = mid + 1; else hi = mid', 'next' => 'success'],
                ['label' => 'Whether arr[mid] < x', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Compare the element leaving the window with the one that would enter; ties keep the smaller value.\nStep back to when you compared with x alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Binary search the start: O(log(n − k) + k). [1,2,3,4,5], k = 4, x = 3 → [1,2,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
