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
            'message' => "Read the problem statement above.\nEnumerate subarrays and take minimums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count each element\'s share', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) for n up to 3·10⁴.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "arr[i] is the minimum of how many subarrays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i + 1', 'next' => 'wrong_b'],
                ['label' => 'left[i] · right[i], the distances to the nearest smaller elements', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The subarray can extend on both sides until a smaller element.\nStep back to when you counted one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal values: strict on both sides?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: strict on one side, non-strict on the other', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Subarrays with two equal minimums would be counted twice, or not at all.\nStep back to when you used strict on both.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,1,2,4] → 17. [11,81,94,43,3] → 444.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
