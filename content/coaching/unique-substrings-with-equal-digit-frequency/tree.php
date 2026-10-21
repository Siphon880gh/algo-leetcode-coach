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
            'message' => "Problem: Given a string s of digits, return the number of distinct substrings in which every digit that appears occurs the same number of times. The string is short enough for quadratic work. For instance, \"1212\" → 5 (\"1\", \"2\", \"12\", \"21\", \"1212\"); \"111\" → 3. (Restated from memory; limits and examples may differ slightly.)\nCount what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct balanced substrings', 'next' => 's2'],
                ['label' => 'Every balanced occurrence', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 1212 → 8 occurrences, but only 5 distinct substrings.\nStep back to when you counted occurrences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Balance test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Min count = max count over all 10 digits', 'next' => 'wrong_b'],
                ['label' => 'Distinct digits × highest count = length', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Absent digits count 0, so 12 would fail.\nStep back to when you included absent digits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Store substrings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As rolling hashes', 'next' => 'success'],
                ['label' => 'As full strings', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Up to about 5 · 10^5 substrings averaging hundreds of characters is too much memory.\nStep back to when you stored strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) with hashing. Constructed cases → 5, 3, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
