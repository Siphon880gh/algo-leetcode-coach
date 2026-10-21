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
            'message' => "Problem: s up to 3e4 chars of digits, (, ), −. An integer, then zero to two parenthesized subtrees, left first. \"4(2(3)(1))(6(5))\" → [4,2,6,3,1,5]. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Parse with one shared index', 'next' => 's2'],
                ['label' => 'Find the matching parenthesis and recurse on substrings', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Slicing substrings for each call copies text again and again: O(n²) on deep trees.\nStep back to when you sliced substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Read the value at i.\nHow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One digit character', 'next' => 'wrong_b'],
                ['label' => 'Optional −, then all digits', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Values can be multi-digit and negative. \"-4\" and \"12\" break single-digit reads.\nStep back to when you read one character.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "If s[i] == \"(\": skip, left = parse(), skip \")\". Again for the right. O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Index parser: signed number, left, then right', 'next' => 'success'],
                ['label' => 'If only one pair of parentheses, attach it as the right child', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A single subtree in parentheses is the left child, not the right.\nStep back to when you made it the right child.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Shared-index recursive descent. → [4,2,6,3,1,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
