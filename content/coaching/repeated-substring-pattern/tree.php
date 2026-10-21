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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Look for s inside s + s, after index 0', 'next' => 's2'],
                ['label' => 'For every prefix length, build the repeated string and compare', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Building every prefix repeated to length |s| for every prefix length is O(n²) work and memory, and it tries lengths that cannot divide |s|.\nStep back to when you tried every prefix length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"abab\" + \"abab\" = \"abababab\". s also appears at index 2.\nWhat condition do you test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(s + s) contains s at all', 'next' => 'wrong_b'],
                ['label' => '(s + s).find(s, 1) < |s|', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. s always appears at index 0 and index |s| in s + s. Those two matches say nothing.\nStep back to when you counted the trivial matches.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A match at 0 < d < |s| means s has period d, and that gives a real repeat. With KMP the find is O(n). The direct check over divisors d of |s| is also fine.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Find in s + s from index 1, below |s|. Not a single copy', 'next' => 'success'],
                ['label' => 'Return true when the pattern is s itself', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. s must be built from at least two copies. One copy of itself is not a repeat.\nStep back to when you accepted a single copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. s is a repeat exactly when it appears in s + s strictly between 0 and |s|. \"abab\" → true, \"aba\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
