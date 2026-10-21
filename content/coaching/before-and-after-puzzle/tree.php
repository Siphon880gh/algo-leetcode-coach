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
            'message' => "Problem: Given phrases, join two different phrases where the last word of the first equals the first word of the second, writing the shared word once, and return all distinct results in lexicographic order. For instance, [\"writing code\",\"code rocks\"] gives [\"writing code rocks\"]. (Restated from memory; limits and examples may differ slightly.)\nPair a phrase with itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: different entries only', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The two phrases must be different entries.\nStep back to when you paired it with itself.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join \"a b\" and \"b a\" as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"a b b a"', 'next' => 'wrong_b'],
                ['label' => '"a b a"', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The shared word is written once.\nStep back to when you repeated it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Same result from two pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it once, then sort', 'next' => 'success'],
                ['label' => 'Keep both', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output is distinct strings.\nStep back to when you kept duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · L) worst case. [\"a b\",\"b a\"] → [\"a b a\",\"b a b\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
