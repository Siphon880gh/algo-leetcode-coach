You get a binary string s and an integer k. In one operation you pick any substring of length k and flip every character in it. Return how many distinct strings you can reach, counting s itself, modulo the large prime the statement gives. For instance, s = 1001 with k = 3 → 4, and s = 10110 with k = 5 → 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Each window is a switch

1. `w = n − k + 1`.
2. Return `2^w` modulo the prime, by fast power or by doubling `w` times.

Constructed checks (verified against a BFS over every reachable string on 300 random small cases): the cases above → 4, 2.

Flips commute and two flips of one window cancel, so a reachable string is fixed by the set of windows flipped an odd number of times. Two different sets give different strings: at the leftmost window where they differ, its first character is flipped in one and not the other, because every window covering that character starts earlier and is chosen the same way in both. The answer never depends on the characters of s.

Time: O(log n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
