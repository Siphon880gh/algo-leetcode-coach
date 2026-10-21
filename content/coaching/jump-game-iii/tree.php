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
            'message' => "Read the problem statement above.\nVisited set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Required', 'next' => 's2'],
                ['label' => 'Not needed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Jumps can cycle forever.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Moves from i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only i + arr[i]', 'next' => 'wrong_b'],
                ['label' => 'i + arr[i] and i − arr[i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both directions are allowed.\nStep back to when you only jumped right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Out-of-range index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'success'],
                ['label' => 'Wrap around', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You cannot jump outside the array.\nStep back to when you wrapped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [4,2,3,0,3,1,2], start 5 → true. [3,0,2,1,2], start 2 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
