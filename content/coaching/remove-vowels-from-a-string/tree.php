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
            'message' => "Problem: Given a lowercase string s, remove every vowel (a, e, i, o, u) and return the rest. For instance, \"leetcode\" becomes \"ltcd\". (Restated from memory; limits and examples may differ slightly.)\nDelete vowels from the string one at a time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: build a new string in one pass', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each deletion copies the rest of the string.\nStep back to when you deleted one at a time.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you test a vowel quickly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare with every letter of the alphabet', 'next' => 'wrong_b'],
                ['label' => 'Membership in a set of five letters', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only five letters matter.\nStep back to when you compared with the alphabet.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is y a vowel here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only a, e, i, o, u are removed.\nStep back to when you removed y.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"leetcode\" → \"ltcd\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
