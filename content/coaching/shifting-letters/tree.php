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
            'message' => "Read the problem statement above.\nApply each shift to its prefix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: letter i moves by the suffix sum from i', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you applied prefixes one by one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sweep in which direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left to right, adding shifts[i] to a running total', 'next' => 'wrong_b'],
                ['label' => 'Right to left, adding shifts[i] to a running total', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Letter i needs shifts[i…n − 1], and adding from the left builds the wrong sum.\nStep back to when you swept left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Shifts reach 10⁹. When do you take mod 26?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At each step', 'next' => 'success'],
                ['label' => 'Only at the end', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The running sum can overflow fixed-width integers.\nStep back to when you deferred the mod.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abc\", [3,5,9] → \"rpl\". \"aaa\", [1,2,3] → \"gfd\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
