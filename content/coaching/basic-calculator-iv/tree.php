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
            'message' => "Read the problem statement above.\nHow do you represent a value like 2*a*b + 3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A map from sorted variable tuples to coefficients', 'next' => 's2'],
                ['label' => 'A string, rewritten as you go', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Strings make collecting like terms painful.\nStep back to when you used strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Multiplying two terms gives which key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The concatenation in original order', 'next' => 'wrong_b'],
                ['label' => 'The sorted concatenation of both tuples', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. a*b and b*a must be the same term.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How is the output ordered?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By degree descending, then lexicographically; zero coefficients dropped', 'next' => 'success'],
                ['label' => 'By coefficient size', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem orders by degree and then by the variable names.\nStep back to when you sorted by coefficient.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Polynomial arithmetic with a precedence parser. \"e + 8 - a + 5\" with e = 1 → [\"-1*a\",\"14\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
