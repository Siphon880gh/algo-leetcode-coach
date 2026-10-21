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
            'message' => "Read the problem statement above.\nLoop over [low, high]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: generate candidates', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The range can be about 10⁹ wide.\nStep back to when you looped over it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Generation order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By start, then length', 'next' => 'wrong_b'],
                ['label' => 'By length, then start', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That order is not increasing.\nStep back to when you looped over starts first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Candidates in total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most 36', 'next' => 'success'],
                ['label' => 'Up to 9!', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each length has at most 9 − L + 1 starts.\nStep back to when you counted permutations.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). 100..300 → [123,234]. 1000..13000 → [1234,2345,3456,4567,5678,6789,12345].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
