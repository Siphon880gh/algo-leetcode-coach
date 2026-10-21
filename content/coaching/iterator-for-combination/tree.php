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
            'message' => "Read the problem statement above.\nCombinations or permutations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Combinations: increasing positions', 'next' => 's2'],
                ['label' => 'Permutations', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Characters keep their string order.\nStep back to when you permuted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Generate when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On every next()', 'next' => 'wrong_b'],
                ['label' => 'Once, in the constructor', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rebuilding wastes work per call.\nStep back to when you regenerated.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "hasNext()?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'idx < count', 'next' => 'success'],
                ['label' => 'idx ≤ count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. idx = count means none are left.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(C(n, k) · k) build, O(1) per call. \"abc\", 2 → \"ab\", \"ac\", \"bc\", then hasNext false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
