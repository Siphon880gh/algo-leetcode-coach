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
            'message' => "Read the problem statement above.\nflip()?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swap the bits with a kept complement', 'next' => 's2'],
                ['label' => 'Invert every bit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Up to 10^5 calls on 10^5 bits is about 10^10 steps.\nStep back to when you looped over the bits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "count()?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count the ones each call', 'next' => 'wrong_b'],
                ['label' => 'A maintained counter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(size) per call, again too slow over 10^5 calls.\nStep back to when you recounted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "fix on a bit that is already 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No change', 'next' => 'success'],
                ['label' => 'Increment the count anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The count would exceed the real number of ones.\nStep back to when you always incremented.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call, O(size) for toString. Example 1 matches.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
