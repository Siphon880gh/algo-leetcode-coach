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
            'message' => "Read the problem statement above.\nf(s)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count of the smallest letter in s', 'next' => 's2'],
                ['label' => 'Count of the most frequent letter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It is the smallest letter's frequency.\nStep back to when you took the most frequent.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Recompute f(word) per query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: once per word', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That repeats work for every query.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count words with f(word) what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '> f(query)', 'next' => 'success'],
                ['label' => '≥ f(query)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Strictly greater.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((q + w) · L). [\"cbd\"], [\"zaaaz\"] → [1]. [\"bbb\",\"cc\"], [\"a\",\"aa\",\"aaa\",\"aaaa\"] → [1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
