You are given a permutation of 1 … n. Return its index among all permutations of 1 … n in lexicographic order, modulo the number the statement gives. Limits are in the official statement. For instance, counting from 0, [3, 1, 2] → 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Factorial number system

This assumes the index counts from 0; add 1 if the official statement counts from 1.

1. Precompute factorials mod the modulus.
2. For each i: smaller = (perm[i] − 1) − (used values below perm[i]); ans += smaller · (n − 1 − i)!; mark perm[i] used in the Fenwick tree.

Constructed checks (run in code): [1, 2] → 0, [3, 1, 2] → 4, [2, 1, 3] → 2; every permutation up to n = 6 matches its position in sorted order.

Counting all smaller values instead of the unused ones double-counts: [3, 1, 2] would give 4 + 0 + 1 = 5.

Time: O(n log n)  
Space: O(n)

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
