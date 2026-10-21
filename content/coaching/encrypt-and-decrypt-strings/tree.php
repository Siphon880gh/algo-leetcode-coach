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
            'message' => "Read the problem statement above.\ndecrypt(s)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Look up how many dictionary words encrypt to s', 'next' => 's2'],
                ['label' => 'Try every key choice for every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Several keys can share a value, so the choices multiply with each pair.\nStep back to when you branched over keys.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two dictionary words with the same encryption?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Store encryptions in a set', 'next' => 'wrong_b'],
                ['label' => 'Count both', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abcd and abad both encrypt to eizfeiam; Example 1 → 1 instead of 2.\nStep back to when you used a set.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Dictionary word with a letter not in keys?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'success'],
                ['label' => 'Encrypt the letters you can', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A partial encryption could match some s by accident.\nStep back to when you encrypted part of it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(Σ |dictionary|) setup, O(|w|) per call. Example 1 matches.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
