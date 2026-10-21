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
            'message' => "Read the problem statement above.\nWhat do odd-index encodings cover?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'perm[1] … perm[n − 1], each once', 'next' => 's2'],
                ['label' => 'Every element twice', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. encoded[1] = perm[1] ^ perm[2], encoded[3] = perm[3] ^ perm[4], and so on.\nStep back to when you assumed double coverage.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why does n odd matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It does not', 'next' => 'wrong_b'],
                ['label' => 'n − 1 is even, so those pairs tile the rest exactly', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With even n one element would be left out.\nStep back to when you ignored parity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After perm[0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'perm[i + 1] = perm[i] ^ encoded[i]', 'next' => 'success'],
                ['label' => 'Repeat the trick for each element', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One forward pass suffices.\nStep back to when you repeated it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1,2,3], [2,4,1,5,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
