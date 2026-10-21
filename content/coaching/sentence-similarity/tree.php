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
            'message' => "Problem: Problem: Two sentences (word arrays) are similar if they have the same length and, at each position, the words are equal or appear together in the given list of similar pairs (either order). Similarity does not chain. (Restated from memory; limits and examples may differ slightly.)\nThe sentences have different lengths. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false', 'next' => 's2'],
                ['label' => 'Compare the shorter prefix', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Similarity requires the same length.\nStep back to when you compared prefixes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you store the pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only (a, b)', 'next' => 'wrong_b'],
                ['label' => 'A set with both (a, b) and (b, a)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairs work in either order.\nStep back to when you stored one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "a~b and b~c are listed. Is a~c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: similarity here is not transitive', 'next' => 'success'],
                ['label' => 'Yes: union them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Chaining is problem 737; here only listed pairs count.\nStep back to when you chained.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + p). [\"great\",\"acting\",\"skills\"] vs [\"fine\",\"drama\",\"talent\"] with those three pairs → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
