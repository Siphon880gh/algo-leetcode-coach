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
            'message' => "Problem: Problem: Given keywords and a string s, wrap every keyword occurrence in <b></b>, merging overlapping or touching bold parts so the fewest tags are used. (Restated from memory; limits and examples may differ slightly.)\nInsert tags as soon as you find a match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: mark characters first, then tag', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Overlapping matches would produce broken or nested tags.\nStep back to when you tagged immediately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two bold runs touch, like \"ab\" and \"cd\" in \"abcd\". Tags?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two pairs', 'next' => 'wrong_b'],
                ['label' => 'One pair: the marks are contiguous', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Touching bold parts must merge.\nStep back to when you used two pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you open <b>?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At a marked character whose previous character is unmarked (or i == 0)', 'next' => 'success'],
                ['label' => 'At every marked character', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only the start of a run opens a tag.\nStep back to when you opened at every mark.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · Σ|w|). [\"ab\",\"bc\"], \"aabcd\" → \"a<b>abc</b>d\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
