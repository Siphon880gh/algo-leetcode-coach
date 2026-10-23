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
            'message' => "Read the problem statement above.\nReverse what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Letters and special characters, each as its own list', 'next' => 's2'],
                ['label' => 'The whole string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → \"(f@ad#cbe)\" instead of \"(fad@cb#e)\".\nStep back to when you reversed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The special characters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave them in place', 'next' => 'wrong_b'],
                ['label' => 'Reverse them too', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → \")fad#cb@e(\" instead of \"(fad@cb#e)\".\nStep back to when you skipped the second reversal.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"(fad@cb#e)\", \"z\", \")(*&^%\$#@!\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
