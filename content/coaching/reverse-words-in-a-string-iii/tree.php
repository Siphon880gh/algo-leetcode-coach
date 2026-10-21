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
            'message' => "Read the problem statement above.\nWhat gets reversed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The letters inside each word; the words stay in place', 'next' => 's2'],
                ['label' => 'The order of the words', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is Reverse Words in a String (151). Here every word keeps its position.\nStep back to when you reversed the word order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you find the words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse the whole string and stop', 'next' => 'wrong_b'],
                ['label' => 'Split on single spaces: there is exactly one space between words', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reversing the whole string also flips the word order.\nStep back to when you reversed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "In place on a char array, how do you reverse one word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two pointers from both ends of the word, swapping inward', 'next' => 'success'],
                ['label' => 'Move each character to the end of the word, one at a time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Shifting characters is O(k²) for a word of length k; swapping from both ends is O(k).\nStep back to when you shifted characters.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Reverse each word with two pointers or a split and join: O(n) time. \"Let's take LeetCode contest\" → \"s'teL ekat edoCteeL tsetnoc\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
