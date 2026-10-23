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
            'message' => "Problem: This is part I with a much longer string. Reverse either the first k or the last k characters of s, exactly once, for some k from 1 to n, and return the smallest string you can get. Building all 2n results is too slow here. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhich moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix and suffix reversals', 'next' => 's2'],
                ['label' => 'Prefix reversals only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Made-up \"bccb\" → \"bccb\" instead of \"bbcc\".\nStep back to when you skipped suffixes.",
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
            'message' => "You are wrong. Made-up \"cab\" → \"bac\" instead of \"acb\".\nStep back to when you reversed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → \"acbc\", \"bbcc\", \"a\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
