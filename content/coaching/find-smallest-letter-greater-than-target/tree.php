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
            'message' => "Read the problem statement above.\nletters[mid] == target. Move which bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lo = mid + 1: the answer must be strictly greater', 'next' => 's2'],
                ['label' => 'hi = mid', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That finds the first letter ≥ target, which can equal it.\nStep back to when you kept mid on equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "lo reaches n. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '-1', 'next' => 'wrong_b'],
                ['label' => 'letters[0], wrapping around', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The letters wrap; with nothing greater, the first letter is the answer.\nStep back to when you returned -1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Duplicates of the target. Problem?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the ≤ comparison skips all of them', 'next' => 'success'],
                ['label' => 'Yes: dedupe first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Upper-bound search passes every equal letter.\nStep back to when you deduped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). [\"c\",\"f\",\"j\"], \"a\" → \"c\"; \"c\" → \"f\"; \"j\" → \"c\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
