## Tree orderings

1. Build children lists; compute subtree sizes with an iterative DFS (post-order).
2. Answer = `n! · Π inverse(size[v])` mod 1e9+7.

`[-1,0,1]` → 1. `[-1,0,0,1,2]` → 6. Checked against enumerating permutations on random small trees.

Why: in a uniformly random permutation, each node comes first in its subtree with probability `1 / size`, independently. Use an explicit stack; recursion on a 10^5-deep chain overflows.

Time: O(n log p) for inverses, or O(n) with precomputed inverse factorials  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
