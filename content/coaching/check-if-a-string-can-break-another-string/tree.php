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
            'message' => "Read the problem statement above.\nCompare as given?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort first', 'next' => 's2'],
                ['label' => 'Index by index unsorted', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any permutation is allowed.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Directions to check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's1 ≥ s2 only', 'next' => 'wrong_b'],
                ['label' => 'Both', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Either string may break the other.\nStep back to when you checked one way.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Faster than sorting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '26 counts', 'next' => 'success'],
                ['label' => 'Hashing whole strings', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Hashes do not order characters.\nStep back to when you hashed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abc\"/\"xya\" → true. \"abe\"/\"acd\" → false. \"leetcodee\"/\"interview\" → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
