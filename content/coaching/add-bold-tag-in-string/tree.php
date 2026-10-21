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
            'message' => "Problem: Given s and a list of words, wrap every substring of s that equals a word in <b> and </b>; overlapping or touching matches share one pair of tags. \"abcxyz123\" with [\"abc\",\"123\"] → \"<b>abc</b>xyz<b>123</b>\". \"aaabbb\" with [\"aa\",\"b\"] → \"<b>aaabbb</b>\". (Restated from memory; limits and examples may differ slightly.)\nWrap each match on its own?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: mark a bold flag for every covered character', 'next' => 's2'],
                ['label' => 'Yes: add tags around each match', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Overlapping matches would produce nested or repeated tags.\nStep back to when you wrapped each match.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Several words match at position i. Which ones matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the first word that matches', 'next' => 'wrong_b'],
                ['label' => 'All of them, or at least the one that reaches furthest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A longer word can cover more characters.\nStep back to when you stopped at the first word.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you place the tags?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '<b> where a bold run starts and </b> where it ends', 'next' => 'success'],
                ['label' => '<b> and </b> around every bold character', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Touching bold characters must share one pair of tags.\nStep back to when you tagged each character.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. A bold mask from every match, then one tag pair per run: O(n · total word length), less with a trie.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
