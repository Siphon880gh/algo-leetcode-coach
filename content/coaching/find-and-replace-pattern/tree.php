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
            'message' => "Read the problem statement above.\nCheck only word letter → pattern letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: check both directions', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With one map, \"abc\" would match \"aaa\".\nStep back to when you used one map.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare letter counts instead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: counts ignore positions', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"abb\" and \"bab\" have the same counts but different shapes.\nStep back to when you compared counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Another way to compare shapes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Replace each letter by its first-occurrence index and compare', 'next' => 'success'],
                ['label' => 'Sort both strings', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sorting loses the positions.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total letters). [\"abc\",\"deq\",\"mee\",\"aqq\",\"dkd\",\"ccc\"], \"abb\" → [\"mee\",\"aqq\"]. [\"a\",\"b\",\"c\"], \"a\" → [\"a\",\"b\",\"c\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
