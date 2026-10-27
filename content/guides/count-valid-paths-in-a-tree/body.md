## Components

1. Sieve to n; flood fill the non-prime nodes into components with sizes.
2. For each prime p, with `tot = 0`: for each non-prime neighbour’s component size z, add `z + tot·z`; `tot += z`.

Examples → 4, 6. Checked against testing every pair of nodes on 200 random trees.

Count paths passing through the prime between two components, not only those ending at it: without them the examples → 3 and 4. The answer can exceed 2^31 (about 4 · 10^9 paths through node 2 if it touched every non-prime), so use 64-bit.

Time: O(n log log n)  
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
