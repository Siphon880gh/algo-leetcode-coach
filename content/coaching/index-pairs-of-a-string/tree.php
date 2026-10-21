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
            'message' => "Problem: Given text and a list of words, return every pair [i, j] where text[i..j] (inclusive) is one of the words, sorted by i and then j. text = \"thestoryofleetcodeandme\", words = [\"story\",\"fleet\",\"leetcode\"] → [[3,7],[9,13],[10,17]]. text = \"ababa\", words = [\"aba\",\"ab\"] → [[0,1],[0,2],[2,3],[2,4]]. (Restated from memory; limits and examples may differ slightly.)\nSearch each word with find and collect positions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: walk a trie from each start', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. find returns one occurrence at a time and misses overlaps unless you loop carefully.\nStep back to when you used find.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You hit a word end. Stop this walk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: a longer word may continue', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"ab\" and \"aba\" both start at 0.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Do you need to sort the output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: starts and ends are produced in order', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Increasing i and j already give sorted pairs.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · L). The two examples give [[3,7],[9,13],[10,17]] and [[0,1],[0,2],[2,3],[2,4]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
