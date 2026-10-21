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
            'message' => "Read the problem statement above.\nWhich end gets large letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The back', 'next' => 's2'],
                ['label' => 'The front', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Large letters at the front make the string bigger.\nStep back to when you filled the front.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letter at position i (from the back)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always z', 'next' => 'wrong_b'],
                ['label' => 'min(26, k − (i − 1))', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each earlier position needs at least 1.\nStep back to when you always used z.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Build method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Character list, then join', 'next' => 'success'],
                ['label' => 'Repeated string prepends', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Prepending is O(n²).\nStep back to when you prepended.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 3, k = 27 → \"aay\". n = 5, k = 73 → \"aaszz\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
