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
            'message' => "Read the problem statement above.\nOrdered or unordered pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ordered: (3,4,5) and (4,3,5) both count', 'next' => 's2'],
                ['label' => 'Unordered', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n = 5 gives 2, which counts both orders.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Perfect square test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sqrt(s) == int(sqrt(s)) with floats', 'next' => 'wrong_b'],
                ['label' => 'isqrt(s)² == s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Floating-point roots can misjudge.\nStep back to when you used floats.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Bound on c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c ≤ n', 'next' => 'success'],
                ['label' => 'No bound', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. c must also be at most n.\nStep back to when you dropped the bound.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
