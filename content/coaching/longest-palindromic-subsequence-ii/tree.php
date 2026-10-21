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
            'message' => "Problem: A good palindromic subsequence has even length and no two consecutive equal characters except the middle two. Return the length of the longest good palindromic subsequence of s. For instance, \"bbabab\" → 4 (\"baab\"). (Restated from memory; limits and examples may differ slightly.)\nExtra state beyond (i, j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last outer letter used', 'next' => 's2'],
                ['label' => 'None', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You must block equal consecutive letters.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ends match but equal prev?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take them anyway', 'next' => 'wrong_b'],
                ['label' => 'Skip one end', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That would put equal letters next to each other.\nStep back to when you took them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Odd middle letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never counts', 'next' => 'success'],
                ['label' => 'Adds 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Good palindromes have even length.\nStep back to when you added the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n²). Constructed check: \"bbabab\" → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
