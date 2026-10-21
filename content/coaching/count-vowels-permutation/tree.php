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
            'message' => "Read the problem statement above.\nUpdate uses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Which vowels may come before each vowel', 'next' => 's2'],
                ['label' => 'Which may come after', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The new count of a vowel sums its predecessors.\nStep back to when you used successors.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New count for a?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'e', 'next' => 'wrong_b'],
                ['label' => 'e + i + u', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. a can follow e, i, or u.\nStep back to when you used only e.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Update in place one by one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compute all five from old values', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. New values would leak into the others.\nStep back to when you updated in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 1 → 5. n = 2 → 10. n = 5 → 68.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
