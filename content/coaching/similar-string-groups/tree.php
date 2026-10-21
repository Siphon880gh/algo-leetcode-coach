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
            'message' => "Read the problem statement above.\nHow do you check whether two words are similar?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count differing positions: 0 or 2', 'next' => 's2'],
                ['label' => 'Compare their sorted letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. All the words are anagrams of each other, so sorted letters always match.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is a group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A pair of similar words', 'next' => 'wrong_b'],
                ['label' => 'A connected component: union every similar pair', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Similarity chains: A ~ B and B ~ C put A and C in one group.\nStep back to when you stopped at pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The list contains the same word twice. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They differ in 0 positions, so same group', 'next' => 'success'],
                ['label' => 'They form separate groups', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A word is similar to itself.\nStep back to when you split the duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · m) with union-find. [\"tars\",\"rats\",\"arts\",\"star\"] → 2. [\"omv\",\"ovm\"] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
