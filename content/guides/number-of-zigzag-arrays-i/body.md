## DP over values

1. up[v] = down[v] = 1 for each of the m values (length 1).
2. Repeat n − 1 times: new up[v] = Σ down[u] for u < v; new down[v] = Σ up[u] for u > v. Use prefix sums.
3. Return Σ up + Σ down, mod 10^9 + 7.

Examples → 2, 10. Checked against listing every array for n = 3 … 6 and m = 2 … 5.

Only requiring neighbors to differ: example 2 → 12 instead of 10.

Time: O(n · m)  
Space: O(m)

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
