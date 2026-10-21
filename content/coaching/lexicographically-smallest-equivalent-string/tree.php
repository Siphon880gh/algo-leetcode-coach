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
            'message' => "Read the problem statement above.\nMap letters only through their direct pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: equivalence is transitive, so use union-find', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. a = b and b = c make a = c.\nStep back to when you used direct pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which letter becomes the root on a union?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one from the larger set', 'next' => 'wrong_b'],
                ['label' => 'The smaller one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The root must be the smallest letter.\nStep back to when you used set size.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Then each letter of baseStr becomes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'find(letter)', 'next' => 'success'],
                ['label' => 'The letter itself', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each letter is replaced by the smallest equivalent.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) · α). \"parker\", \"morris\", \"parser\" → \"makkek\". \"hello\", \"world\", \"hold\" → \"hdld\". \"leetcode\", \"programs\", \"sourcecode\" → \"aauaaaaada\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
