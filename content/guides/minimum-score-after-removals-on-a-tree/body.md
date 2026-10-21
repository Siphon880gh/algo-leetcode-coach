## Pairs of cut edges

1. Root at 0; DFS gives `x[u]` = XOR of u’s subtree, plus `tin[u]` and `tout[u]`. `T = x[0]`.
2. Each non-root node `u` stands for the edge to its parent. For each pair `u < v`:
   - `v` inside `u`’s subtree: parts `x[v]`, `x[u] XOR x[v]`, `T XOR x[u]`.
   - `u` inside `v`’s subtree: the same with `u` and `v` swapped.
   - otherwise: `x[u]`, `x[v]`, `T XOR x[u] XOR x[v]`.
3. Return the minimum of max − min over all pairs.

Examples → 9, 0.

XOR cancels, so a part’s XOR is a subtree XOR with any inner removed subtree XORed out. n ≤ 1000, so the O(n²) pairs are fine.

Time: O(n²)  
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
