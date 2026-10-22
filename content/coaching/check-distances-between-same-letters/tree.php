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
            'message' => "Read the problem statement above.\nLetters between copies at i < j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j − i − 1', 'next' => 's2'],
                ['label' => 'j − i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That counts one end too; Example 1 → false instead of true.\nStep back to when you used j − i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distances of letters not in s?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Require them to be 0', 'next' => 'wrong_b'],
                ['label' => 'Ignore them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 gives d a distance of 5 but has no d → false instead of true.\nStep back to when you checked absent letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When can you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'false on a mismatch, true only after the scan', 'next' => 'success'],
                ['label' => 'true on the first matching letter', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. s = abab with a’s distance 1 and b’s 0 → true instead of false.\nStep back to when you returned early on a match.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
