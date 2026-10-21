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
            'message' => "Read the problem statement above.\nCombine with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION ALL', 'next' => 's2'],
                ['label' => 'UNION', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A name equal to a title would collapse.\nStep back to when you used UNION.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Average filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All ratings', 'next' => 'wrong_b'],
                ['label' => 'Only February 2020 ratings', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The second question is about February 2020.\nStep back to when you used all ratings.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Ties?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lexicographically smaller first', 'next' => 'success'],
                ['label' => 'Any', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Both parts break ties by name.\nStep back to when you ignored ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → Daniel, Frozen 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
