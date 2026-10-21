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
            'message' => "Problem: Given synonym pairs (synonymy is transitive) and a sentence, return all sentences made by swapping words for synonyms, in lexicographic order. For instance, [[\"happy\",\"joy\"]] and \"I am happy\" give [\"I am happy\",\"I am joy\"]. (Restated from memory; limits and examples may differ slightly.)\nOnly direct pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: whole transitive groups', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. a ~ b and b ~ c means a can become c.\nStep back to when you used direct pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Word without synonyms?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop it', 'next' => 'wrong_b'],
                ['label' => 'Keep it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every word stays in the sentence.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order of the output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted lexicographically', 'next' => 'success'],
                ['label' => 'Generation order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output must be sorted.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(product of group sizes · length). [[\"happy\",\"joy\"]], \"I am happy\" → [\"I am happy\",\"I am joy\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
