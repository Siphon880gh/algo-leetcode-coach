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
            'message' => "Problem: Problem: Given a time \"HH:MM\", return the next time (wrapping past midnight if needed) that uses only digits appearing in the given time; digits may be reused. If no other time works, return the same time. (Restated from memory; limits and examples may differ slightly.)\nHow many candidate strings are there?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most 4⁴ = 256, so enumerate them all', 'next' => 's2'],
                ['label' => 'Too many; search cleverly', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 256 is tiny.\nStep back to when you avoided enumeration.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which candidates are valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any four digits', 'next' => 'wrong_b'],
                ['label' => 'Hour < 24 and minute < 60', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"29:99\" is not a time.\nStep back to when you skipped validation.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you measure \"next\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(cand − cur) mod 1440, treating 0 as 1440', 'next' => 'success'],
                ['label' => 'The absolute difference', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Earlier times count only after wrapping past midnight.\nStep back to when you used the absolute difference.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Enumerate and take the smallest positive gap: O(1). \"19:34\" → \"19:39\". \"23:59\" → \"22:22\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
