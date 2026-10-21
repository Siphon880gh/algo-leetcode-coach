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
            'message' => "Read the problem statement above.\nFind each jump target by scanning right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sort indices by value and use a monotonic stack', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) for n up to 2·10⁴.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "odd[i] (can reach the end starting with an odd jump) = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'odd[odd target of i]', 'next' => 'wrong_b'],
                ['label' => 'even[odd target of i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Jumps alternate, so the next jump is even.\nStep back to when you repeated odd.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Indices with odd[i] true', 'next' => 'success'],
                ['label' => 'Indices with odd[i] or even[i] true', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every start begins with an odd jump.\nStep back to when you counted even starts.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [10,13,12,14,15] → 2. [2,3,1,1,4] → 3. [5,1,3,4,2] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
