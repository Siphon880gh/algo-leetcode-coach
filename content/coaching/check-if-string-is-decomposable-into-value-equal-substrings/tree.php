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
            'message' => "Problem: A value-equal string consists of a single repeated character. Given a digit string, decide whether it can be split into consecutive value-equal substrings so that exactly one has length 2 and all the others have length 3. For instance, \"000111000\" → false, \"00011111222\" → true, and \"011100022233\" → false. (Restated from memory; limits and examples may differ slightly.)\nRun length ≡ 1 (mod 3)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Impossible: return false', 'next' => 's2'],
                ['label' => 'Use two length-2 pieces', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only one length-2 piece is allowed in total.\nStep back to when you used two.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pieces across runs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed', 'next' => 'wrong_b'],
                ['label' => 'Never; each piece is one character', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A piece must be a single repeated character.\nStep back to when you crossed a run.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No run ≡ 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'False', 'next' => 'success'],
                ['label' => 'True', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Exactly one length-2 piece is required.\nStep back to when you returned true.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → false, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
