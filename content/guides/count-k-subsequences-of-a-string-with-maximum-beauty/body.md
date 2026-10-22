## Combinatorics

1. Count f(c). If k exceeds the number of distinct letters, return 0.
2. Sort frequencies descending; `v` = the k-th one, `a` = letters with f > v, `c` = letters with f = v.
3. Answer = product of f over the a letters · C(c, k − a) · v^(k − a), mod 10^9 + 7.

Examples → 4, 2. Checked against listing every subsequence on 300 random small strings.

Each chosen letter can come from any of its f(c) positions, so multiply by f: counting only letter sets gives example 1 → 2 instead of 4.

Time: O(n + 26 log 26)  
Space: O(26)

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
