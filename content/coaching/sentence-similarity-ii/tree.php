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
            'message' => "Problem: Problem: Two sentences (word arrays) are similar if they have the same length and each pair of words at the same position is similar, where similarity comes from a list of pairs and is transitive (a~b and b~c give a~c). Every word is similar to itself. (Restated from memory; limits and examples may differ slightly.)\nIs a set of pairs enough here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: similarity chains, so use union-find', 'next' => 's2'],
                ['label' => 'Yes, as in problem 734', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. great~good and good~fine must make great~fine.\nStep back to when you used a set of pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A word never appears in any pair. Similar to what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing, so return false', 'next' => 'wrong_b'],
                ['label' => 'Only itself', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal words are always similar.\nStep back to when you rejected it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two different words at a position. When do they pass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When find(w1) == find(w2)', 'next' => 'success'],
                ['label' => 'When either one is in the pair list', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. They must be in the same component.\nStep back to when you checked membership.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Union-find over pair words: O((p + n) α(p)). [\"great\",\"acting\",\"skills\"] vs [\"fine\",\"drama\",\"talent\"] with great~good, fine~good, drama~acting, skills~talent → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
