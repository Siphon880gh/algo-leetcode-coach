## Largest values first

1. `dp = 1` everywhere. Sort cells by value, largest first.
2. For each cell `c`: `dp[c] += dp[d]` for each neighbour `d` with a larger value.
3. Return `Σ dp` modulo 10^9 + 7.

Examples → 8, 3.

Every larger neighbour was finished before `c`, so its count is final. Equal neighbours cannot follow each other on a strictly increasing path. With up to 10^5 cells, an iterative order avoids the deep recursion a DFS can need.

Time: O(m · n log(m · n))  
Space: O(m · n)

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
