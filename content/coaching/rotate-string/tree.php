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
            'message' => "Read the problem statement above.\nTry all n rotations and compare each?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: check whether goal is a substring of s + s', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you tried each rotation.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is the length check needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'wrong_b'],
                ['label' => 'Yes: a shorter goal could appear in s + s without being a rotation', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"a\" is in \"abab\" but is not a rotation of \"ab\".\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you guarantee linear time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'KMP or the Z-function on the search', 'next' => 'success'],
                ['label' => 'It is impossible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Linear-time string matching handles it.\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abcde\", \"cdeab\" → true. \"abcde\", \"abced\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
