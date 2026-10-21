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
            'message' => "Read the problem statement above.\nEnumerate all subarrays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: carry the set of ORs ending at the previous index', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) for n up to 5·10⁴.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The new set for index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '{x | a[i] for x in prev}', 'next' => 'wrong_b'],
                ['label' => '{x | a[i] for x in prev} ∪ {a[i]}', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The subarray made of a[i] alone is missing.\nStep back to when you dropped a[i].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why is that set small?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ORs only add bits, so it is a chain of at most about 30 values', 'next' => 'success'],
                ['label' => 'It is not; it can hold n values', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each larger value adds at least one bit to a 30-bit number.\nStep back to when you expected n values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 30). [0] → 1. [1,1,2] → 3. [1,2,4] → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
