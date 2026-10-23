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
            'message' => "Read the problem statement above.\nWhich moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix and suffix reversals', 'next' => 's2'],
                ['label' => 'Prefix reversals only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → \"abba\" instead of \"aabb\".\nStep back to when you skipped suffixes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only k = n', 'next' => 'wrong_b'],
                ['label' => 'Every k from 1 to n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → \"bacd\" instead of \"acdb\".\nStep back to when you reversed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → \"acdb\", \"aabb\", \"xzy\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
