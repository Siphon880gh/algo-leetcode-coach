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
            'message' => "Read the problem statement above.\nFirst key duration?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'releaseTimes[0]', 'next' => 's2'],
                ['label' => 'Skip it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The first press starts at time 0.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie on duration?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Earlier key wins', 'next' => 'wrong_b'],
                ['label' => 'Larger letter wins', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties go to the lexicographically largest key.\nStep back to when you kept the earlier one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Implementation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare (duration, key) tuples', 'next' => 'success'],
                ['label' => 'Sort all keys', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One pass with tuple max suffices.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"c\", \"a\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
