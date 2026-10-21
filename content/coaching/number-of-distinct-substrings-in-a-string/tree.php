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
            'message' => "Problem: Return the number of distinct non-empty substrings of s. For instance, \"aabbaba\" → 21 and \"abcdefg\" → 28. A follow-up typically asks for better than O(n²). (Restated from memory; limits and examples may differ slightly.)\nSet of all substrings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: trie of suffixes', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Storing strings is O(n³) memory.\nStep back to when you used a set.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does one new node mean?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One new suffix', 'next' => 'wrong_b'],
                ['label' => 'One new distinct substring', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each node is a distinct prefix of some suffix.\nStep back to when you counted suffixes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Faster method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Suffix automaton: Σ (len − link len)', 'next' => 'success'],
                ['label' => 'None exists', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Linear-time structures exist.\nStep back to when you said none.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) trie. Constructed check: \"aabbaba\" → 21.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
