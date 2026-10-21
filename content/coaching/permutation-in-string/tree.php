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
            'message' => "Read the problem statement above.\nWhat does a permutation of s1 inside s2 look like?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A window of length len(s1) with the same letter counts', 'next' => 's2'],
                ['label' => 'A subsequence of s2 with the same letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The permutation must be a contiguous substring; scattered letters do not count.\nStep back to when you used a subsequence.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you test every window quickly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort each window and compare it to sorted s1', 'next' => 'wrong_b'],
                ['label' => 'Slide it: add the entering letter and remove the leaving one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sorting every window costs O(n · m log m); sliding updates the counts in O(1).\nStep back to when you sorted windows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you know the counts match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep need = letters still unmatched; return true when need == 0', 'next' => 'success'],
                ['label' => 'Check that the window has the same set of letters', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sets ignore how many times a letter appears: \"abb\" has the same letters as \"aab\" but different counts.\nStep back to when you compared sets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. A fixed window with counts and a need counter: O(m + n) time, O(1) space. \"ab\" in \"eidbaooo\" → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
