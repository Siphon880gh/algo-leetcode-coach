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
            'message' => "Problem: A string s mixes plain letters with non-nested option groups like {a,b,c}, each meaning \"pick one\". Return every word the string can form, sorted lexicographically. \"{a,b}c{d,e}f\" → [\"acdf\",\"acef\",\"bcdf\",\"bcef\"]. \"abcd\" → [\"abcd\"]. (Restated from memory; limits and examples may differ slightly.)\nWhat does parsing produce?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A list of option lists, one per position', 'next' => 's2'],
                ['label' => 'A single list of letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each position needs its own choices.\nStep back to when you flattened.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why sort each group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It is not needed at all', 'next' => 'wrong_b'],
                ['label' => 'Then the DFS emits words in lexicographic order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without it you must sort the output afterward.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Groups can be nested?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: that is Brace Expansion II', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. This version has flat groups only.\nStep back to when you handled nesting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(output length). \"{a,b}c{d,e}f\" → [\"acdf\",\"acef\",\"bcdf\",\"bcef\"]. \"abcd\" → [\"abcd\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
